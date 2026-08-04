<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    // READ — list all courses
    public function index()
    {
        $courses = Course::with('category')->latest()->paginate(15);

        return view('admin.courses.index', compact('courses'));
    }

    // READ — view a single course
    public function show(Course $course)
    {
        $course->load('category');

        return view('admin.courses.show', compact('course'));
    }

    // CREATE — show form
    public function create()
    {
        $categories = Category::all();

        return view('admin.courses.create', compact('categories'));
    }

    // CREATE — store new course
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'thumbnail' => ['nullable', 'url'],
            'price' => ['required', 'numeric', 'min:0'],
            'discount_price' => ['nullable', 'numeric', 'min:0', 'lt:price'],
            'instructor_name' => ['required', 'string', 'max:255'],
            'level' => ['required', 'in:beginner,intermediate,advanced'],
            'duration_hours' => ['required', 'integer', 'min:1'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['thumbnail'] = $validated['thumbnail'] ?? 'https://picsum.photos/seed/' . urlencode($validated['title']) . '/640/360';

        Course::create($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course added successfully.');
    }

    // UPDATE — show edit form
    public function edit(Course $course)
    {
        $categories = Category::all();

        return view('admin.courses.edit', compact('course', 'categories'));
    }

    // UPDATE — save changes
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'thumbnail' => ['nullable', 'url'],
            'price' => ['required', 'numeric', 'min:0'],
            'discount_price' => ['nullable', 'numeric', 'min:0', 'lt:price'],
            'instructor_name' => ['required', 'string', 'max:255'],
            'level' => ['required', 'in:beginner,intermediate,advanced'],
            'duration_hours' => ['required', 'integer', 'min:1'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        if ($validated['title'] !== $course->title) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['thumbnail'] = $validated['thumbnail'] ?? $course->thumbnail;

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    // DELETE
    public function toggleStatus(Course $course)
{
    $course->update(['is_active' => ! $course->is_active]);

    $message = $course->is_active ? 'Course activated — visible to students again.' : 'Course deactivated — hidden from students.';

    return redirect()->route('admin.courses.index')->with('success', $message);
}
}