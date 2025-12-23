<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SafePaws LK</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-900 text-white min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md px-6">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-sky-500 mb-2">SafePaws LK</h1>
            <p class="text-slate-400">Veterinary Portal</p>
        </div>

        <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700 rounded-2xl p-8">
            <h2 class="text-2xl font-bold mb-6">Login to Your Account</h2>

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-500/20 border border-red-500 rounded-lg text-red-400 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium mb-2">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                           class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-sky-500 transition-all"
                           placeholder="vet@safepaws.lk">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium mb-2">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-sky-500 transition-all"
                           placeholder="••••••••">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember"
                           class="w-4 h-4 bg-slate-700 border-slate-600 rounded text-sky-500 focus:ring-2 focus:ring-sky-500">
                    <label for="remember" class="ml-2 text-sm text-slate-300">Remember me</label>
                </div>

                <button type="submit"
                        class="w-full bg-sky-500 hover:bg-sky-600 text-white font-semibold py-3 rounded-lg transition-colors">
                    Sign In
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-slate-700">
                <p class="text-sm text-slate-400 text-center">
                    Demo credentials: <span class="text-sky-400">vet@safepaws.lk</span> / <span class="text-sky-400">password</span>
                </p>
            </div>
        </div>

        <p class="text-center text-slate-500 text-sm mt-6">
            SafePaws LK &copy; 2024 - All rights reserved
        </p>
    </div>
</body>
</html>
