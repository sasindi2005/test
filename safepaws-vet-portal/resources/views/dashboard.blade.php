<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafePaws - Admin Dashboard</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style type="text/tailwindcss">
        /* Custom Styles */
        :root {
            --primary: #0ea5e9;
            --primary-dark: #0891b2;
            --secondary: #071331;
            --accent: #f59e0b;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #0b2447;
        }

        body {
            background-color: #071331;
            color: #ffffff;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }

        .animate-pulse-slow {
            animation: pulse 2s infinite;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

        /* Status Badges */
        .status-badge {
            @apply px-3 py-1 text-xs font-semibold rounded-full inline-flex items-center gap-1;
        }
        
        .status-active { 
            background-color: rgba(16, 185, 129, 0.2);
            color: #10b981;
        }
        
        .status-pending { 
            background-color: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
        }
        
        .status-inactive { 
            background-color: rgba(107, 114, 128, 0.2);
            color: #9ca3af;
        }
        
        .status-urgent { 
            background-color: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }
        
        .status-rescued {
            background-color: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
        }

        /* Cards */
        .glass-card {
            @apply bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl shadow-lg;
        }

        .hover-lift {
            @apply transition-all duration-300 hover:-translate-y-1 hover:shadow-xl;
        }

        /* Buttons */
        .btn-primary {
            @apply bg-[#0ea5e9] hover:bg-[#0891b2] text-white px-4 py-2 rounded-lg font-medium 
                   transition-all duration-300 inline-flex items-center gap-2;
        }
        
        .btn-secondary {
            @apply bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-lg font-medium 
                   transition-all duration-300 inline-flex items-center gap-2 border border-white/20;
        }
        
        .btn-success {
            @apply bg-[#10b981] hover:bg-[#0da271] text-white px-4 py-2 rounded-lg font-medium 
                   transition-all duration-300 inline-flex items-center gap-2;
        }
        
        .btn-danger {
            @apply bg-[#ef4444] hover:bg-[#dc2626] text-white px-4 py-2 rounded-lg font-medium 
                   transition-all duration-300 inline-flex items-center gap-2;
        }

        /* Table Styles */
        .dashboard-table {
            @apply min-w-full bg-white/5 rounded-lg overflow-hidden;
        }
        
        .dashboard-table thead {
            @apply bg-white/10;
        }
        
        .dashboard-table th {
            @apply px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider;
        }
        
        .dashboard-table td {
            @apply px-6 py-4 whitespace-nowrap text-sm text-gray-200;
        }
        
        .dashboard-table tbody tr {
            @apply hover:bg-white/10 transition-colors duration-200 border-b border-white/5;
        }

        /* Stats Cards */
        .stats-card {
            @apply glass-card p-6 hover-lift;
        }
        
        .stats-icon {
            @apply w-12 h-12 rounded-lg flex items-center justify-center text-white text-xl;
        }
        
        .stats-value {
            @apply text-2xl font-bold mt-2;
        }
        
        .stats-label {
            @apply text-gray-300 text-sm mt-1;
        }

        /* Sidebar Navigation */
        .nav-link {
            @apply flex items-center gap-3 px-4 py-3 text-gray-300 hover:text-white 
                   hover:bg-white/10 rounded-lg transition-all duration-300;
        }
        
        .nav-link.active {
            @apply bg-[#0ea5e9]/20 text-[#0ea5e9] border-l-4 border-[#0ea5e9];
        }
        
        .nav-link i {
            @apply w-5 text-center;
        }

        /* Charts */
        .chart-container {
            @apply glass-card p-6;
        }

        /* Progress Bars */
        .progress-bar {
            @apply h-2 bg-white/10 rounded-full overflow-hidden;
        }
        
        .progress-fill {
            @apply h-full rounded-full transition-all duration-500;
        }

        /* Dashboard Grid */
        .dashboard-grid {
            @apply grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6;
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Main Container -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#0b2447]/80 backdrop-blur-sm border-r border-white/10 hidden lg:block">
            <!-- Logo -->
            <div class="p-6 border-b border-white/10">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-[#0ea5e9] rounded-xl flex items-center justify-center">
                        <i class="fas fa-paw text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white">SafePaws</h1>
                        <p class="text-xs text-gray-400">Admin Dashboard</p>
                    </div>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-1">
                <a href="{{ url('/') }}" class="nav-link active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ url('/reports') }}" class="nav-link">
                    <i class="fas fa-flag"></i>
                    <span>Animal Reports</span>
                    <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">24</span>
                </a>
                
                <a href="{{ url('/rescues') }}" class="nav-link">
                    <i class="fas fa-ambulance"></i>
                    <span>Rescue Operations</span>
                </a>
                
                <a href="{{ url('/adoptions') }}" class="nav-link">
                    <i class="fas fa-home"></i>
                    <span>Adoptions</span>
                    <span class="ml-auto bg-green-500 text-white text-xs px-2 py-1 rounded-full">12</span>
                </a>
                
                <a href="{{ url('/users') }}" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>Users & Teams</span>
                </a>
                
                <a href="{{ url('/veterinarians') }}" class="nav-link">
                    <i class="fas fa-stethoscope"></i>
                    <span>Vet Collaborators</span>
                </a>
                
                <a href="{{ url('/donations') }}" class="nav-link">
                    <i class="fas fa-donate"></i>
                    <span>Donations</span>
                </a>
                
                <a href="{{ url('/ecommerce') }}" class="nav-link">
                    <i class="fas fa-shopping-cart"></i>
                    <span>E-commerce</span>
                </a>
                
                <a href="{{ url('/analytics') }}" class="nav-link">
                    <i class="fas fa-chart-bar"></i>
                    <span>Analytics</span>
                </a>
                
                <a href="{{ url('/settings') }}" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </nav>

            <!-- User Profile -->
            <div class="absolute bottom-0 w-64 p-4 border-t border-white/10">
                <div class="flex items-center gap-3">
                    <img src="https://ui-avatars.com/api/?name=Admin+User&background=0ea5e9&color=fff" 
                         alt="Admin" class="w-10 h-10 rounded-full">
                    <div class="flex-1">
                        <h4 class="text-sm font-semibold text-white">Admin User</h4>
                        <p class="text-xs text-gray-400">Administrator</p>
                    </div>
                    <div class="relative">
                        <button class="text-gray-400 hover:text-white dropdown-toggle">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="absolute bottom-full right-0 mb-2 w-48 bg-[#0b2447] border border-white/10 rounded-lg shadow-lg hidden dropdown-menu">
                            <a href="{{ url('/profile') }}" class="block px-4 py-2 text-sm hover:bg-white/10">Profile</a>
                            <a href="{{ url('/settings') }}" class="block px-4 py-2 text-sm hover:bg-white/10">Settings</a>
                            <a href="{{ url('/logout') }}" class="block w-full text-left px-4 py-2 text-sm hover:bg-red-500/20 text-red-400">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Top Navigation -->
            <header class="sticky top-0 z-40 bg-[#0b2447]/95 backdrop-blur-sm border-b border-white/10">
                <div class="flex items-center justify-between px-6 py-4">
                    <!-- Mobile Menu Button -->
                    <button id="mobileMenuBtn" class="lg:hidden text-gray-300 hover:text-white">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    
                    <!-- Page Title -->
                    <div>
                        <h2 class="text-xl font-bold text-white">Dashboard Overview</h2>
                        <p class="text-sm text-gray-400">Welcome back, Administrator</p>
                    </div>
                    
                    <!-- Right Side Actions -->
                    <div class="flex items-center gap-4">
                        <!-- Notifications -->
                        <div class="relative">
                            <button class="text-gray-300 hover:text-white relative dropdown-toggle">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                            </button>
                            <div class="absolute right-0 mt-2 w-80 bg-[#0b2447] border border-white/10 rounded-lg shadow-lg hidden dropdown-menu">
                                <div class="p-4 border-b border-white/10">
                                    <h3 class="font-semibold text-white">Notifications</h3>
                                </div>
                                <div class="max-h-64 overflow-y-auto">
                                    <a href="#" class="block px-4 py-3 hover:bg-white/10 border-b border-white/5">
                                        <p class="text-sm text-white">New report submitted</p>
                                        <p class="text-xs text-gray-400">10 minutes ago</p>
                                    </a>
                                    <a href="#" class="block px-4 py-3 hover:bg-white/10 border-b border-white/5">
                                        <p class="text-sm text-white">Rescue team dispatched</p>
                                        <p class="text-xs text-gray-400">25 minutes ago</p>
                                    </a>
                                    <a href="#" class="block px-4 py-3 hover:bg-white/10">
                                        <p class="text-sm text-white">New donation received</p>
                                        <p class="text-xs text-gray-400">1 hour ago</p>
                                    </a>
                                </div>
                                <a href="{{ url('/notifications') }}" class="block px-4 py-3 text-center text-sm text-[#0ea5e9] hover:bg-white/10">
                                    View All Notifications
                                </a>
                            </div>
                        </div>
                        
                        <!-- Quick Actions -->
                        <a href="{{ url('/reports/create') }}" class="btn-primary">
                            <i class="fas fa-plus"></i>
                            New Report
                        </a>
                    </div>
                </div>
            </header>

            <!-- Main Dashboard Content -->
            <main class="p-6">
                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Stats Card 1 -->
                    <div class="stats-card">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="stats-icon bg-blue-500/20 text-blue-400">
                                    <i class="fas fa-flag"></i>
                                </div>
                                <div class="stats-value text-white">142</div>
                                <div class="stats-label">New Reports This Month</div>
                            </div>
                            <div class="text-green-400">
                                <i class="fas fa-arrow-up"></i> 12%
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stats Card 2 -->
                    <div class="stats-card">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="stats-icon bg-green-500/20 text-green-400">
                                    <i class="fas fa-ambulance"></i>
                                </div>
                                <div class="stats-value text-white">89</div>
                                <div class="stats-label">Animals Rescued</div>
                            </div>
                            <div class="text-green-400">
                                <i class="fas fa-arrow-up"></i> 8%
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stats Card 3 -->
                    <div class="stats-card">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="stats-icon bg-purple-500/20 text-purple-400">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="stats-value text-white">67</div>
                                <div class="stats-label">Successful Adoptions</div>
                            </div>
                            <div class="text-green-400">
                                <i class="fas fa-arrow-up"></i> 15%
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stats Card 4 -->
                    <div class="stats-card">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="stats-icon bg-yellow-500/20 text-yellow-400">
                                    <i class="fas fa-donate"></i>
                                </div>
                                <div class="stats-value text-white">$2,450</div>
                                <div class="stats-label">Donations Received</div>
                            </div>
                            <div class="text-green-400">
                                <i class="fas fa-arrow-up"></i> 23%
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts and Recent Activity -->
                <div class="dashboard-grid mb-8">
                    <!-- Rescue Operations Chart -->
                    <div class="chart-container col-span-2">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-white">Rescue Operations Overview</h3>
                            <select class="bg-white/10 text-white text-sm rounded-lg px-3 py-1">
                                <option>Last 7 days</option>
                                <option>Last 30 days</option>
                                <option>Last 90 days</option>
                            </select>
                        </div>
                        
                        <!-- Chart Placeholder -->
                        <div class="h-64 flex items-center justify-center bg-white/5 rounded-lg">
                            <div class="text-center">
                                <i class="fas fa-chart-line text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-400">Rescue Operations Chart</p>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Timeline -->
                    <div class="chart-container">
                        <h3 class="text-lg font-semibold text-white mb-6">Recent Activity</h3>
                        
                        <div class="space-y-4">
                            <!-- Activity Item 1 -->
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center">
                                    <i class="fas fa-ambulance text-blue-400 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-white">New rescue operation started</p>
                                    <p class="text-xs text-gray-400">German Shepherd in Central Park</p>
                                    <p class="text-xs text-gray-500">10 minutes ago</p>
                                </div>
                            </div>
                            
                            <!-- Activity Item 2 -->
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-green-500/20 rounded-full flex items-center justify-center">
                                    <i class="fas fa-home text-green-400 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-white">Adoption completed</p>
                                    <p class="text-xs text-gray-400">Golden Retriever adopted by family</p>
                                    <p class="text-xs text-gray-500">2 hours ago</p>
                                </div>
                            </div>
                            
                            <!-- Activity Item 3 -->
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-yellow-500/20 rounded-full flex items-center justify-center">
                                    <i class="fas fa-donate text-yellow-400 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-white">New donation received</p>
                                    <p class="text-xs text-gray-400">$500 from John Doe</p>
                                    <p class="text-xs text-gray-500">4 hours ago</p>
                                </div>
                            </div>
                            
                            <!-- Activity Item 4 -->
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-purple-500/20 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user-md text-purple-400 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-white">New vet added</p>
                                    <p class="text-xs text-gray-400">Dr. Smith joined as collaborator</p>
                                    <p class="text-xs text-gray-500">1 day ago</p>
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{ url('/activity') }}" class="w-full mt-6 btn-secondary inline-flex justify-center">
                            <i class="fas fa-history"></i>
                            View All Activities
                        </a>
                    </div>
                </div>

                <!-- Recent Reports Table -->
                <div class="glass-card p-6 mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-white">Recent Animal Reports</h3>
                        <a href="{{ url('/reports') }}" class="btn-secondary">
                            <i class="fas fa-eye"></i>
                            View All Reports
                        </a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="dashboard-table">
                            <thead>
                                <tr>
                                    <th>Report ID</th>
                                    <th>Animal</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Priority</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Report 1 -->
                                <tr>
                                    <td class="font-medium">#SP-1024</td>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center">
                                                <i class="fas fa-dog text-blue-400"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-white">Aggressive Dog</div>
                                                <div class="text-xs text-gray-400">German Shepherd</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Central Park Area</td>
                                    <td>
                                        <span class="status-badge status-urgent">
                                            <i class="fas fa-clock"></i>
                                            Rescue In Progress
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse-slow"></div>
                                            <span class="text-sm text-white">High</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex gap-2">
                                            <a href="{{ url('/reports/SP-1024') }}" class="btn-primary text-sm px-3 py-1">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ url('/reports/SP-1024/edit') }}" class="btn-secondary text-sm px-3 py-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Report 2 -->
                                <tr>
                                    <td class="font-medium">#SP-1023</td>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-pink-500/20 rounded-full flex items-center justify-center">
                                                <i class="fas fa-cat text-pink-400"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-white">Sick Cat</div>
                                                <div class="text-xs text-gray-400">Stray Tabby</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Maple Street</td>
                                    <td>
                                        <span class="status-badge status-rescued">
                                            <i class="fas fa-check"></i>
                                            Treated & Ready
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                            <span class="text-sm text-white">Low</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex gap-2">
                                            <a href="{{ url('/reports/SP-1023') }}" class="btn-primary text-sm px-3 py-1">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ url('/adoptions/create') }}" class="btn-success text-sm px-3 py-1">
                                                <i class="fas fa-home"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Report 3 -->
                                <tr>
                                    <td class="font-medium">#SP-1022</td>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center">
                                                <i class="fas fa-dog text-blue-400"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-white">Injured Dog</div>
                                                <div class="text-xs text-gray-400">Mixed Breed</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Riverside</td>
                                    <td>
                                        <span class="status-badge status-pending">
                                            <i class="fas fa-clock"></i>
                                            Awaiting Rescue
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                            <span class="text-sm text-white">Medium</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex gap-2">
                                            <a href="{{ url('/reports/SP-1022') }}" class="btn-primary text-sm px-3 py-1">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ url('/rescues/create') }}" class="btn-secondary text-sm px-3 py-1">
                                                <i class="fas fa-ambulance"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Report 4 -->
                                <tr>
                                    <td class="font-medium">#SP-1021</td>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-green-500/20 rounded-full flex items-center justify-center">
                                                <i class="fas fa-home text-green-400"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-white">Adoption Request</div>
                                                <div class="text-xs text-gray-400">Golden Retriever</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>N/A</td>
                                    <td>
                                        <span class="status-badge status-pending">
                                            <i class="fas fa-clock"></i>
                                            Under Review
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                            <span class="text-sm text-white">Medium</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex gap-2">
                                            <a href="{{ url('/adoptions/SP-1021') }}" class="btn-primary text-sm px-3 py-1">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button class="btn-success text-sm px-3 py-1">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Quick Stats and Actions -->
                <div class="dashboard-grid">
                    <!-- Donation Progress -->
                    <div class="chart-container">
                        <h3 class="text-lg font-semibold text-white mb-6">Monthly Donation Goal</h3>
                        
                        <div class="text-center mb-6">
                            <div class="text-3xl font-bold text-white mb-2">$2,450</div>
                            <div class="text-gray-400">of $5,000 goal</div>
                        </div>
                        
                        <div class="progress-bar mb-2">
                            <div class="progress-fill bg-gradient-to-r from-blue-500 to-green-500" style="width: 49%"></div>
                        </div>
                        
                        <div class="flex justify-between text-sm text-gray-400">
                            <span>49% Complete</span>
                            <span>$2,550 to go</span>
                        </div>
                        
                        <a href="{{ url('/donations/create') }}" class="w-full mt-6 btn-primary inline-flex justify-center">
                            <i class="fas fa-donate"></i>
                            Make a Donation
                        </a>
                    </div>

                    <!-- Rescue Team Status -->
                    <div class="chart-container">
                        <h3 class="text-lg font-semibold text-white mb-6">Rescue Team Status</h3>
                        
                        <div class="space-y-4">
                            <!-- Team 1 -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-ambulance text-blue-400"></i>
                                    </div>
                                    <div>
                                        <div class="font-medium text-white">Team Alpha</div>
                                        <div class="text-xs text-gray-400">2 active missions</div>
                                    </div>
                                </div>
                                <span class="status-badge status-active">
                                    <i class="fas fa-circle text-xs"></i>
                                    Active
                                </span>
                            </div>
                            
                            <!-- Team 2 -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-ambulance text-green-400"></i>
                                    </div>
                                    <div>
                                        <div class="font-medium text-white">Team Bravo</div>
                                        <div class="text-xs text-gray-400">1 active mission</div>
                                    </div>
                                </div>
                                <span class="status-badge status-active">
                                    <i class="fas fa-circle text-xs"></i>
                                    Active
                                </span>
                            </div>
                            
                            <!-- Team 3 -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-ambulance text-yellow-400"></i>
                                    </div>
                                    <div>
                                        <div class="font-medium text-white">Team Charlie</div>
                                        <div class="text-xs text-gray-400">Available</div>
                                    </div>
                                </div>
                                <span class="status-badge status-inactive">
                                    <i class="fas fa-circle text-xs"></i>
                                    Standby
                                </span>
                            </div>
                        </div>
                        
                        <a href="{{ url('/users/create') }}" class="w-full mt-6 btn-secondary inline-flex justify-center">
                            <i class="fas fa-plus"></i>
                            Assign New Team
                        </a>
                    </div>

                    <!-- Quick Actions -->
                    <div class="chart-container">
                        <h3 class="text-lg font-semibold text-white mb-6">Quick Actions</h3>
                        
                        <div class="space-y-3">
                            <a href="{{ url('/users/create') }}" class="w-full btn-primary text-left">
                                <i class="fas fa-plus"></i>
                                Add New Rescue Team
                            </a>
                            
                            <a href="{{ url('/reports/generate') }}" class="w-full btn-secondary text-left">
                                <i class="fas fa-file-pdf"></i>
                                Generate Monthly Report
                            </a>
                            
                            <a href="{{ url('/veterinarians/create') }}" class="w-full btn-secondary text-left">
                                <i class="fas fa-user-md"></i>
                                Add Vet Collaborator
                            </a>
                            
                            <a href="{{ url('/awareness/create') }}" class="w-full btn-secondary text-left">
                                <i class="fas fa-bullhorn"></i>
                                Post Awareness Content
                            </a>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="border-t border-white/10 bg-[#0b2447]/80 p-6">
                <div class="max-w-7xl mx-auto">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-[#0ea5e9] rounded-lg flex items-center justify-center">
                                <i class="fas fa-paw text-white"></i>
                            </div>
                            <div>
                                <div class="font-semibold text-white">SafePaws Admin Dashboard</div>
                                <div class="text-xs text-gray-400">Protecting Every Paw • © 2023 All rights reserved</div>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4 text-sm text-gray-400">
                            <a href="{{ url('/privacy') }}" class="hover:text-white transition-colors">Privacy Policy</a>
                            <a href="{{ url('/terms') }}" class="hover:text-white transition-colors">Terms of Service</a>
                            <a href="{{ url('/help') }}" class="hover:text-white transition-colors">Help Center</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Mobile Sidebar (Hidden by default) -->
    <div id="mobileSidebar" class="fixed inset-0 z-50 hidden lg:hidden">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/50" id="sidebarOverlay"></div>
        
        <!-- Sidebar Content -->
        <div class="absolute left-0 top-0 bottom-0 w-64 bg-[#0b2447] transform -translate-x-full transition-transform duration-300" id="sidebarContent">
            <div class="p-4 border-b border-white/10">
                <div class="flex items-center justify-between">
                    <a href="{{ url('/') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-[#0ea5e9] rounded-xl flex items-center justify-center">
                            <i class="fas fa-paw text-white text-lg"></i>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-white">SafePaws</h1>
                            <p class="text-xs text-gray-400">Admin Dashboard</p>
                        </div>
                    </a>
                    <button id="closeSidebar" class="text-gray-400 hover:text-white">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Navigation -->
            <nav class="p-4 space-y-1">
                <a href="{{ url('/') }}" class="nav-link active" onclick="closeMobileSidebar()">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ url('/reports') }}" class="nav-link" onclick="closeMobileSidebar()">
                    <i class="fas fa-flag"></i>
                    <span>Animal Reports</span>
                </a>
                <a href="{{ url('/rescues') }}" class="nav-link" onclick="closeMobileSidebar()">
                    <i class="fas fa-ambulance"></i>
                    <span>Rescue Operations</span>
                </a>
                <a href="{{ url('/adoptions') }}" class="nav-link" onclick="closeMobileSidebar()">
                    <i class="fas fa-home"></i>
                    <span>Adoptions</span>
                </a>
            </nav>
        </div>
    </div>

    <script>
        // Mobile sidebar functionality
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileSidebar = document.getElementById('mobileSidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const sidebarContent = document.getElementById('sidebarContent');
        const closeSidebar = document.getElementById('closeSidebar');

        function openMobileSidebar() {
            mobileSidebar.classList.remove('hidden');
            setTimeout(() => {
                sidebarContent.classList.remove('-translate-x-full');
            }, 10);
        }

        function closeMobileSidebar() {
            sidebarContent.classList.add('-translate-x-full');
            setTimeout(() => {
                mobileSidebar.classList.add('hidden');
            }, 300);
        }

        // Event listeners
        mobileMenuBtn.addEventListener('click', openMobileSidebar);
        closeSidebar.addEventListener('click', closeMobileSidebar);
        sidebarOverlay.addEventListener('click', closeMobileSidebar);

        // Dropdown functionality
        document.querySelectorAll('.dropdown-toggle').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                const dropdown = this.nextElementSibling;
                dropdown.classList.toggle('hidden');
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function() {
            document.querySelectorAll('.dropdown-menu').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        });

        // Dashboard card interactions
        document.querySelectorAll('.stats-card').forEach(card => {
            card.addEventListener('click', function() {
                const cardType = Array.from(this.querySelector('.stats-icon').classList)
                    .find(cls => cls.includes('bg-')).split('-')[0];
                
                let alertMessage = '';
                switch(cardType) {
                    case 'blue':
                        alertMessage = 'View detailed reports statistics';
                        break;
                    case 'green':
                        alertMessage = 'View rescue operations dashboard';
                        break;
                    case 'purple':
                        alertMessage = 'View adoption requests and status';
                        break;
                    case 'yellow':
                        alertMessage = 'View donation analytics';
                        break;
                    default:
                        alertMessage = 'View dashboard details';
                }
                
                console.log(alertMessage);
            });
        });

        // Status badge animation
        document.querySelectorAll('.status-badge.status-urgent').forEach(badge => {
            badge.addEventListener('mouseenter', function() {
                this.classList.add('animate-pulse-slow');
            });
            
            badge.addEventListener('mouseleave', function() {
                this.classList.remove('animate-pulse-slow');
            });
        });

        // Update active nav link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.getAttribute('href') === '#') {
                    e.preventDefault();
                }
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
                
                // Close mobile sidebar if open
                if (window.innerWidth < 1024) {
                    closeMobileSidebar();
                }
            });
        });

        // Quick action buttons
        document.querySelectorAll('.btn-primary, .btn-secondary, .btn-success, .btn-danger').forEach(button => {
            button.addEventListener('click', function() {
                // Add visual feedback
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });

        // Initialize current year in footer
        document.querySelectorAll('#year').forEach(element => {
            element.textContent = new Date().getFullYear();
        });
    </script>
</body>
</html>