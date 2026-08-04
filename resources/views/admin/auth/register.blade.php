@extends('layouts.admin')

@section('title', 'Create Account — GrowSkill')

@section('content')
<section class="max-w-md mx-auto px-4 py-20">
    <h1 class="text-2xl font-extrabold text-white mb-1">Create your account</h1>
    <p class="text-gray-500 text-sm mb-8">Start learning in minutes — it's free.</p>

    @if($errors->any())
        <div class="rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm px-4 py-3 mb-6">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1.5">Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus
                class="w-full rounded-xl bg-surface-850 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1.5">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                class="w-full rounded-xl bg-surface-850 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1.5">Password</label>
            <input type="password" name="password" required
                class="w-full rounded-xl bg-surface-850 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1.5">Confirm Password</label>
            <input type="password" name="password_confirmation" required
                class="w-full rounded-xl bg-surface-850 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
        </div>
        <button class="w-full rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-semibold py-3.5 transition shadow-lg shadow-brand-600/20">
            Create Account
        </button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-6">
        Already have an account? <a href="{{ route('login') }}" class="text-brand-400 font-semibold hover:text-brand-300">Log in</a>
    </p>
</section>
@endsection
