<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Auth::guard('teacher')->user()
            ->courses()
            ->with('category')
            ->latest()
            ->paginate(10);

        return view('teacher.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('teacher.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'thumbnail' => ['nullable', 'url'],
            'price' => ['required', 'numeric', 'min:0'],
            'discount_price' => ['nullable', 'numeric', 'min:0', 'lt:price'],
            'level' => ['required', 'in:beginner,intermediate,advanced'],
            'duration_hours' => ['required', 'integer', 'min:1'],
            'video' => ['required', 'file', 'mimes:mp4,webm,mov', 'max:512000'],
            

            
            
            
        

        ]);
        if ($request->hasFile('thumbnail')) {
    $validated['thumbnail'] = $request
        ->file('thumbnail')
        ->store('courses/thumbnails', 'public');
}

$validated['video'] = $request
    ->file('video')
    ->store('courses/videos', 'public');

        $teacher = Auth::guard('teacher')->user();

        $validated['teacher_id'] = $teacher->id;
        $validated['instructor_name'] = $teacher->name;
        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);
        $validated['thumbnail'] = $validated['thumbnail'] ?? 'https://picsum.photos/seed/' . urlencode($validated['title']) . '/640/360';
        $validated['is_featured'] = false;

        Course::create($validated);

        return redirect()->route('teacher.courses.index')->with('success', 'Course added successfully.');
    }

    public function destroy(Course $course)
    {
        // Ownership check: a teacher can only delete a course they themselves added.
        if ($course->teacher_id !== Auth::guard('teacher')->id()) {
            abort(403, 'You can only delete courses you added.');
        }

        $course->delete();

        return redirect()->route('teacher.courses.index')->with('success', 'Course deleted.');
    }
}