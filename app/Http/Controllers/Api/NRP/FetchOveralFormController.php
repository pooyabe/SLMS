<?php

namespace App\Http\Controllers\Api\NRP;

use App\Http\Controllers\Controller;
use App\Models\Station;
use Illuminate\Http\Request;

class FetchOveralFormController extends Controller
{
    // Send States with defined stations
    public function FetchStates(Request $request)
    {
        $user = $request->user(); // کاربری که توکنش معتبره

        // اگر توکن معتبر نباشه
        if (!$user) {
            return response()->json([
                'message' => '103'
            ], 403);
        }

        try {
            // فقط استان‌هایی که در جدول Station وجود دارن
            $states = Station::select(['state', 'state_fa'])
                ->whereNotNull('state')
                ->distinct()
                ->orderBy('state', 'asc')
                ->get();

            $formatted = $states->map(fn($s) => [
                'label' => $s->state_fa,
                'value' => $s->state,
            ])->values();



            return response()->json([
                'success' => true,
                'states' => $formatted,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * --- Fetch Stations based on selected State ---
     */
    public function FetchStations(Request $request)
    {
        $user = $request->user(); // کاربری که توکنش معتبره

        // اگر توکن معتبر نباشه
        if (!$user) {
            return response()->json([
                'message' => '103'
            ], 403);
        }

        try {

            $stations = Station::select(['code', 'name'])
                ->where('state', $request->input('state'))
                ->get();

            $formatted = $stations->map(fn($s) => [
                'label' => $s->name,
                'value' => $s->code,
            ])->values();

            return response()->json([
                'success' => true,
                'stations' => $formatted,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
