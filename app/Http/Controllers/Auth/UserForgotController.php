<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgetotpMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserForgotController extends Controller
{
    /**
     * Forgot Password Page
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send 4 Digit OTP
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        // Generate OTP only once
        $otp = random_int(1000, 9999);

        // Save OTP in database
        $user->otp = $otp;
        $user->otp_expires_at = now()->addMinutes(5);
        $user->save();

        // Refresh model from database
        $user->refresh();

        // Send the SAME OTP
        Mail::to($user->email)->send(new ForgetotpMail($user->otp));

        return redirect()
            ->route('password.otp.form', ['email' => $user->email])
            ->with('success', 'OTP has been sent to your email.');
    }

    /**
     * OTP Verification Page
     */
    public function showOtpForm(Request $request)
    {
        return view('auth.verify-otp', [
            'email' => $request->email,
        ]);
    }

    /**
     * Verify OTP
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|digits:4',
        ]);

        $user = User::where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$user) {
            return back()->withErrors([
                'otp' => 'Invalid OTP.',
            ])->withInput();
        }

        if (Carbon::now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors([
                'otp' => 'OTP has expired.',
            ])->withInput();
        }

        return redirect()->route('password.reset.form', [
            'email' => $user->email,
        ]);
    }

    /**
     * Reset Password Page
     */
    public function showResetPasswordForm(Request $request)
    {
        return view('auth.reset-password', [
            'email' => $request->email,
        ]);
    }

    /**
     * Update Password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email|exists:users,email',
            'password'              => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        $user->update([
            'password' => Hash::make($request->password),
            'otp' => null,
            'otp_expires_at' => null,
        ]);

        return redirect()->route('login')
            ->with('success', 'Password changed successfully. Please login.');
    }
}