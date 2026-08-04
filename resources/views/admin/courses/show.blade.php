@extends('layouts.admin')

@section('title', $course->title . ' — Admin')

@section('content')
<section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div class="flex items-center justify-between mb-8">
        <a href="{{ route('admin.courses.index') }}" class="text-sm font-semibold text-brand-400 hover:text-brand-300">&larr; Back to all courses</a>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.courses.edit', $course) }}" class="rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-white text-sm font-semibold px-4 py-2 transition">Edit</a>
            <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" onsubmit="return confirm('Delete this course permanently?');">
                @csrf
                @method('DELETE')
                <button class="rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 hover:bg-red-500/20 text-sm font-semibold px-4 py-2 transition">Delete</button>
            </form>
        </div>
    </div>

    <img src="{{ $course->thumbnail }}" alt="{{ $course->title }}" class="w-full rounded-2xl border border-white/10 mb-8">

    <span class="text-xs font-semibold text-brand-400 uppercase tracking-wide">{{ $course->category->name }}</span>
    <h1 class="text-3xl font-extrabold text-white mt-2 mb-4">{{ $course->title }}</h1>

    <div class="flex flex-wrap gap-4 text-sm text-gray-400 mb-8">
        <span class="capitalize px-3 py-1 rounded-full bg-surface-850 border border-white/10">{{ $course->level }}</span>
        <span>⏱ {{ $course->duration_hours }} hours</span>
        <span>👤 {{ $course->instructor_name }}</span>
        <span>💲 ${{ number_format($course->displayPrice(), 2) }}</span>
        @if($course->is_featured)
            <span class="text-brand-400">★ Featured</span>
        @endif
    </div>

    <p class="text-gray-400 leading-relaxed">{{ $course->description }}</p>
</section>
@endsection