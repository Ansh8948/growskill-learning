@extends('layouts.admin')

@section('title', 'Forgot Password — GrowSkill')

@section('content')
<section class="max-w-md mx-auto px-4 py-20">
    <h1 class="text-2xl font-extrabold text-white mb-1">Reset your password</h1>
    <p class="text-gray-500 text-sm mb-8">Enter your email and we'll send you a reset link.</p>

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

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1.5">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full rounded-xl bg-surface-850 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
        </div>
        <button class="w-full rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-semibold py-3.5 transition shadow-lg shadow-brand-600/20">
            Send Reset Link
        </button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-6">
        <a href="{{ route('login') }}" class="text-brand-400 font-semibold hover:text-brand-300">Back to login</a>
    </p>
</section>
@endsection