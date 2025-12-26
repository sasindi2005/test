<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafePaws - Settings</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style type="text/tailwindcss">
        body {
            background-color: #071331;
            color: #ffffff;
            font-family: "Segoe UI", system-ui;
        }

        .glass-card {
            @apply bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl shadow-lg p-6;
        }

        .nav-link {
            @apply flex items-center gap-3 px-4 py-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-lg transition-all;
        }

        .nav-link.active {
            @apply bg-blue-500/20 text-blue-400 border-l-4 border-blue-400;
        }
    </style>
</head>

<body class="min-h-screen">
<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#0b2447]/80 backdrop-blur-sm border-r border-white/10 hidden lg:block">

        <div class="p-6 border-b border-white/10">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-[#0ea5e9] rounded-xl flex items-center justify-center">
                    <i class="fas fa-paw text-white"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold">SafePaws</h1>
                    <p class="text-xs text-gray-400">Admin Dashboard</p>
                </div>
            </a>
        </div>

        <nav class="p-4 space-y-1">

            <a href="{{ url('/') }}" class="nav-link">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>

            <a href="{{ url('/reports') }}" class="nav-link">
                <i class="fas fa-flag"></i> Animal Reports
            </a>

            <a href="{{ url('/rescues') }}" class="nav-link">
                <i class="fas fa-ambulance"></i> Rescue Operations
            </a>

            <a href="{{ url('/adoptions') }}" class="nav-link">
                <i class="fas fa-home"></i> Adoptions
            </a>

            <a href="{{ url('/users') }}" class="nav-link">
                <i class="fas fa-users"></i> Users & Teams
            </a>

            <a href="{{ url('/veterinarians') }}" class="nav-link">
                <i class="fas fa-stethoscope"></i> Vet Collaborators
            </a>

            <a href="{{ url('/donations') }}" class="nav-link">
                <i class="fas fa-donate"></i> Donations
            </a>

            <a href="{{ url('/ecommerce') }}" class="nav-link">
                <i class="fas fa-shopping-cart"></i> E-commerce
            </a>

            <a href="{{ url('/analytics') }}" class="nav-link">
                <i class="fas fa-chart-bar"></i> Analytics
            </a>

            <a href="{{ url('/settings') }}" class="nav-link active">
                <i class="fas fa-cog"></i> Settings
            </a>

        </nav>

    </aside>

    <!-- Main Content -->
    <div class="flex-1">

        <header class="sticky top-0 bg-[#0b2447]/90 backdrop-blur-sm border-b border-white/10 px-6 py-4">
            <h2 class="text-2xl font-bold">Settings</h2>
            <p class="text-gray-400 text-sm">Manage system configurations & preferences</p>
        </header>

        <main class="p-6 space-y-6">

            <div class="glass-card">
                <h3 class="text-xl font-semibold mb-4">General Settings</h3>

                <label class="block mb-4">
                    <span class="text-gray-300">Site Name</span>
                    <input type="text" class="w-full mt-1 bg-white/10 border border-white/20 rounded-lg p-2 text-white" value="SafePaws">
                </label>

                <label class="block mb-4">
                    <span class="text-gray-300">Support Email</span>
                    <input type="email" class="w-full mt-1 bg-white/10 border border-white/20 rounded-lg p-2 text-white" value="support@safepaws.com">
                </label>

                <button class="px-4 py-2 bg-blue-500 hover:bg-blue-600 rounded-lg">Save Settings</button>
            </div>

            <div class="glass-card">
                <h3 class="text-xl font-semibold mb-4">Security Settings</h3>

                <label class="flex items-center gap-3 mb-3">
                    <input type="checkbox" checked class="w-5 h-5">
                    <span>Enable Two-Factor Authentication</span>
                </label>

                <label class="flex items-center gap-3 mb-3">
                    <input type="checkbox" checked class="w-5 h-5">
                    <span>Alert me for new login attempts</span>
                </label>

                <button class="px-4 py-2 bg-blue-500 hover:bg-blue-600 rounded-lg">Update Security</button>
            </div>

        </main>
    </div>

</div>
</body>
</html>
