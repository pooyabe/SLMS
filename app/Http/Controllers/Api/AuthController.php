<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * مرحله اول:
     * گرفتن شماره موبایل و ارسال کد (فعلاً کامنت)
     */
    public function requestCode(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string|max:20',
        ]);

        $user = User::where('phone_number', $request->phone_number)->first();

        if (!$user) {
            return response()->json([
                'message' => '101'
            ], 404);
        }

        // تولید کد تأیید (مثلاً ۵ رقمی)
        $code = rand(1000, 9999);

        // ذخیره در دیتابیس
        $user->verification_code = $code;
        $user->save();

        // اینجا بعداً سرویس ارسال SMS اضافه می‌کنی
        // sendSms($user->phone_number, $code);

        return response()->json([
            'message' => '201',
            // 'test_code' => $code // بعداً حذفش کن
        ], 200);
    }

    /**
     * مرحله دوم:
     * گرفتن کد و بررسی
     */
    public function verifyCode(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string|max:20',
            'code' => 'required|numeric',
        ]);

        $user = User::where('phone_number', $request->phone_number)->first();

        if (!$user) {
            return response()->json([
                'message' => '101'
            ], 404);
        }

        if ($user->verification_code != $request->code) {
            return response()->json([
                'message' => '102'
            ], 401);
        }

        // موفقیت - پاک کردن کد
        $user->verification_code = null;
        $user->save();

        // ساخت توکن sanctum
        $token = $user->createToken('mobile_login')->plainTextToken;

        return response()->json([
            'message' => '202',
            'user' => $user,
            'token' => $token
        ], 200);
    }
}
