<!-- @extends('layouts.teacher') -->

@section('title', 'Become a Teacher — GrowSkill')

@section('content')
<section class="max-w-md mx-auto px-4 py-20">
    <div class="text-center mb-8">
        <span class="inline-block px-3 py-1 rounded-full bg-brand-600/20 text-brand-400 text-xs font-semibold mb-4">
            Teach on GrowSkill
        </span>
        <h1 class="text-2xl font-extrabold text-white mb-1">Become a Teacher</h1>
        <p class="text-gray-500 text-sm">Create a teacher account to publish and manage your own courses.</p>
    </div>

    @if($errors->any())
        <div class="rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm px-4 py-3 mb-6">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('teacher.register') }}" class="space-y-5 rounded-2xl bg-surface-850 border border-white/5 p-6 sm:p-8">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1.5">Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus
                class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1.5">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1.5">Short Bio <span class="text-gray-600">(optional)</span></label>
            <textarea name="bio" rows="3" class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">{{ old('bio') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1.5">Password</label>
            <input type="password" name="password" required
                class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1.5">Confirm Password</label>
            <input type="password" name="password_confirmation" required
                class="w-full rounded-xl bg-surface-800 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
        </div>
        <button class="w-full rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-semibold py-3.5 transition shadow-lg shadow-brand-600/20">
            Create Teacher Account
        </button>
    </form>

    <p class="text-center text-sm text-gray-600 mt-6">
        Already teaching here? <a href="{{ route('teacher.login') }}" class="text-brand-400 font-semibold hover:text-brand-300">Log in</a>
    </p>
</section>
@endsection