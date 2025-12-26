<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafePaws - Analytics</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style type="text/tailwindcss">
        :root {
            --primary: #0ea5e9;
            --dark: #0b2447;
        }

        body {
            background-color: #071331;
            color: #ffffff;
            font-family: "Segoe UI", system-ui;
        }

        .glass-card {
            @apply bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl shadow-lg p-6;
        }

        .nav-link {
            @apply flex items-center gap-3 px-4 py-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300;
        }

        .nav-link.active {
            @apply bg-[#0ea5e9]/20 text-[#0ea5e9] border-l-4 border-[#0ea5e9];
        }
    </style>
</head>

<body class="min-h-screen">
<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#0b2447]/80 backdrop-blur-sm border-r border-white/10 hidden lg:block">

        <!-- Logo -->
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

        <!-- Navigation -->
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

            <a href="{{ url('/analytics') }}" class="nav-link active">
                <i class="fas fa-chart-bar"></i> Analytics
            </a>

            <a href="{{ url('/settings') }}" class="nav-link">
                <i class="fas fa-cog"></i> Settings
            </a>
        </nav>

    </aside>

    <!-- Main Content -->
    <div class="flex-1 overflow-auto">

        <!-- Header -->
        <header class="sticky top-0 bg-[#0b2447]/95 backdrop-blur-sm border-b border-white/10 px-6 py-4">
            <h2 class="text-2xl font-bold">Analytics</h2>
            <p class="text-gray-400 text-sm">Overall system statistics & insights</p>
        </header>

        <!-- Page Content -->
        <main class="p-6 space-y-6">

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="glass-card">
                    <p class="text-gray-400 text-sm">Total Reports</p>
                    <h1 class="text-3xl font-bold mt-2">124</h1>
                </div>

                <div class="glass-card">
                    <p class="text-gray-400 text-sm">Successful Rescues</p>
                    <h1 class="text-3xl font-bold mt-2">82</h1>
                </div>

                <div class="glass-card">
                    <p class="text-gray-400 text-sm">Adoptions Completed</p>
                    <h1 class="text-3xl font-bold mt-2">57</h1>
                </div>

            </div>

            <!-- Charts Section (Placeholder) -->
            <div class="glass-card h-64 flex items-center justify-center text-gray-300">
                <p>Charts will go here (Bar, Line, Pie etc.)</p>
            </div>

        </main>
    </div>

</div>
</body>
</html>
