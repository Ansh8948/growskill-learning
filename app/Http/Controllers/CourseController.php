<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
    $query = Course::with('category')->where('is_active', true);

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        $courses = $query->latest()->paginate(9)->withQueryString();
        $categories = Category::all();

        return view('courses.index', compact('courses', 'categories'));
    }

    public function show(Course $course)
{
    // Sirf student ke liye inactive course hide karo
    if (
        !$course->is_active &&
        (!auth()->check() || auth()->user()->role != 'teacher')
    ) {
        abort(404);
    }

    $course->load('category');

    $related = Course::where('category_id', $course->category_id)
        ->where('id', '!=', $course->id)
        ->take(4)
        ->get();

    $isEnrolled = auth()->check()
        ? $course->isEnrolledBy(auth()->user())
        : false;

    return view('courses.show', compact('course', 'related', 'isEnrolled'));
}
}
