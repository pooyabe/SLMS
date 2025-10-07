<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login page
     */
    public function show_login()
    {
        return view('auth.login');
    }

    /**
     * Get the phone number and send OTP SMS
     */
    public function get_phone(Request $request)
    {

        // اعتبارسنجی ورودی
        $request->validate([
            'phone' => 'required|string|size:11|regex:/^09[0-9]{9}$/',
        ]);

        // پیدا کردن کاربر بر اساس شماره تلفن
        $user = User::where('phone_number', $request->phone)->first();

        if (!$user) {
            return back()->withErrors(['phone' => 'کاربری با این شماره یافت نشد.']);
        }

        // تولید کد تأیید (۴ یا ۵ رقمی)
        $code = rand(1000, 9999);

        $user->verification_code = $code;
        $user->save();

        //ارسال پیامک (فعلاً شبیه‌سازی شده)
        // sendSMS

        // هدایت به صفحه‌ی وارد کردن کد
        return redirect()->route('auth.showverifycode')
            ->with('phone', $user->phone_number);
    }


    /**
     * Show the verify code page
     */
    public function show_verify_code()
    {
        return view('auth.verifycode', [
            'phone' => session('phone')
        ]);
    }

    /**
     * Verify the code and do Login
     */
    public function verify_code(Request $request)
    {
        // اعتبارسنجی ورودی‌ها
        $request->validate([
            'phone' => 'required|string|size:11|regex:/^09[0-9]{9}$/',
            'code' => 'required|digits_between:4,6',
        ]);

        // پیدا کردن کاربر بر اساس شماره
        $user = User::where('phone_number', $request->phone)->first();

        if (!$user) {
            return back()->withErrors(['phone' => 'کاربری با این شماره یافت نشد.']);
        }

        // بررسی کد
        if ($user->verification_code !== $request->code) {
            return back()->withErrors(['code' => 'کد وارد شده صحیح نیست.']);
        }

        // پاک کردن کد بعد از تأیید
        $user->verification_code = null;
        $user->save();

        // لاگین کردن کاربر
        Auth::login($user);

        // ریدایرکت به داشبورد یا هر جایی که می‌خوای
        return redirect()->route('dashboard.main')->with('success', 'ورود با موفقیت انجام شد.');
    }
}
