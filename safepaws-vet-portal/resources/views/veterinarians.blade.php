<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafePaws - Vet Collaborators</title>

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
            @apply bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl shadow-lg;
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

            <a href="{{ url('/veterinarians') }}" class="nav-link active">
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

            <a href="{{ url('/settings') }}" class="nav-link">
                <i class="fas fa-cog"></i> Settings
            </a>
        </nav>

    </aside>

    <!-- Main Content -->
    <div class="flex-1 overflow-auto">

        <!-- Header -->
        <header class="sticky top-0 bg-[#0b2447]/95 backdrop-blur-sm border-b border-white/10 px-6 py-4">
            <h2 class="text-2xl font-bold">Vet Collaborators</h2>
            <p class="text-gray-400 text-sm">Manage veterinary partners & clinics</p>
        </header>

        <!-- Page Content -->
        <main class="p-6">

            <div class="flex justify-between mb-6">
                <h3 class="text-xl font-semibold">All Veterinarians</h3>
                <a href="{{ url('/veterinarians/create') }}" class="bg-[#0ea5e9] hover:bg-[#0891b2] px-4 py-2 rounded-lg text-white flex gap-2">
                    <i class="fas fa-plus"></i> Add New Vet
                </a>
            </div>

            <div class="glass-card p-6">
                <table class="w-full text-left">
                    <thead class="text-gray-300 border-b border-white/10">
                        <tr>
                            <th class="py-3">Name</th>
                            <th>Clinic</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="text-sm text-gray-200">

                        <tr class="border-b border-white/5 hover:bg-white/10">
                            <td class="py-3">Dr. Samantha Lee</td>
                            <td>PetCare Wellness Center</td>
                            <td>071 222 3333</td>
                            <td><span class="text-green-400">Active</span></td>
                            <td class="text-center">
                                <a href="#" class="text-blue-400 px-2"><i class="fas fa-eye"></i></a>
                                <a href="#" class="text-yellow-400 px-2"><i class="fas fa-edit"></i></a>
                                <a href="#" class="text-red-400 px-2"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>

                        <tr class="border-b border-white/5 hover:bg-white/10">
                            <td class="py-3">Dr. Ajantha Perera</td>
                            <td>Animal Rescue Clinic</td>
                            <td>077 555 4444</td>
                            <td><span class="text-green-400">Active</span></td>
                            <td class="text-center">
                                <a href="#" class="text-blue-400 px-2"><i class="fas fa-eye"></i></a>
                                <a href="#" class="text-yellow-400 px-2"><i class="fas fa-edit"></i></a>
                                <a href="#" class="text-red-400 px-2"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </main>
    </div>
</div>
</body>
</html>
