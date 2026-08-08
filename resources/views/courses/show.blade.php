@extends('layouts.app')

@section('title', $course->title . ' — GrowSkill')

@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <nav class="text-xs text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-gray-300">Home</a> /
        <a href="{{ route('categories.show', $course->category) }}"
            class="hover:text-gray-300">{{ $course->category->name }}</a> /
        <span class="text-gray-400">{{ $course->title }}</span>
    </nav>

    <div class="grid lg:grid-cols-3 gap-10">
        <div class="lg:col-span-2">
            <span
                class="text-xs font-semibold text-brand-400 uppercase tracking-wide">{{ $course->category->name }}</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white mt-2 mb-4">{{ $course->title }}</h1>
            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-400 mb-8">
                <span
                    class="capitalize px-3 py-1 rounded-full bg-surface-850 border border-white/10">{{ $course->level }}</span>
                <span>⏱ {{ $course->duration_hours }} hours</span>
                <span>👤 {{ $course->instructor_name }}</span>
                <span>🎓 {{ $course->students()->count() }} students enrolled</span>
            </div>

            @if($course->video)

            <div class="w-full rounded-2xl overflow-hidden border border-white/10 bg-black mb-8">

                <video controls preload="metadata" class="w-full aspect-video">
                    <source src="{{ asset('storage/' . $course->video) }}" type="video/mp4">

                    Your browser does not support the video tag.
                </video>

            </div>

            @else

            <img src="{{ $course->thumbnail }}" alt="{{ $course->title }}"
                class="w-full rounded-2xl border border-white/10 mb-8">

            @endif
            <h2 class="text-xl font-bold text-white mb-3">About this course</h2>
            <p class="text-gray-400 leading-relaxed">{{ $course->description }}</p>

            @if($related->count())
            <div class="mt-14">
                <h2 class="text-xl font-bold text-white mb-6">Related Courses</h2>
                <div class="grid sm:grid-cols-2 gap-6">
                    @foreach($related as $r)
                    @include('partials.course-card', ['course' => $r])
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <div>
            <div class="sticky top-24 rounded-2xl bg-surface-850 border border-white/10 p-6">
                <div class="flex items-baseline gap-3 mb-1">
                    <span
                        class="text-3xl font-extrabold text-white">${{ number_format($course->displayPrice(), 2) }}</span>
                    @if($course->discount_price)
                    <span class="text-gray-500 line-through">${{ number_format($course->price, 2) }}</span>
                    @endif
                </div>
                @if($course->discount_price)
                <p class="text-sm text-brand-400 font-medium mb-6">
                    Save {{ round((1 - $course->discount_price / $course->price) * 100) }}% today
                </p>
                @else
                <div class="mb-6"></div>
                @endif

                @auth
                @if($isEnrolled)
                <div
                    class="w-full text-center rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 font-semibold py-3.5 mb-3">
                    ✓ You're enrolled
                </div>
                <a href="{{ route('dashboard') }}"
                    class="block w-full text-center rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-white font-semibold py-3.5 transition">
                    Go to My Courses
                </a>
                @else
                <form action="{{ route('courses.enroll', $course) }}" method="POST">
                    @csrf
                    <button
                        class="w-full rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-semibold py-3.5 transition shadow-lg shadow-brand-600/20">
                        Enroll Now
                    </button>
                </form>
                @endif
                @else
                <a href="{{ route('login') }}"
                    class="block w-full text-center rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-semibold py-3.5 transition shadow-lg shadow-brand-600/20">
                    Log in to Enroll
                </a>
                @endauth

                <ul class="mt-6 space-y-2 text-sm text-gray-400">
                    <li>✔ Full lifetime access</li>
                    <li>✔ {{ $course->duration_hours }} hours of content</li>
                    <li>✔ Certificate of completion</li>
                    <li>✔ Access on mobile and desktop</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection