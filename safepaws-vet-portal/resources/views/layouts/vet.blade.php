<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SafePaws') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-white min-h-screen">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-72 bg-slate-900/40 border-r border-white/10 hidden lg:block">
        <div class="p-6">
            <h1 class="text-xl font-bold text-sky-400">SafePaws Vet</h1>
            <p class="text-xs text-slate-400 mt-1">Veterinary Portal</p>
        </div>

        <nav class="px-3 space-y-2">

            <a href="{{ route('vet.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
               {{ request()->routeIs('vet.dashboard') ? 'bg-sky-500/10 text-sky-400 border border-sky-500/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                Dashboard
            </a>

            <a href="{{ route('vet.branches.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
               {{ request()->routeIs('vet.branches.*') ? 'bg-sky-500/10 text-sky-400 border border-sky-500/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                Branches
            </a>

            <a href="{{ route('vet.appointments.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
               {{ request()->routeIs('vet.appointments.*') ? 'bg-sky-500/10 text-sky-400 border border-sky-500/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                Appointments
            </a>

            <a href="{{ route('vet.treatments.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
               {{ request()->routeIs('vet.treatments.*') ? 'bg-sky-500/10 text-sky-400 border border-sky-500/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                Treatments
            </a>

            <a href="{{ route('home') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
               text-slate-400 hover:text-white hover:bg-white/5">
                Back to Home
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1">
        <header class="px-6 py-4 border-b border-white/10 bg-slate-900/20">
            <h2 class="text-lg font-semibold">@yield('title', 'Dashboard')</h2>
        </header>

        <div class="p-6">
            @yield('content')
        </div>
    </main>

</div>

</body>
</html>
