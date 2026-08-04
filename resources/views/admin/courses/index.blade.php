@extends('layouts.admin')

@section('title', 'Manage Courses — Admin')

@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-white">Manage Courses</h1>
            <p class="text-gray-500 text-sm mt-1">{{ $courses->total() }} courses in the database</p>
        </div>
        <a href="{{ route('admin.courses.create') }}" class="rounded-xl bg-brand-600 hover:bg-brand-500 px-5 py-2.5 font-semibold text-white transition shadow-lg shadow-brand-600/20">
            + Add Course
        </a>
    </div>

    @if(session('success'))
        <div class="rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm px-4 py-3 mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-2xl bg-surface-850 border border-white/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-surface-800 text-gray-400 uppercase text-xs">
                    <tr>
                        <th class="px-5 py-3">Course</th>
                        <th class="px-5 py-3">Category</th>
                        <th class="px-5 py-3">Level</th>
                        <th class="px-5 py-3">Price</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3">Added</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($courses as $course)
                        <tr class="hover:bg-white/5 transition {{ ! $course->is_active ? 'opacity-50' : '' }}">
                            <td class="px-5 py-3">
                                <a href="{{ route('admin.courses.show', $course) }}" class="text-white font-medium hover:text-brand-400">{{ $course->title }}</a>
                            </td>
                            <td class="px-5 py-3 text-gray-400">{{ $course->category->name }}</td>
                            <td class="px-5 py-3 text-gray-400 capitalize">{{ $course->level }}</td>
                            <td class="px-5 py-3 text-white">${{ number_format($course->displayPrice(), 2) }}</td>
                            <td class="px-5 py-3">
                                @if($course->is_active)
                                    <span class="text-xs font-semibold px-2 py-1 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/30">Active</span>
                                @else
                                    <span class="text-xs font-semibold px-2 py-1 rounded-full bg-gray-500/10 text-gray-400 border border-gray-500/30">Inactive</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-gray-500">{{ $course->created_at->diffForHumans() }}</td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.courses.edit', $course) }}" class="text-xs font-semibold text-brand-400 hover:text-brand-300">Edit</a>
                                    <form method="POST" action="{{ route('admin.courses.toggle-status', $course) }}">
                                        @csrf
                                        @method('PATCH')
                                        @if($course->is_active)
                                            <button class="text-xs font-semibold text-yellow-400 hover:text-yellow-300">Deactivate</button>
                                        @else
                                            <button class="text-xs font-semibold text-emerald-400 hover:text-emerald-300">Activate</button>
                                        @endif
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-5 py-8 text-center text-gray-500">No courses yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8">
        {{ $courses->links() }}
    </div>
</section>
@endsection