@extends('layouts.app')

@section('title', 'Contact Us — EduSphere')

@section('content')

    {{-- Hero --}}
    <section class="relative overflow-hidden border-b border-white/5">
        <div class="absolute inset-0 bg-gradient-to-br from-brand-600/10 via-transparent to-fuchsia-600/10"></div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <span class="inline-block px-4 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs font-medium text-gray-400 mb-6">
                Get in Touch
            </span>
            <h1 class="text-4xl sm:text-5xl font-extrabold text-white tracking-tight leading-tight">
                We'd love to <span class="bg-gradient-to-r from-brand-400 to-fuchsia-400 bg-clip-text text-transparent">hear from you</span>
            </h1>
            <p class="mt-6 text-lg text-gray-400 max-w-xl mx-auto">
                Questions about a course, a billing issue, or feedback on the platform —
                drop us a message and a real person will get back to you.
            </p>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid lg:grid-cols-3 gap-10">

            {{-- Contact info --}}
            <div class="space-y-6">
                <div class="rounded-2xl bg-surface-850 border border-white/5 p-6">
                    <div class="w-10 h-10 rounded-xl bg-brand-600/20 flex items-center justify-center text-lg mb-4">✉️</div>
                    <h3 class="text-white font-semibold mb-1">Email</h3>
                    <p class="text-sm text-gray-500">support@GrowSkill.test</p>
                </div>
                <div class="rounded-2xl bg-surface-850 border border-white/5 p-6">
                    <div class="w-10 h-10 rounded-xl bg-brand-600/20 flex items-center justify-center text-lg mb-4">💬</div>
                    <h3 class="text-white font-semibold mb-1">Response Time</h3>
                    <p class="text-sm text-gray-500">1-2 business days, Mon–Fri</p>
                </div>
                <div class="rounded-2xl bg-surface-850 border border-white/5 p-6">
                    <div class="w-10 h-10 rounded-xl bg-brand-600/20 flex items-center justify-center text-lg mb-4">📍</div>
                    <h3 class="text-white font-semibold mb-1">Location</h3>
                    <p class="text-sm text-gray-500">Remote-first, worldwide</p>
                </div>
            </div>

            {{-- Contact form --}}
            <div class="lg:col-span-2">
                <div class="rounded-2xl bg-surface-850 border border-white/5 p-6 sm:p-8">

                    @if(session('success'))
                        <div class="rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm px-4 py-3 mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm px-4 py-3 mb-6">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.send') }}" class="space-y-5">
                        @csrf
                        <div class="grid sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1.5">Full Name</label>
                                <input type="text" name="full_name" value="{{ old('full_name') }}" required
    class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1.5">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1.5">Subject</label>
                            <input type="text" name="subject" value="{{ old('subject') }}" required
                                class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1.5">Message</label>
                            <textarea name="message" rows="5" required
                                class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">{{ old('message') }}</textarea>
                        </div>
                        <button class="w-full sm:w-auto rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-semibold px-8 py-3.5 transition shadow-lg shadow-brand-600/20">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection