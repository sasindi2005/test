<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('page_title', config('app.name', 'SafePaws'))</title>

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Alpine --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: Inter, sans-serif; }
    </style>
</head>

<body class="bg-[#0f172a] text-slate-200 antialiased"
      x-data="{ sidebarOpen: false }">

    <!-- Mobile Backdrop -->
    <div
        x-show="sidebarOpen"
        @click="sidebarOpen = false"
        x-transition.opacity
        class="fixed inset-0 z-20 bg-black/80 backdrop-blur-sm md:hidden"
        style="display:none;"
    ></div>

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-[#0b1120] border-r border-white/5 transition-transform duration-300 md:relative md:translate-x-0 flex flex-col justify-between"
        >

            <!-- Logo -->
            <div>
                <div class="h-20 flex items-center px-6 border-b border-white/5 bg-[#0b1120]">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-sky-500 flex items-center justify-center text-white font-bold">LK</div>
                        <div>
                            <span class="text-lg font-bold text-white tracking-tight">SafePaws<span class="text-sky-400">.lk</span></span>
                            <div class="text-[10px] text-slate-500 uppercase tracking-widest">Vet Portal</div>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="px-3 mt-6 space-y-1">

                    <a href="{{ route('vet.dashboard') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all cursor-pointer
                       {{ request()->routeIs('dashboard') ? 'bg-sky-500/10 text-sky-400 border border-sky-500/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                        <span>Dashboard</span>
                    </a>

                    @if(Route::has('vet.branches.index'))
                        <a href="{{ route('vet.branches.index') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all cursor-pointer
                           {{ request()->routeIs('branches.*') ? 'bg-sky-500/10 text-sky-400 border border-sky-500/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <span>Branches</span>
                        </a>
                    @endif

                    @if(Route::has('vet.appointments.index'))
                        <a href="{{ route('vet.appointments.index') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all cursor-pointer
                           {{ request()->routeIs('appointments.*') ? 'bg-sky-500/10 text-sky-400 border border-sky-500/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <span>Appointments</span>
                        </a>
                    @endif

                    {{-- You can add more links later, but do same format --}}
                </nav>
            </div>

            <!-- Footer User Card -->
            <div class="p-4 border-t border-white/5 bg-[#0b1120]">
                <div class="flex items-center gap-3 w-full p-2 rounded-lg hover:bg-white/5 transition text-left">
                    <div class="w-10 h-10 rounded-full bg-slate-800 border border-white/10 flex items-center justify-center text-white font-bold">
                        DR
                    </div>
                    <div class="overflow-hidden">
                        <div class="text-sm font-medium text-white truncate">Veterinarian</div>
                        <div class="text-xs text-slate-500 truncate">SafePaws Portal</div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col relative overflow-hidden bg-[#0f172a]">

            <!-- Header -->
            <header class="h-20 flex items-center justify-between px-6 lg:px-8 border-b border-white/5 bg-[#0f172a]/90 backdrop-blur-md sticky top-0 z-20">

                <div class="flex items-center gap-4">
                    <!-- Mobile toggle -->
                    <button
                        @click="sidebarOpen = !sidebarOpen"
                        class="md:hidden text-slate-400 hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <!-- ✅ Dynamic Page Title -->
                    <div>
                        <h2 class="text-xl font-semibold text-white capitalize">
                            @yield('page_title', 'Dashboard')
                        </h2>
                        <p class="text-xs text-slate-500 mt-0.5">
                            @yield('page_subtitle', 'SafePaws.lk Management Portal')
                        </p>
                    </div>
                </div>

                <!-- Right Icons -->
                <div class="flex items-center gap-4">
                    <button class="w-10 h-10 rounded-full bg-slate-800/50 border border-white/10 flex items-center justify-center text-slate-400 hover:text-sky-400 transition relative">
                        <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                </div>
            </header>

            <!-- Page Slot -->
            <div class="flex-1 overflow-y-auto p-6 lg:p-8 scroll-smooth">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
