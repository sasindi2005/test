<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafePaws Shop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-white min-h-screen">

<header class="border-b border-white/10 bg-slate-900/20">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <a href="{{ route('home') }}" class="text-lg font-bold text-emerald-400">
            🐾 SafePaws Shop
        </a>

        <nav class="flex gap-4 text-sm">
            <a href="{{ route('shop.index') }}" class="text-slate-300 hover:text-white">Shop</a>
            <a href="{{ route('checkout') }}" class="text-slate-300 hover:text-white">Checkout</a>
            <a href="{{ route('vet.dashboard') }}" class="text-slate-300 hover:text-white">Vet Portal</a>
        </nav>
    </div>
</header>

<main class="max-w-7xl mx-auto px-6 py-8">
    @yield('content')
</main>

<footer class="border-t border-white/10 mt-10 py-6 text-center text-xs text-slate-400">
    © {{ date('Y') }} SafePaws. All rights reserved.
</footer>

</body>
</html>
