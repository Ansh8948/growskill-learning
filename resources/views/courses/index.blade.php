@extends('layouts.app')

@section('title', 'All Courses — GrowSkill')

@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <h1 class="text-3xl font-extrabold text-white mb-8">All Courses</h1>

    <form method="GET" class="grid sm:grid-cols-4 gap-3 mb-10">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search courses..."
            class="sm:col-span-2 rounded-xl bg-surface-850 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-500">

        <select name="category" class="rounded-xl bg-surface-850 border border-white/10 px-4 py-3 text-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->slug }}" @selected(request('category') === $cat->slug)>{{ $cat->name }}</option>
            @endforeach
        </select>

        <select name="level" class="rounded-xl bg-surface-850 border border-white/10 px-4 py-3 text-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
            <option value="">All Levels</option>
            <option value="beginner" @selected(request('level') === 'beginner')>Beginner</option>
            <option value="intermediate" @selected(request('level') === 'intermediate')>Intermediate</option>
            <option value="advanced" @selected(request('level') === 'advanced')>Advanced</option>
        </select>

        <button class="sm:col-span-4 sm:w-fit rounded-xl bg-brand-600 hover:bg-brand-500 px-6 py-3 font-semibold text-white transition">Apply Filters</button>
    </form>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($courses as $course)
            @include('partials.course-card', ['course' => $course])
        @empty
            <p class="text-gray-500 col-span-full">No courses matched your filters.</p>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $courses->links() }}
    </div>
</section>
@endsection
