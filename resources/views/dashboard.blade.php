@extends('layouts.app')

@section('title', 'My Courses — GrowSkill')

@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <h1 class="text-3xl font-extrabold text-white mb-1">My Courses</h1>
    <p class="text-gray-500 text-sm mb-10">Welcome back, {{ auth()->user()->name }}. You're enrolled in {{ $enrollments->count() }} course(s).</p>

    @if(session('success'))
        <div class="rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm px-4 py-3 mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($enrollments as $enrollment)
            <div class="group rounded-2xl bg-surface-850 border border-white/5 overflow-hidden hover:border-brand-500/40 transition-all">
                <a href="{{ route('courses.show', $enrollment->course) }}" class="block">
                    <div class="aspect-video overflow-hidden bg-surface-800">
                        <img src="{{ $enrollment->course->thumbnail }}" alt="{{ $enrollment->course->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="px-5 pt-5">
                        <span class="text-xs font-medium text-brand-400">{{ $enrollment->course->category->name }}</span>
                        <h3 class="text-white font-semibold mt-1 group-hover:text-brand-400 transition">{{ $enrollment->course->title }}</h3>
                        <p class="text-xs text-gray-500 mt-2">Enrolled {{ $enrollment->created_at->diffForHumans() }}</p>
                    </div>
                </a>
                <div class="px-5 pb-5 pt-3">
                    <form method="POST" action="{{ route('dashboard.destroy', $enrollment) }}" onsubmit="return confirm('Remove this course from your dashboard?');">
                        @csrf
                        @method('DELETE')
                        <button class="text-xs font-semibold text-red-400 hover:text-red-300">Remove</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16">
                <p class="text-gray-500 mb-4">You haven't enrolled in any courses yet.</p>
                <a href="{{ route('courses.index') }}" class="inline-block rounded-xl bg-brand-600 hover:bg-brand-500 px-6 py-3 font-semibold text-white transition">
                    Browse Courses
                </a>
            </div>
        @endforelse
    </div>
</section>
@endsection