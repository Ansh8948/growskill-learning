@extends('layouts.app')

@section('title', 'GrowSkill — Learn Without Limits')

@section('content')

    {{-- Hero --}}
    <section class="relative overflow-hidden border-b border-white/5">
        <div class="absolute inset-0 bg-gradient-to-br from-brand-600/10 via-transparent to-fuchsia-600/10"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 text-center">
            <span class="inline-block px-4 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs font-medium text-gray-400 mb-6">
                🚀 Over {{ \App\Models\Course::count() }} courses across {{ \App\Models\Category::count() }} categories
            </span>
            <h1 class="text-4xl sm:text-6xl font-extrabold text-white tracking-tight leading-tight">
                Learn skills that<br class="hidden sm:block"> <span class="bg-gradient-to-r from-brand-400 to-fuchsia-400 bg-clip-text text-transparent">actually pay off</span>
            </h1>
            <p class="mt-6 text-lg text-gray-400 max-w-2xl mx-auto">
                Project-based courses in development, design, data and business — taught by working professionals, built for real careers.
            </p>

            <form action="{{ route('courses.index') }}" method="GET" class="mt-10 max-w-xl mx-auto flex flex-col sm:flex-row gap-3">
                <input type="text" name="search" placeholder="What do you want to learn?"
                    class="flex-1 rounded-xl bg-surface-850 border border-white/10 px-5 py-3.5 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-500">
                <button class="rounded-xl bg-brand-600 hover:bg-brand-500 px-6 py-3.5 font-semibold text-white transition shadow-lg shadow-brand-600/20">
                    Search Courses
                </button>
            </form>
        </div>
    </section>

    {{-- Categories --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-white">Browse by Category</h2>
            <a href="{{ route('courses.index') }}" class="text-sm font-semibold text-brand-400 hover:text-brand-300">View all &rarr;</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('categories.show', $category) }}" class="group rounded-2xl bg-surface-850 border border-white/5 p-5 text-center hover:border-brand-500/40 hover:-translate-y-1 transition-all">
                    <div class="text-3xl mb-3">{{ $category->icon }}</div>
                    <h3 class="text-sm font-semibold text-white group-hover:text-brand-400 transition">{{ $category->name }}</h3>
                    <p class="text-xs text-gray-500 mt-1">{{ $category->courses_count }} courses</p>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Featured --}}
    @if($featuredCourses->count())
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-white">Featured Courses</h2>
            <a href="{{ route('courses.index') }}" class="text-sm font-semibold text-brand-400 hover:text-brand-300">View all &rarr;</a>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredCourses as $course)
                @include('partials.course-card', ['course' => $course])
            @endforeach
        </div>
    </section>
    @endif

    {{-- Latest --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-white">Newest Courses</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($latestCourses as $course)
                @include('partials.course-card', ['course' => $course])
            @endforeach
        </div>
    </section>

    {{-- CTA --}}
    <section class="border-t border-white/5">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Ready to start learning?</h2>
            <p class="text-gray-400 mb-8">Create a free account and enroll in your first course today.</p>
            <a href="{{ route('register') }}" class="inline-block rounded-xl bg-brand-600 hover:bg-brand-500 px-8 py-3.5 font-semibold text-white transition shadow-lg shadow-brand-600/20">
                Create Free Account
            </a>
        </div>
    </section>

@endsection
