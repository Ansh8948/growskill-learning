@extends('layouts.app')

@section('title', 'Log In — GrowSkill')

@section('content')

@php
$rememberEmail = request()->cookie('remember_email');
@endphp

<section class="max-w-md mx-auto px-4 py-20">
    <h1 class="text-2xl font-extrabold text-white mb-1">Welcome back</h1>
    <p class="text-gray-500 text-sm mb-8">Log in to continue learning.</p>

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

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1.5">Email</label>
            <input type="email" name="email" value="{{ old('email', $rememberEmail) }}" required autofocus
                class="w-full rounded-xl bg-surface-850 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
        </div>

        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label class="block text-sm font-medium text-gray-400">Password</label>
            </div>

            <input type="password" name="password" required
                class="w-full rounded-xl bg-surface-850 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-sm text-gray-400">
                <input type="checkbox" name="remember" value="1" {{ $rememberEmail ? 'checked' : '' }}
                    class="rounded border-white/20 bg-surface-850 text-brand-600 focus:ring-brand-500">
                Remember me
            </label>

            <a href="{{ route('password.request') }}" class="text-xs font-semibold text-brand-400 hover:text-brand-300">
                Forgot password?
            </a>
        </div>

        <button type="submit"
            class="w-full rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-semibold py-3.5 transition shadow-lg shadow-brand-600/20">
            Log In
        </button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-6">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-brand-400 font-semibold hover:text-brand-300">
            Sign up
        </a>
    </p>
</section>

@endsection