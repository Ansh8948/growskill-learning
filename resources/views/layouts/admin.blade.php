<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel — GrowSkill')</title>
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
                <a href="{{ route('admin.courses.index') }}" class="flex items-center gap-2 text-white font-extrabold text-xl tracking-tight">
                    <span class="w-8 h-8 rounded-lg bg-gradient-to-br from-brand-500 to-fuchsia-500 flex items-center justify-center text-sm">GS</span>
                    GrowSkill
                    <span class="text-xs font-semibold text-brand-400 bg-brand-600/10 border border-brand-500/30 rounded-full px-2 py-0.5 ml-1">Admin</span>
                </a>

                <div class="hidden md:flex items-center gap-8 text-sm font-medium">
                    <a href="{{ route('admin.courses.index') }}" class="text-gray-300 hover:text-white transition {{ request()->routeIs('admin.courses.index') ? 'text-white' : '' }}">All Courses</a>
                    <a href="{{ route('admin.courses.create') }}" class="text-gray-300 hover:text-white transition {{ request()->routeIs('admin.courses.create') ? 'text-white' : '' }}">Add Course</a>
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition">View Site</a>
                    
                </div>

                <div class="hidden md:flex items-center gap-3">
                    <span class="text-sm text-gray-400">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm font-semibold px-4 py-2 rounded-lg bg-white/5 hover:bg-white/10 text-white transition border border-white/10">Logout</button>
                    </form>
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
            <a href="{{ route('admin.courses.index') }}" class="block px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white">All Courses</a>
            <a href="{{ route('admin.courses.create') }}" class="block px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white">Add Course</a>
            <a href="{{ route('home') }}" class="block px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white">View Site</a>
            <div class="pt-3 mt-3 border-t border-white/5">
                <p class="px-3 pb-2 text-xs text-gray-500">Logged in as {{ auth()->user()->name }}</p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left px-3 py-2.5 rounded-lg bg-white/5 text-white">Logout</button>
                </form>
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-center text-xs text-gray-600">
            &copy; {{ date('Y') }} GrowSkill Admin Panel.
        </div>
    </footer>
</body>
</html>