<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GrowSkill — Learn Without Limits')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        surface: {
                            950: '#08090c',
                            900: '#0d0f14',
                            850: '#12141b',
                            800: '#181b24',
                            700: '#242833',
                        },
                        brand: {
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                        },
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                    },
                },
            },
        };
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', ui-sans-serif, system-ui; }
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #08090c; }
        ::-webkit-scrollbar-thumb { background: #242833; border-radius: 999px; }
    </style>
</head>
<body class="bg-surface-950 text-gray-200 antialiased min-h-screen flex flex-col">

     <nav x-data="{ open: false }" class="sticky top-0 z-50 bg-surface-950/90 backdrop-blur border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-white font-extrabold text-xl tracking-tight">
                    <span class="w-8 h-8 rounded-lg bg-gradient-to-br from-brand-500 to-fuchsia-500 flex items-center justify-center text-sm">GS</span>
                    GrowSkill
                </a>

                <div class="hidden md:flex items-center gap-8 text-sm font-medium">
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition {{ request()->routeIs('home') ? 'text-white' : '' }}">Home</a>
                    <a href="{{ route('courses.index') }}" class="text-gray-300 hover:text-white transition {{ request()->routeIs('courses.*') ? 'text-white' : '' }}">Courses</a>
                    <div class="relative" x-data="{ catOpen: false }" @mouseleave="catOpen = false">
                        <button @mouseenter="catOpen = true" @click="catOpen = !catOpen" class="text-gray-300 hover:text-white transition flex items-center gap-1">
                            Categories
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="catOpen" x-transition x-cloak class="absolute left-0 mt-3 w-64 rounded-xl bg-surface-850 border border-white/10 shadow-2xl p-2">
                            @foreach(\App\Models\Category::all() as $navCategory)
                                <a href="{{ route('categories.show', $navCategory) }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-300 hover:bg-white/5 hover:text-white transition">
                                    <span>{{ $navCategory->icon }}</span> {{ $navCategory->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="hidden md:flex items-center gap-3">
                    @if(\Illuminate\Support\Facades\Auth::guard('teacher')->check())
                        <span class="text-sm text-gray-500">Hi, {{ Auth::guard('teacher')->user()->name }}</span>
                        <a href="{{ route('teacher.courses.index') }}" class="text-sm font-medium text-gray-300 hover:text-white transition">Teacher Panel</a>
                        <form method="POST" action="{{ route('teacher.logout') }}">
                            @csrf
                            <button class="text-sm font-semibold px-4 py-2 rounded-lg bg-white/5 hover:bg-white/10 text-white transition border border-white/10">Teacher Logout</button>
                        </form>
                    @elseif(auth()->check())
                        <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-300 hover:text-white transition">My Courses</a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.courses.index') }}" class="text-sm font-medium text-gray-300 hover:text-white transition">Admin</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="text-sm font-semibold px-4 py-2 rounded-lg bg-white/5 hover:bg-white/10 text-white transition border border-white/10">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-300 hover:text-white transition">Log in</a>
                        <a href="{{ route('register') }}" class="text-sm font-semibold px-4 py-2 rounded-lg bg-brand-600 hover:bg-brand-500 text-white transition shadow-lg shadow-brand-600/20">Get Started</a>
                    @endif
                </div>

                <button @click="open = !open" class="md:hidden text-gray-300 hover:text-white">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <div x-show="open" x-cloak x-transition class="md:hidden border-t border-white/5 px-4 pb-4 space-y-1 bg-surface-950">
            <a href="{{ route('home') }}" class="block px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white">Home</a>
            <a href="{{ route('courses.index') }}" class="block px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white">Courses</a>
            @foreach(\App\Models\Category::all() as $navCategory)
                <a href="{{ route('categories.show', $navCategory) }}" class="block px-3 py-2.5 rounded-lg text-gray-400 hover:bg-white/5 hover:text-white text-sm">{{ $navCategory->icon }} {{ $navCategory->name }}</a>
            @endforeach
            <div class="pt-3 mt-3 border-t border-white/5 flex flex-col gap-2">
                @if(\Illuminate\Support\Facades\Auth::guard('teacher')->check())
<p class="text-2xl px-3 pb-1 font-bold text-white text-size">
    Hi, {{ Auth::guard('teacher')->user()->name }}
</p>                    <a href="{{ route('teacher.courses.index') }}" class="block px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white">Teacher Panel</a>
                    <form method="POST" action="{{ route('teacher.logout') }}">
                        @csrf
                        <button class="w-full text-left px-3 py-2.5 rounded-lg bg-white/5 text-white">Teacher Logout</button>
                    </form>
                @elseif(auth()->check())
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white">My Courses</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.courses.index') }}" class="block px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white">Admin</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full text-left px-3 py-2.5 rounded-lg bg-white/5 text-white">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white">Log in</a>
                    <a href="{{ route('register') }}" class="block px-3 py-2.5 rounded-lg bg-brand-600 text-white text-center font-semibold">Get Started</a>
                @endif
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm rounded-xl px-4 py-3">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="border-t border-white/5 mt-20 bg-surface-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="col-span-2 md:col-span-1">
                <div class="flex items-center gap-2 text-white font-extrabold text-lg mb-3">
                    <span class="w-7 h-7 rounded-lg bg-gradient-to-br from-brand-500 to-fuchsia-500 flex items-center justify-center text-xs">GS</span>
                    GrowSkill
                </div>
                <p class="text-sm text-gray-500">Practical courses to help you build real skills, faster.</p>
            </div>
            <div>
                <h4 class="text-white font-semibold text-sm mb-3">Explore</h4>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li><a href="{{ route('courses.index') }}" class="hover:text-gray-300">All Courses</a></li>
                    @foreach(\App\Models\Category::take(3)->get() as $footerCat)
                        <li><a href="{{ route('categories.show', $footerCat) }}" class="hover:text-gray-300">{{ $footerCat->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold text-sm mb-3">Account</h4>
                <ul class="space-y-2 text-sm text-gray-500">
                  <a href="{{ route('teacher.register') }}" class="hover:text-gray-300">Become a Teacher</a>          
                  <li><a href="{{ route('teacher.register') }}" class="hover:text-gray-300">Create account</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold text-sm mb-3">Company</h4>
                <ul class="space-y-2 text-sm text-gray-500">
       <li>
           <a href="{{ route('about') }}" class="hover:text-gray-300 transition">
               About
           </a>
       </li>               
      <li>
           <a href="{{ route('contact') }}" class="hover:text-gray-300 transition">
        Contact
          </a>
       </li> 
                </ul>
            </div>
        </div>
        <div class="border-t border-white/5 py-5 text-center text-xs text-gray-600">
            &copy; {{ date('Y') }} GrowSkill. All rights reserved.
        </div>
    </footer>
</body>
</html>