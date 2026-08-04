@extends('layouts.app')

@section('title', 'About — GrowSkill')

@section('content')

    {{-- Hero --}}
    <section class="relative overflow-hidden border-b border-white/5">
        <div class="absolute inset-0 bg-gradient-to-br from-brand-600/10 via-transparent to-fuchsia-600/10"></div>
        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <span class="inline-block px-4 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs font-medium text-gray-400 mb-6">
                About GrowSkill
            </span>
            <h1 class="text-4xl sm:text-5xl font-extrabold text-white tracking-tight leading-tight">
                One platform, <span class="bg-gradient-to-r from-brand-400 to-fuchsia-400 bg-clip-text text-transparent">six skill tracks</span>
            </h1>
            <p class="mt-6 text-lg text-gray-400 max-w-2xl mx-auto">
                GrowSkill brings together project-based courses across development, data,
                design, mobile, business and cloud — so you can go from curious to job-ready
                without hopping between five different platforms.
            </p>
        </div>
    </section>

    {{-- Stats --}}
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <div class="grid grid-cols-3 gap-4 sm:gap-8 text-center">
            <div class="rounded-2xl bg-surface-850 border border-white/5 py-8">
                <p class="text-3xl sm:text-4xl font-extrabold text-white">{{ $stats['courses'] }}</p>
                <p class="text-sm text-gray-500 mt-1">Courses</p>
            </div>
            <div class="rounded-2xl bg-surface-850 border border-white/5 py-8">
                <p class="text-3xl sm:text-4xl font-extrabold text-white">{{ $stats['categories'] }}</p>
                <p class="text-sm text-gray-500 mt-1">Categories</p>
            </div>
            <div class="rounded-2xl bg-surface-850 border border-white/5 py-8">
                <p class="text-3xl sm:text-4xl font-extrabold text-white">{{ $stats['students'] }}</p>
                <p class="text-sm text-gray-500 mt-1">Learners</p>
            </div>
        </div>
    </section>

    {{-- What we teach --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold text-white">What you can learn here</h2>
            <p class="text-gray-500 mt-2">Every category is taught by practitioners who work in the field, not just teach it.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categories as $category)
                <a href="{{ route('categories.show', $category) }}" class="group rounded-2xl bg-surface-850 border border-white/5 p-6 hover:border-brand-500/40 hover:-translate-y-1 transition-all">
                    <div class="text-3xl mb-4">{{ $category->icon }}</div>
                    <h3 class="text-white font-semibold group-hover:text-brand-400 transition mb-2">{{ $category->name }}</h3>
                    <p class="text-sm text-gray-500 leading-relaxed mb-4">{{ $category->description }}</p>
                    <span class="text-xs font-semibold text-brand-400">{{ $category->courses_count }} courses &rarr;</span>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Mission --}}
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="rounded-2xl bg-surface-850 border border-white/5 p-8 sm:p-10">
            <h2 class="text-2xl font-bold text-white mb-4">Our approach</h2>
            <p class="text-gray-400 leading-relaxed mb-4">
                We built GrowSkill around a simple belief: skills stick when you build
                real things, not when you watch someone else build them. Every course
                is structured around projects, checkpoints and outcomes you can point
                to — a working app, a portfolio piece, a certificate you actually earned.
            </p>
            <p class="text-gray-400 leading-relaxed">
                Whether you're switching careers, upskilling for a promotion, or just
                curious about a new field, there's a track here built for where you're
                starting from — beginner through advanced.
            </p>
        </div>
    </section>

    {{-- Acknowledgements --}}
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <h2 class="text-2xl font-bold text-white mb-6">Acknowledgements</h2>
        <div class="rounded-2xl bg-surface-850 border border-white/5 p-8 sm:p-10 space-y-4 text-gray-400 leading-relaxed">
            <p>
                GrowSkill is built with and grateful for a number of open-source
                projects and instructors who make a platform like this possible:
            </p>
            <ul class="space-y-2 list-disc list-inside marker:text-brand-400">
                <li><span class="text-white font-medium">Laravel</span> — the PHP framework powering routing, auth, the database layer and everything server-side.</li>
                <li><span class="text-white font-medium">Tailwind CSS</span> — the utility-first styling system behind this entire dark theme.</li>
                <li><span class="text-white font-medium">Alpine.js</span> — the lightweight interactivity behind the mobile menu and dropdowns.</li>
                <li><span class="text-white font-medium">Our instructors</span> — {{ \App\Models\Course::distinct('instructor_name')->count('instructor_name') }} working professionals across {{ $stats['categories'] }} fields who wrote and recorded every course.</li>
                <li><span class="text-white font-medium">Our learners</span> — every student whose feedback shapes what we build next.</li>
            </ul>
            <p class="text-sm text-gray-500 pt-2">
                Thank you for being part of it.
            </p>
        </div>
    </section>

    {{-- CTA --}}
    <section class="border-t border-white/5">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Pick a track and get started</h2>
            <a href="{{ route('courses.index') }}" class="inline-block rounded-xl bg-brand-600 hover:bg-brand-500 px-8 py-3.5 font-semibold text-white transition shadow-lg shadow-brand-600/20">
                Browse All Courses
            </a>
        </div>
    </section>

@endsection