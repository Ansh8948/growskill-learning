<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgetotpMail;
use App\Mail\TeacherOtpMail;

class ForgotPasswordController extends Controller
{
    // Step 1: Show "enter email" form
    public function showLinkRequestForm()
    {
        return view('teacher.auth.forgot-password');
    }

    // Step 1: Generate & send 6-digit OTP
    public function sendResetLinkEmail(Request $request)
{
    $request->validate(['email' => 'required|email|exists:teachers,email']);

    $otp = random_int(100000, 999999);

    Cache::put('teacher_otp_' . $request->email, $otp, now()->addMinutes(5));

    Mail::to($request->email)->send(new ForgetotpMail($otp));

    return redirect()
        ->route('teacher.password.otp.form', ['email' => $request->email])
        ->with('success', 'A 6-digit OTP has been sent to your email.');
}

    // Step 2: Show "enter OTP + new password" form
    public function showOtpForm(Request $request)
    {
        return view('teacher.auth.verify-otp', [
            'email' => $request->email,
        ]);
    }

    // Step 2: Verify OTP & reset password
    public function reset(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'otp'      => 'required|digits:6',
            'password' => 'required|confirmed|min:8',
        ]);

        $cachedOtp = Cache::get('teacher_otp_' . $request->email);

        if (!$cachedOtp || (string) $cachedOtp !== (string) $request->otp) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        $teacher = Teacher::where('email', $request->email)->first();

        if (!$teacher) {
            return back()->withErrors(['email' => 'No account found with this email.']);
        }

        $teacher->forceFill([
            'password' => Hash::make($request->password),
        ])->save();

        // OTP use hone ke baad clear kar do
        Cache::forget('teacher_otp_' . $request->email);

        return redirect()->route('teacher.login')->with('success', 'Your password has been reset. You can now log in.');
    }
}