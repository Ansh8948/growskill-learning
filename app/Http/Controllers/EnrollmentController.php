<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function store(Course $course)
    {
        $exists = $course->enrollments()->where('user_id', Auth::id())->exists();

        if (! $exists) {
            $course->enrollments()->create([
                'user_id' => Auth::id(),
                'price_paid' => $course->displayPrice(),
            ]);
        }

        return redirect()->route('dashboard')->with('success', "You're enrolled in \"{$course->title}\"!");
    }
}
