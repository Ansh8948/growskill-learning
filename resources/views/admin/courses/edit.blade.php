@extends('layouts.admin')

@section('title', 'Edit Course — Admin')

@section('content')
<section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-extrabold text-white">Edit Course</h1>
        <a href="{{ route('admin.courses.index') }}" class="text-sm font-semibold text-brand-400 hover:text-brand-300">View all courses &rarr;</a>
    </div>

    @if($errors->any())
        <div class="rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm px-4 py-3 mb-6">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.courses.update', $course) }}" class="rounded-2xl bg-surface-850 border border-white/5 p-6 sm:p-8 space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1.5">Title</label>
            <input type="text" name="title" value="{{ old('title', $course->title) }}" required
                class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
        </div>

        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1.5">Category</label>
                <select name="category_id" required
                    class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $course->category_id) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1.5">Level</label>
                <select name="level" required
                    class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                    <option value="beginner" @selected(old('level', $course->level) === 'beginner')>Beginner</option>
                    <option value="intermediate" @selected(old('level', $course->level) === 'intermediate')>Intermediate</option>
                    <option value="advanced" @selected(old('level', $course->level) === 'advanced')>Advanced</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1.5">Description</label>
            <textarea name="description" rows="4" required
                class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">{{ old('description', $course->description) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1.5">Thumbnail URL <span class="text-gray-600">(optional)</span></label>
            <input type="url" name="thumbnail" value="{{ old('thumbnail', $course->thumbnail) }}" placeholder="https://..."
                class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
        </div>

        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1.5">Price ($)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $course->price) }}" required
                    class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1.5">Discount Price ($) <span class="text-gray-600">(optional)</span></label>
                <input type="number" step="0.01" name="discount_price" value="{{ old('discount_price', $course->discount_price) }}"
                    class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1.5">Instructor Name</label>
                <input type="text" name="instructor_name" value="{{ old('instructor_name', $course->instructor_name) }}" required
                    class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1.5">Duration (hours)</label>
                <input type="number" name="duration_hours" value="{{ old('duration_hours', $course->duration_hours) }}" required
                    class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>
        </div>

        <label class="flex items-center gap-2 text-sm text-gray-400">
            <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $course->is_featured))
                class="rounded border-white/20 bg-surface-800 text-brand-600 focus:ring-brand-500">
            Feature this course on the homepage
        </label>

        <div class="flex items-center gap-3">
            <button class="rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-semibold px-8 py-3.5 transition shadow-lg shadow-brand-600/20">
                Save Changes
            </button>
            <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" onsubmit="return confirm('Delete this course permanently?');">
                @csrf
                @method('DELETE')
                <button class="rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 hover:bg-red-500/20 font-semibold px-6 py-3.5 transition">
                    Delete Course
                </button>
            </form>
        </div>
    </form>
</section>
@endsection