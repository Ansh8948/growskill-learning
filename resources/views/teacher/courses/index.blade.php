@extends('layouts.teacher')

@section('title', 'TeacherCourse — Teacher Panel')

@section('content')

<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

        <div>
            <h1 class="text-3xl font-extrabold text-white">
                My Courses
            </h1>

            <p class="text-gray-500 text-sm mt-1">
                Manage your courses and uploaded videos
            </p>
        </div>

        {{-- ADD NEW COURSE BUTTON --}}
        <a
            href="{{ route('teacher.courses.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand-600 hover:bg-brand-500 px-5 py-3 font-semibold text-white transition shadow-lg shadow-brand-600/20"
        >
            <span class="text-xl">+</span>
            Add New Course
        </a>

    </div>


    {{-- ========================================================= --}}
    {{-- SUCCESS MESSAGE --}}
    {{-- ========================================================= --}}

    @if(session('success'))
        <div class="rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm px-4 py-3 mb-6">
            {{ session('success') }}
        </div>
    @endif


    {{-- ========================================================= --}}
    {{-- COURSES GRID --}}
    {{-- ========================================================= --}}

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse($courses as $course)

            <div class="rounded-2xl bg-surface-850 border border-white/5 overflow-hidden">

                {{-- ================================================= --}}
                {{-- VIDEO / THUMBNAIL --}}
                {{-- ================================================= --}}

                <div class="aspect-video overflow-hidden bg-black">

                    @if($course->video)

                        <video
                            controls
                            preload="metadata"
                            class="w-full h-full object-cover"
                        >
                            <source
                                src="{{ asset('storage/' . $course->video) }}"
                                type="video/mp4"
                            >

                            Your browser does not support the video tag.
                        </video>

                    @elseif($course->thumbnail)

                        <img
                            src="{{ str_starts_with($course->thumbnail, 'http')
                                ? $course->thumbnail
                                : asset('storage/' . $course->thumbnail) }}"
                            alt="{{ $course->title }}"
                            class="w-full h-full object-cover"
                        >

                    @else

                        <div class="w-full h-full flex items-center justify-center bg-surface-800">
                            <span class="text-gray-500">
                                No Preview
                            </span>
                        </div>

                    @endif

                </div>


                {{-- ================================================= --}}
                {{-- COURSE DETAILS --}}
                {{-- ================================================= --}}

                <div class="p-5">

                    {{-- Category + Status --}}
                    <div class="flex items-center justify-between mb-2">

                        <span class="text-xs font-medium text-brand-400">
                            {{ $course->category->name }}
                        </span>


                        @if($course->is_active)

                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-500/20 text-green-400">
                                Active
                            </span>

                        @else

                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-500/20 text-red-400">
                                Inactive
                            </span>

                        @endif

                    </div>


                    {{-- Course Title --}}
                    <h3 class="text-white font-semibold mb-3">
                        {{ $course->title }}
                    </h3>


                    {{-- Price + Delete --}}
                    <div class="flex items-center justify-between">

                        <span class="text-white font-bold">
                            ${{ number_format($course->displayPrice(), 2) }}
                        </span>


                        <form
                            method="POST"
                            action="{{ route('teacher.courses.destroy', $course) }}"
                            onsubmit="return confirm('Delete this course?');"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="text-xs font-semibold text-red-400 hover:text-red-300"
                            >
                                Delete
                            </button>

                        </form>

                    </div>

                </div>

            </div>


        @empty

            {{-- ================================================= --}}
            {{-- NO COURSES --}}
            {{-- ================================================= --}}

            <div class="col-span-full text-center py-16">

                <div class="mb-4 text-5xl">
                    📚
                </div>

                <p class="text-gray-500 mb-4">
                    You haven't added any courses yet.
                </p>

                <a
                    href="{{ route('teacher.courses.create') }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-brand-600 hover:bg-brand-500 px-6 py-3 font-semibold text-white transition shadow-lg shadow-brand-600/20"
                >
                    <span class="text-xl">+</span>
                    Add Your First Course
                </a>

            </div>

        @endforelse

    </div>


    {{-- ========================================================= --}}
    {{-- PAGINATION --}}
    {{-- ========================================================= --}}

    <div class="mt-8">
        {{ $courses->links() }}
    </div>

</section>

@endsection