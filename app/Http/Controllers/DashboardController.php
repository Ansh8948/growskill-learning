<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $enrollments = Auth::user()->enrollments()->with('course.category')->latest()->get();

        return view('dashboard', compact('enrollments'));
    }

    public function destroy(Enrollment $enrollment)
    {
        // Ownership check: a user can only remove their own enrollment.
        if ($enrollment->user_id !== Auth::id()) {
            abort(403, 'You can only remove your own enrollments.');
        }

        $enrollment->delete();

        return redirect()->route('dashboard')->with('success', 'Removed from your courses.');
    }
}