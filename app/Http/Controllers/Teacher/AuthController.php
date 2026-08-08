<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
// use App\Http\Controllers\Teacher\Mail;
use App\Mail\TeacherWelcomeMail;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('teacher.auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:teachers,email'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $teacher = Teacher::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'bio' => $validated['bio'] ?? null,
            'password' => Hash::make($validated['password']),
        ]);
        try {
            Mail::to($teacher->email)->send(new TeacherWelcomeMail($teacher));
          } catch (\Exception $e) {
             \Log::error($e->getMessage());
          }

        Auth::guard('teacher')->login($teacher);

        return redirect()->route('teacher.courses.index');
    }

    public function showLogin()
    {
        return view('teacher.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::guard('teacher')->attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Those teacher credentials do not match our records.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('teacher.courses.index'));
    }

    public function logout(Request $request)
    {
        Auth::guard('teacher')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('teacher.login');
    }
}