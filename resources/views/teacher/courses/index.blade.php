@extends('layouts.teacher')

@section('title', 'TeacherCourse — Teacher Panel')

@section('content')
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-white">My Courses</h1>
            <p class="text-gray-500 text-sm mt-1">
                Welcome back, {{ auth('teacher')->user()->name }} — you've added {{ $courses->total() }} course(s)
            </p>
        </div>
        <a href="{{ route('teacher.courses.create') }}" class="rounded-xl bg-brand-600 hover:bg-brand-500 px-5 py-2.5 font-semibold text-white transition shadow-lg shadow-brand-600/20">
            + Add Course
        </a>
    </div>

    @if(session('success'))
        <div class="rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm px-4 py-3 mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($courses as $course)
            <div class="rounded-2xl bg-surface-850 border border-white/5 overflow-hidden">
                <div class="aspect-video overflow-hidden bg-surface-800">
                    <img src="{{ $course->thumbnail }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                </div>
                <div class="p-5">
                    <span class="text-xs font-medium text-brand-400">{{ $course->category->name }}</span>
                    <h3 class="text-white font-semibold mt-1 mb-3">{{ $course->title }}</h3>
                    <div class="flex items-center justify-between">
                        <span class="text-white font-bold">${{ number_format($course->displayPrice(), 2) }}</span>
                        <form method="POST" action="{{ route('teacher.courses.destroy', $course) }}" onsubmit="return confirm('Delete this course?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-xs font-semibold text-red-400 hover:text-red-300">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16">
                <p class="text-gray-500 mb-4">You haven't added any courses yet.</p>
                <a href="{{ route('teacher.courses.create') }}" class="inline-block rounded-xl bg-brand-600 hover:bg-brand-500 px-6 py-3 font-semibold text-white transition">
                    Add Your First Course
                </a>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $courses->links() }}
    </div>
</section>
@endsection