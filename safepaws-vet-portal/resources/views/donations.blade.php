<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafePaws - Donations</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style type="text/tailwindcss">
        body { background: #071331; color: white; }
        .glass-card { @apply bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl shadow-lg; }
        .btn-primary { @apply bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium flex items-center gap-2; }
        .btn-secondary { @apply bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-lg; }
        .nav-link { @apply flex items-center gap-3 px-4 py-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-lg; }
        .nav-link.active { @apply bg-blue-500/20 text-blue-400 border-l-4 border-blue-400; }
        .dashboard-table { @apply min-w-full text-left; }
        .dashboard-table th { @apply px-6 py-3 text-xs uppercase tracking-wider text-gray-300; }
        .dashboard-table td { @apply px-6 py-4 text-gray-200; }
        .dashboard-table tbody tr { @apply border-b border-white/5 hover:bg-white/10; }
    </style>
</head>

<body class="min-h-screen">
<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#0b2447]/80 border-r border-white/10 hidden lg:block">
        <div class="p-6 border-b border-white/10">
            <a class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-paw text-white text-lg"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold">SafePaws</h1>
                    <p class="text-xs text-gray-400">Admin Panel</p>
                </div>
            </a>
        </div>

        <nav class="p-4 space-y-1">
            <a href="{{ url('/') }}" class="nav-link"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
            <a href="{{ url('/reports') }}" class="nav-link"><i class="fas fa-flag"></i>Animal Reports</a>
            <a href="{{ url('/rescues') }}" class="nav-link"><i class="fas fa-ambulance"></i>Rescue Operations</a>
            <a href="{{ url('/adoptions') }}" class="nav-link"><i class="fas fa-home"></i>Adoptions</a>
            <a href="{{ url('/users') }}" class="nav-link"><i class="fas fa-users"></i>Users & Teams</a>
            <a href="{{ url('/veterinarians') }}" class="nav-link"><i class="fas fa-stethoscope"></i>Vet Collaborators</a>

            <!-- ACTIVE MENU ITEM -->
            <a href="{{ url('/donations') }}" class="nav-link active">
                <i class="fas fa-donate"></i>Donations
            </a>

            <a href="{{ url('/ecommerce') }}" class="nav-link"><i class="fas fa-shopping-cart"></i>E-commerce</a>
            <a href="{{ url('/analytics') }}" class="nav-link"><i class="fas fa-chart-bar"></i>Analytics</a>
            <a href="{{ url('/settings') }}" class="nav-link"><i class="fas fa-cog"></i>Settings</a>
        </nav>
    </aside>

    <!-- MAIN PAGE -->
    <div class="flex-1 overflow-auto">

        <!-- TOP NAV -->
        <header class="sticky top-0 bg-[#0b2447]/95 border-b border-white/10 px-6 py-4">
            <h2 class="text-xl font-bold">Donations</h2>
            <p class="text-sm text-gray-400">Manage donations and supporters</p>
        </header>

        <main class="p-6 space-y-8">

            <!-- Add Donation -->
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold">Recent Donations</h3>
                <a href="#" class="btn-primary">
                    <i class="fas fa-plus"></i> Add Donation
                </a>
            </div>

            <!-- Donations Table -->
            <div class="glass-card p-6">
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>Donor</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Date</th>
                            <th>Receipt</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="font-medium">Sarah Williams</td>
                            <td>$120</td>
                            <td>Credit Card</td>
                            <td>2025-01-03</td>
                            <td><a href="#" class="text-blue-400">Download</a></td>
                            <td>
                                <div class="flex gap-2">
                                    <a class="btn-primary text-sm px-3 py-1"><i class="fas fa-eye"></i></a>
                                    <a class="btn-secondary text-sm px-3 py-1"><i class="fas fa-edit"></i></a>
                                    <a class="btn-secondary text-sm px-3 py-1 text-red-500"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="font-medium">Mark Taylor</td>
                            <td>$50</td>
                            <td>PayPal</td>
                            <td>2025-01-05</td>
                            <td><a href="#" class="text-blue-400">Download</a></td>
                            <td>
                                <div class="flex gap-2">
                                    <a class="btn-primary text-sm px-3 py-1"><i class="fas fa-eye"></i></a>
                                    <a class="btn-secondary text-sm px-3 py-1"><i class="fas fa-edit"></i></a>
                                    <a class="btn-secondary text-sm px-3 py-1 text-red-500"><i class="fas fa-trash"></i></a>
                                </div>
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
