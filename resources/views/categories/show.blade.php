@extends('layouts.app')

@section('title', $category->name . ' Courses — EduSphere')

@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div class="flex items-center gap-4 mb-2">
        <div class="w-14 h-14 rounded-2xl bg-surface-850 border border-white/10 flex items-center justify-center text-2xl">{{ $category->icon }}</div>
        <div>
            <h1 class="text-3xl font-extrabold text-white">{{ $category->name }}</h1>
            <p class="text-gray-500 text-sm">{{ $courses->total() }} courses</p>
        </div>
    </div>
    @if($category->description)
        <p class="text-gray-400 max-w-2xl mt-4">{{ $category->description }}</p>
    @endif

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
        @forelse($courses as $course)
            @include('partials.course-card', ['course' => $course])
        @empty
            <p class="text-gray-500 col-span-full">No courses in this category yet.</p>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $courses->links() }}
    </div>
</section>
@endsection
