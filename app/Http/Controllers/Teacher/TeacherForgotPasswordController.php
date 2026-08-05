<?php

namespace App\Http\Controllers\Teacher;
use App\Http\Controllers\Controller;
use App\Mail\TeacherForgetotpMail;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class TeacherForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('teacher.auth.forgot-password');
    }
    public function sendResetLinkEmail(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:teachers,email',
    ]);

    $teacher = Teacher::where('email', $request->email)->first();

    if (!$teacher) {
        return back()->withErrors([
            'email' => 'Teacher not found.',
        ]);
    }

    $otp = rand(1000, 9999);

    
    $teacher->update([
        'otp' => $otp,
        'otp_expires_at' => now()->addMinutes(5),
    ]);


    Mail::to($teacher->email)->send(new TeacherForgetotpMail($otp));

    
    return redirect()->route('teacher.password.otp.form', [
        'email' => $teacher->email,
    ])->with('success', 'OTP sent successfully.');
}

    public function showOtpForm(Request $request)
    {
        return view('teacher.auth.verify-otp', [
            'email' => $request->email,
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:4',
        ]);

        $teacher = Teacher::where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$teacher) {
            return back()->withErrors([
                'otp' => 'Invalid OTP',
            ]);
        }

        if (Carbon::now()->greaterThan($teacher->otp_expires_at)) {
            return back()->withErrors([
                'otp' => 'OTP Expired',
            ]);
        }

        return redirect()->route('teacher.password.reset.form', [
            'email' => $teacher->email,
        ]);
    }

    public function showResetForm(Request $request)
    {
        return view('teacher.auth.reset-password', [
            'email' => $request->email,
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $teacher = Teacher::where('email', $request->email)->first();

        $teacher->update([
            'password' => Hash::make($request->password),
            'otp' => null,
            'otp_expires_at' => null,
        ]);

        return redirect()->route('teacher.login')
            ->with('success', 'Password changed successfully.');
    }
}