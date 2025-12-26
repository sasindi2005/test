<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafePaws.lk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-white min-h-screen flex items-center justify-center">

    <div class="max-w-xl text-center space-y-6">
        <h1 class="text-4xl font-bold">SafePaws.lk</h1>
        <p class="text-slate-400">
            Choose your portal
        </p>

        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('vet.dashboard') }}"
               class="px-6 py-3 rounded-xl bg-sky-500 hover:bg-sky-400 font-semibold transition">
               Vet Portal
            </a>

            <a href="{{ route('shop.index') }}"
               class="px-6 py-3 rounded-xl bg-emerald-500 hover:bg-emerald-400 font-semibold transition">
               Pet Store
            </a>
        </div>
    </div>

</body>
</html>
