@extends('layouts.teacher')

@section('title', 'Reset Password — Teacher Panel')

@section('content')
<section class="max-w-md mx-auto px-4 py-20">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-extrabold text-white mb-1">Set a new password</h1>
    </div>

    @if($errors->any())
        <div class="rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm px-4 py-3 mb-6">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('teacher.password.update') }}" class="space-y-5 rounded-2xl bg-surface-850 border border-white/5 p-6 sm:p-8">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1.5">Email</label>
            <input type="email" name="email" value="{{ old('email', $email) }}" required autofocus
                class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1.5">New Password</label>
            <input type="password" name="password" required
                class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1.5">Confirm New Password</label>
            <input type="password" name="password_confirmation" required
                class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
        </div>
        <button class="w-full rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-semibold py-3.5 transition shadow-lg shadow-brand-600/20">
            Reset Password
        </button>
    </form>
</section>
@endsection