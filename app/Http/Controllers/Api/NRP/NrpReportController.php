<?php

namespace App\Http\Controllers\Api\NRP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\NrpReport;
use App\Models\Station;
use Exception;
use Illuminate\Support\Str;

class NrpReportController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();

        // 1) permission check (ممکنه اسم permission عوض شه)
        if (!$user || !$user->can('allow-nrp-login')) {
            return response()->json(['message' => '103'], 403);
        }

        // 2) basic validation
        $validated = $request->validate([
            'station'  => 'required|string',
            'state'    => 'required|string',
            'leveling' => 'sometimes|json',
            'measure'  => 'sometimes|json',
            'overal'   => 'sometimes|json',
            'pictures.*' => 'sometimes|file|mimes:jpeg,jpg,png|max:10240', // max 10MB per file
        ]);

        // 3) find station by code
        $station = Station::where('code', $validated['station'])->first();
        if (!$station) {
            return response()->json(['message' => '105'], 404);
        }

        // we will collect stored file info here
        $storedFiles = [];

        // 4) begin transaction and try to store files + db atomically
        DB::beginTransaction();
        try {
            // store files first (each file saved to 'nrp/pictures/{station_code}/...') 
            if ($request->hasFile('pictures')) {
                foreach ($request->file('pictures') as $file) {
                    // generate unique filename
                    $uniq = Str::random(12) . '_' . time();
                    $ext = $file->getClientOriginalExtension() ?: 'jpg';
                    $filename = $uniq . '.' . $ext;
                    $path = "nrp/pictures/{$station->code}/{$filename}";

                    // store on "public" disk (or s3 if configured)
                    // adjust disk if you want S3: Storage::disk('s3')->putFileAs(...)
                    $stored = Storage::disk('public')->putFileAs("nrp/pictures/{$station->code}", $file, $filename);

                    if (!$stored) {
                        throw new Exception("failed to store file " . $file->getClientOriginalName());
                    }

                    $storedFiles[] = [
                        'original_name' => $file->getClientOriginalName(),
                        'path' => $path,
                        'url' => Storage::disk('public')->url($path),
                    ];
                }
            }

            // 5) create report row
            $report = NrpReport::create([
                'station_id' => $station->id,
                'user_id' => $user->id,
                'pictures' => $storedFiles ? json_encode($storedFiles, JSON_UNESCAPED_UNICODE) : null,
                // store fields as you prefer; I'll combine measure+overal as `fields`
                'fields' => json_encode([
                    'measure' => isset($validated['measure']) ? json_decode($validated['measure'], true) : null,
                    'overal'  => isset($validated['overal']) ? json_decode($validated['overal'], true) : null,
                ], JSON_UNESCAPED_UNICODE),
                'leveling' => isset($validated['leveling']) ? $validated['leveling'] : null,
            ]);

            if (!$report) {
                throw new Exception("failed to create report row");
            }

            DB::commit();

            // 6) success response (203 + track_id)
            return response()->json([
                'message' => 203,
                'track_id' => $report->id,
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();

            // cleanup any files we stored
            try {
                foreach ($storedFiles as $f) {
                    if (isset($f['path']) && Storage::disk('public')->exists($f['path'])) {
                        Storage::disk('public')->delete($f['path']);
                    }
                }
            } catch (\Throwable $err) {
                // log but don't break original error
                \Log::warning("cleanup error: " . $err->getMessage());
            }

            \Log::error('NRP store error: ' . $e->getMessage(), [
                'user_id' => $user->id ?? null,
                'station' => $validated['station'] ?? null,
            ]);

            return response()->json([
                'message' => 104,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
