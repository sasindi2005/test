<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rescue Operations - SafePaws</title>
    
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
        
        .status-pending { 
            background-color: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
        }
        
        .status-dispatched { 
            background-color: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
        }
        
        .status-en-route { 
            background-color: rgba(139, 92, 246, 0.2);
            color: #8b5cf6;
        }
        
        .status-on-scene { 
            background-color: rgba(16, 185, 129, 0.2);
            color: #10b981;
        }
        
        .status-in-progress { 
            background-color: rgba(236, 72, 153, 0.2);
            color: #ec4899;
        }
        
        .status-completed { 
            background-color: rgba(34, 197, 94, 0.2);
            color: #22c55e;
        }

        /* Priority Badges */
        .priority-high {
            @apply bg-red-500/20 text-red-300;
        }
        
        .priority-medium {
            @apply bg-yellow-500/20 text-yellow-300;
        }
        
        .priority-low {
            @apply bg-green-500/20 text-green-300;
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
        
        .btn-warning {
            @apply bg-[#f59e0b] hover:bg-[#d97706] text-white px-4 py-2 rounded-lg font-medium 
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

        /* Progress Steps */
        .progress-step {
            @apply flex items-center gap-3;
        }
        
        .step-number {
            @apply w-8 h-8 rounded-full border-2 border-white/30 flex items-center justify-center text-sm font-bold;
        }
        
        .step-active .step-number {
            @apply bg-[#0ea5e9] border-[#0ea5e9] text-white;
        }
        
        .step-completed .step-number {
            @apply bg-green-500 border-green-500 text-white;
        }
        
        .step-line {
            @apply h-0.5 flex-1 bg-white/20;
        }
        
        .step-completed .step-line {
            @apply bg-green-500;
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
    </style>
</head>
<body class="min-h-screen">
    <!-- Main Container -->
    <div class="flex min-h-screen">
        <!-- Sidebar (Complete from Dashboard) -->
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
                <a href="{{ url('/') }}" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ url('/reports') }}" class="nav-link">
                    <i class="fas fa-flag"></i>
                    <span>Animal Reports</span>
                </a>
                
                <a href="{{ url('/rescues') }}" class="nav-link active">
                    <i class="fas fa-ambulance"></i>
                    <span>Rescue Operations</span>
                    <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">8</span>
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

            <!-- User Profile with Dropdown -->
            <div class="absolute bottom-0 w-64 p-4 border-t border-white/10">
                <div class="flex items-center gap-3">
                    <img src="https://ui-avatars.com/api/?name=Rescue+Lead&background=0ea5e9&color=fff" 
                         alt="Rescue Lead" class="w-10 h-10 rounded-full">
                    <div class="flex-1">
                        <h4 class="text-sm font-semibold text-white">Rescue Lead</h4>
                        <p class="text-xs text-gray-400">Operations Manager</p>
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
                        <h2 class="text-xl font-bold text-white">Rescue Operations</h2>
                        <p class="text-sm text-gray-400">Manage active rescue missions and teams</p>
                    </div>
                    
                    <!-- Right Side Actions -->
                    <div class="flex items-center gap-4">
                        <!-- Notifications -->
                        <div class="relative">
                            <button class="text-gray-300 hover:text-white relative dropdown-toggle">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">5</span>
                            </button>
                            <div class="absolute right-0 mt-2 w-80 bg-[#0b2447] border border-white/10 rounded-lg shadow-lg hidden dropdown-menu">
                                <div class="p-4 border-b border-white/10">
                                    <h3 class="font-semibold text-white">Rescue Notifications</h3>
                                </div>
                                <div class="max-h-64 overflow-y-auto">
                                    <a href="#" class="block px-4 py-3 hover:bg-white/10 border-b border-white/5">
                                        <p class="text-sm text-white">Team Alpha arrived on scene</p>
                                        <p class="text-xs text-gray-400">5 minutes ago</p>
                                    </a>
                                    <a href="#" class="block px-4 py-3 hover:bg-white/10 border-b border-white/5">
                                        <p class="text-sm text-white">New rescue request received</p>
                                        <p class="text-xs text-gray-400">15 minutes ago</p>
                                    </a>
                                    <a href="#" class="block px-4 py-3 hover:bg-white/10 border-b border-white/5">
                                        <p class="text-sm text-white">Equipment restock needed</p>
                                        <p class="text-xs text-gray-400">1 hour ago</p>
                                    </a>
                                </div>
                                <a href="{{ url('/notifications') }}" class="block px-4 py-3 text-center text-sm text-[#0ea5e9] hover:bg-white/10">
                                    View All Notifications
                                </a>
                            </div>
                        </div>
                        
                        <!-- Quick Actions -->
                        <a href="{{ url('/rescues/create') }}" class="btn-primary">
                            <i class="fas fa-plus"></i>
                            New Rescue Mission
                        </a>
                        <a href="{{ url('/map') }}" class="btn-secondary">
                            <i class="fas fa-map"></i>
                            View Live Map
                        </a>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="p-6">
                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="stats-card">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="stats-icon bg-blue-500/20 text-blue-400">
                                    <i class="fas fa-ambulance"></i>
                                </div>
                                <div class="stats-value text-white">8</div>
                                <div class="stats-label">Active Missions</div>
                            </div>
                            <div class="text-green-400">
                                <i class="fas fa-arrow-up"></i> 2 new today
                            </div>
                        </div>
                    </div>
                    
                    <div class="stats-card">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="stats-icon bg-green-500/20 text-green-400">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stats-value text-white">12</div>
                                <div class="stats-label">Teams Active</div>
                            </div>
                            <div class="text-green-400">
                                <i class="fas fa-check-circle"></i> 4 available
                            </div>
                        </div>
                    </div>
                    
                    <div class="stats-card">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="stats-icon bg-red-500/20 text-red-400">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="stats-value text-white">3</div>
                                <div class="stats-label">Urgent Cases</div>
                            </div>
                            <div class="text-red-400">
                                <i class="fas fa-clock"></i> Immediate
                            </div>
                        </div>
                    </div>
                    
                    <div class="stats-card">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="stats-icon bg-purple-500/20 text-purple-400">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <div class="stats-value text-white">89</div>
                                <div class="stats-label">Total Rescues</div>
                            </div>
                            <div class="text-green-400">
                                <i class="fas fa-arrow-up"></i> 12 this week
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Missions -->
                <div class="glass-card p-6 mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-white">Active Rescue Missions</h3>
                        <div class="flex gap-2">
                            <select class="bg-white/10 text-white text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0ea5e9]">
                                <option>All Status</option>
                                <option>Dispatched</option>
                                <option>En Route</option>
                                <option>On Scene</option>
                                <option>In Progress</option>
                            </select>
                            <select class="bg-white/10 text-white text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0ea5e9]">
                                <option>All Teams</option>
                                <option>Team Alpha</option>
                                <option>Team Bravo</option>
                                <option>Team Charlie</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <!-- Mission 1 -->
                        <div class="p-4 bg-white/5 rounded-lg border border-white/10 animate-fadeIn">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-10 h-10 bg-red-500/20 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-dog text-red-400"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-white">Mission #RC-2047</h4>
                                            <p class="text-sm text-gray-400">Aggressive German Shepherd • Central Park</p>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap gap-4 text-sm">
                                        <div>
                                            <span class="text-gray-400">Team:</span>
                                            <span class="text-white ml-2">Alpha Team</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-400">ETA:</span>
                                            <span class="text-white ml-2">15 minutes</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-400">Distance:</span>
                                            <span class="text-white ml-2">3.2 km</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col items-end gap-2">
                                    <span class="status-badge status-en-route">
                                        <i class="fas fa-car"></i>
                                        En Route
                                    </span>
                                    <span class="status-badge priority-high">
                                        <i class="fas fa-exclamation-circle"></i>
                                        High Priority
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Progress Steps -->
                            <div class="mt-4 pt-4 border-t border-white/10">
                                <div class="flex items-center justify-between">
                                    <div class="progress-step step-completed">
                                        <div class="step-number">1</div>
                                        <div class="text-sm">Reported</div>
                                    </div>
                                    <div class="step-line"></div>
                                    <div class="progress-step step-completed">
                                        <div class="step-number">2</div>
                                        <div class="text-sm">Assigned</div>
                                    </div>
                                    <div class="step-line"></div>
                                    <div class="progress-step step-active">
                                        <div class="step-number">3</div>
                                        <div class="text-sm">En Route</div>
                                    </div>
                                    <div class="step-line"></div>
                                    <div class="progress-step">
                                        <div class="step-number">4</div>
                                        <div class="text-sm">On Scene</div>
                                    </div>
                                    <div class="step-line"></div>
                                    <div class="progress-step">
                                        <div class="step-number">5</div>
                                        <div class="text-sm">Rescued</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex gap-2 mt-4">
                                <button class="btn-success text-sm px-3 py-2">
                                    <i class="fas fa-check"></i>
                                    Arrived On Scene
                                </button>
                                <button class="btn-secondary text-sm px-3 py-2">
                                    <i class="fas fa-phone"></i>
                                    Contact Team
                                </button>
                                <button class="btn-warning text-sm px-3 py-2">
                                    <i class="fas fa-exclamation"></i>
                                    Report Issue
                                </button>
                                <a href="{{ url('/rescues/RC-2047') }}" class="btn-primary text-sm px-3 py-2">
                                    <i class="fas fa-eye"></i>
                                    View Details
                                </a>
                            </div>
                        </div>
                        
                        <!-- Mission 2 -->
                        <div class="p-4 bg-white/5 rounded-lg border border-white/10 animate-fadeIn" style="animation-delay: 0.1s">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-10 h-10 bg-pink-500/20 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-cat text-pink-400"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-white">Mission #RC-2046</h4>
                                            <p class="text-sm text-gray-400">Sick Stray Cat • Maple Street</p>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap gap-4 text-sm">
                                        <div>
                                            <span class="text-gray-400">Team:</span>
                                            <span class="text-white ml-2">Bravo Team</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-400">Status:</span>
                                            <span class="text-white ml-2">Assessing situation</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-400">On scene:</span>
                                            <span class="text-white ml-2">25 minutes</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col items-end gap-2">
                                    <span class="status-badge status-on-scene">
                                        <i class="fas fa-map-marker-alt"></i>
                                        On Scene
                                    </span>
                                    <span class="status-badge priority-medium">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Medium Priority
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Progress Steps -->
                            <div class="mt-4 pt-4 border-t border-white/10">
                                <div class="flex items-center justify-between">
                                    <div class="progress-step step-completed">
                                        <div class="step-number">1</div>
                                        <div class="text-sm">Reported</div>
                                    </div>
                                    <div class="step-line"></div>
                                    <div class="progress-step step-completed">
                                        <div class="step-number">2</div>
                                        <div class="text-sm">Assigned</div>
                                    </div>
                                    <div class="step-line"></div>
                                    <div class="progress-step step-completed">
                                        <div class="step-number">3</div>
                                        <div class="text-sm">En Route</div>
                                    </div>
                                    <div class="step-line"></div>
                                    <div class="progress-step step-active">
                                        <div class="step-number">4</div>
                                        <div class="text-sm">On Scene</div>
                                    </div>
                                    <div class="step-line"></div>
                                    <div class="progress-step">
                                        <div class="step-number">5</div>
                                        <div class="text-sm">Rescued</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex gap-2 mt-4">
                                <button class="btn-success text-sm px-3 py-2">
                                    <i class="fas fa-check"></i>
                                    Rescue Complete
                                </button>
                                <button class="btn-secondary text-sm px-3 py-2">
                                    <i class="fas fa-medkit"></i>
                                    Request Vet
                                </button>
                                <button class="btn-warning text-sm px-3 py-2">
                                    <i class="fas fa-user-shield"></i>
                                    Need Backup
                                </button>
                                <a href="{{ url('/rescues/RC-2046') }}" class="btn-primary text-sm px-3 py-2">
                                    <i class="fas fa-eye"></i>
                                    View Details
                                </a>
                            </div>
                        </div>
                        
                        <!-- Mission 3 -->
                        <div class="p-4 bg-white/5 rounded-lg border border-white/10 animate-fadeIn" style="animation-delay: 0.2s">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-dog text-blue-400"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-white">Mission #RC-2045</h4>
                                            <p class="text-sm text-gray-400">Injured Puppy • Riverside Area</p>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap gap-4 text-sm">
                                        <div>
                                            <span class="text-gray-400">Team:</span>
                                            <span class="text-white ml-2">Charlie Team</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-400">ETA:</span>
                                            <span class="text-white ml-2">45 minutes</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-400">Distance:</span>
                                            <span class="text-white ml-2">8.7 km</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col items-end gap-2">
                                    <span class="status-badge status-dispatched">
                                        <i class="fas fa-paper-plane"></i>
                                        Dispatched
                                    </span>
                                    <span class="status-badge priority-high">
                                        <i class="fas fa-exclamation-circle"></i>
                                        High Priority
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Progress Steps -->
                            <div class="mt-4 pt-4 border-t border-white/10">
                                <div class="flex items-center justify-between">
                                    <div class="progress-step step-completed">
                                        <div class="step-number">1</div>
                                        <div class="text-sm">Reported</div>
                                    </div>
                                    <div class="step-line"></div>
                                    <div class="progress-step step-active">
                                        <div class="step-number">2</div>
                                        <div class="text-sm">Assigned</div>
                                    </div>
                                    <div class="step-line"></div>
                                    <div class="progress-step">
                                        <div class="step-number">3</div>
                                        <div class="text-sm">En Route</div>
                                    </div>
                                    <div class="step-line"></div>
                                    <div class="progress-step">
                                        <div class="step-number">4</div>
                                        <div class="text-sm">On Scene</div>
                                    </div>
                                    <div class="step-line"></div>
                                    <div class="progress-step">
                                        <div class="step-number">5</div>
                                        <div class="text-sm">Rescued</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex gap-2 mt-4">
                                <button class="btn-success text-sm px-3 py-2">
                                    <i class="fas fa-play"></i>
                                    Start Rescue
                                </button>
                                <button class="btn-secondary text-sm px-3 py-2">
                                    <i class="fas fa-route"></i>
                                    Update Route
                                </button>
                                <button class="btn-danger text-sm px-3 py-2">
                                    <i class="fas fa-times"></i>
                                    Cancel Mission
                                </button>
                                <a href="{{ url('/rescues/RC-2045') }}" class="btn-primary text-sm px-3 py-2">
                                    <i class="fas fa-eye"></i>
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rescue Teams Status -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Team Status -->
                    <div class="glass-card p-6">
                        <h3 class="text-lg font-semibold text-white mb-4">Rescue Teams Status</h3>
                        
                        <div class="space-y-4">
                            <!-- Team 1 -->
                            <div class="p-4 bg-white/5 rounded-lg">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-ambulance text-blue-400"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-white">Team Alpha</h4>
                                            <p class="text-sm text-gray-400">Captain: John Smith</p>
                                        </div>
                                    </div>
                                    <span class="status-badge status-in-progress">
                                        <i class="fas fa-circle animate-pulse-slow"></i>
                                        On Mission
                                    </span>
                                </div>
                                <div class="text-sm text-gray-300">
                                    <div class="flex justify-between">
                                        <span>Current Mission:</span>
                                        <span class="text-white">#RC-2047</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Vehicle:</span>
                                        <span class="text-white">Rescue Van #5</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Members:</span>
                                        <span class="text-white">4/4</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Team 2 -->
                            <div class="p-4 bg-white/5 rounded-lg">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-ambulance text-green-400"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-white">Team Bravo</h4>
                                            <p class="text-sm text-gray-400">Captain: Sarah Johnson</p>
                                        </div>
                                    </div>
                                    <span class="status-badge status-on-scene">
                                        <i class="fas fa-map-marker-alt"></i>
                                        On Scene
                                    </span>
                                </div>
                                <div class="text-sm text-gray-300">
                                    <div class="flex justify-between">
                                        <span>Current Mission:</span>
                                        <span class="text-white">#RC-2046</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Vehicle:</span>
                                        <span class="text-white">Rescue Truck #2</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Members:</span>
                                        <span class="text-white">3/4</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Team 3 -->
                            <div class="p-4 bg-white/5 rounded-lg">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-ambulance text-yellow-400"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-white">Team Charlie</h4>
                                            <p class="text-sm text-gray-400">Captain: Mike Wilson</p>
                                        </div>
                                    </div>
                                    <span class="status-badge status-dispatched">
                                        <i class="fas fa-paper-plane"></i>
                                        Dispatched
                                    </span>
                                </div>
                                <div class="text-sm text-gray-300">
                                    <div class="flex justify-between">
                                        <span>Current Mission:</span>
                                        <span class="text-white">#RC-2045</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Vehicle:</span>
                                        <span class="text-white">Rescue Van #3</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Members:</span>
                                        <span class="text-white">4/4</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{ url('/teams') }}" class="w-full mt-6 btn-secondary inline-flex justify-center">
                            <i class="fas fa-users"></i>
                            Manage All Teams
                        </a>
                    </div>

                    <!-- Recent Completed Missions -->
                    <div class="glass-card p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-white">Recently Completed</h3>
                            <a href="{{ url('/rescues/completed') }}" class="text-sm text-[#0ea5e9] hover:text-[#0891b2]">
                                View All
                            </a>
                        </div>
                        
                        <div class="space-y-4">
                            <!-- Completed 1 -->
                            <div class="p-3 bg-white/5 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-medium text-white">Mission #RC-2044</div>
                                        <div class="text-xs text-gray-400">Stray Dogs Group • Industrial Area</div>
                                    </div>
                                    <span class="status-badge status-completed">
                                        <i class="fas fa-check"></i>
                                        Completed
                                    </span>
                                </div>
                                <div class="mt-2 text-xs text-gray-400">
                                    <i class="fas fa-clock"></i> 2 hours ago • 3 dogs rescued
                                </div>
                            </div>
                            
                            <!-- Completed 2 -->
                            <div class="p-3 bg-white/5 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-medium text-white">Mission #RC-2043</div>
                                        <div class="text-xs text-gray-400">Injured Bird • City Park</div>
                                    </div>
                                    <span class="status-badge status-completed">
                                        <i class="fas fa-check"></i>
                                        Completed
                                    </span>
                                </div>
                                <div class="mt-2 text-xs text-gray-400">
                                    <i class="fas fa-clock"></i> 5 hours ago • Treated & released
                                </div>
                            </div>
                            
                            <!-- Completed 3 -->
                            <div class="p-3 bg-white/5 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-medium text-white">Mission #RC-2042</div>
                                        <div class="text-xs text-gray-400">Trapped Cat • Apartment Building</div>
                                    </div>
                                    <span class="status-badge status-completed">
                                        <i class="fas fa-check"></i>
                                        Completed
                                    </span>
                                </div>
                                <div class="mt-2 text-xs text-gray-400">
                                    <i class="fas fa-clock"></i> 1 day ago • Safe & healthy
                                </div>
                            </div>
                            
                            <!-- Completed 4 -->
                            <div class="p-3 bg-white/5 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-medium text-white">Mission #RC-2041</div>
                                        <div class="text-xs text-gray-400">Abandoned Puppies • Alleyway</div>
                                    </div>
                                    <span class="status-badge status-completed">
                                        <i class="fas fa-check"></i>
                                        Completed
                                    </span>
                                </div>
                                <div class="mt-2 text-xs text-gray-400">
                                    <i class="fas fa-clock"></i> 2 days ago • 5 puppies rescued
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 p-4 bg-green-500/10 rounded-lg border border-green-500/20">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-heart text-green-400"></i>
                                </div>
                                <div>
                                    <div class="font-medium text-white">12 Successful Rescues</div>
                                    <div class="text-sm text-gray-300">This week • 100% success rate</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="glass-card p-6">
                    <h3 class="text-lg font-semibold text-white mb-6">Quick Actions</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ url('/rescues/create') }}" class="btn-primary text-center justify-center">
                            <i class="fas fa-plus"></i>
                            New Mission
                        </a>
                        
                        <a href="{{ url('/teams/assign') }}" class="btn-secondary text-center justify-center">
                            <i class="fas fa-user-plus"></i>
                            Assign Team
                        </a>
                        
                        <a href="{{ url('/equipment/check') }}" class="btn-secondary text-center justify-center">
                            <i class="fas fa-clipboard-check"></i>
                            Equipment Check
                        </a>
                        
                        <a href="{{ url('/reports/emergency') }}" class="btn-danger text-center justify-center">
                            <i class="fas fa-exclamation-triangle"></i>
                            Emergency Report
                        </a>
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
                                <div class="font-semibold text-white">SafePaws Rescue Operations</div>
                                <div class="text-xs text-gray-400">Saving lives every day • © 2023 All rights reserved</div>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4 text-sm text-gray-400">
                            <a href="{{ url('/') }}" class="hover:text-white transition-colors">Dashboard</a>
                            <a href="{{ url('/reports') }}" class="hover:text-white transition-colors">Reports</a>
                            <a href="{{ url('/help') }}" class="hover:text-white transition-colors">Help Center</a>
                            <div class="flex items-center gap-1 text-red-400">
                                <i class="fas fa-phone"></i>
                                <span>Emergency: 911</span>
                            </div>
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
                <a href="{{ url('/') }}" class="nav-link" onclick="closeMobileSidebar()">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ url('/reports') }}" class="nav-link" onclick="closeMobileSidebar()">
                    <i class="fas fa-flag"></i>
                    <span>Animal Reports</span>
                </a>
                <a href="{{ url('/rescues') }}" class="nav-link active" onclick="closeMobileSidebar()">
                    <i class="fas fa-ambulance"></i>
                    <span>Rescue Operations</span>
                </a>
                <a href="{{ url('/adoptions') }}" class="nav-link" onclick="closeMobileSidebar()">
                    <i class="fas fa-home"></i>
                    <span>Adoptions</span>
                </a>
                <a href="{{ url('/users') }}" class="nav-link" onclick="closeMobileSidebar()">
                    <i class="fas fa-users"></i>
                    <span>Users & Teams</span>
                </a>
                <a href="{{ url('/veterinarians') }}" class="nav-link" onclick="closeMobileSidebar()">
                    <i class="fas fa-stethoscope"></i>
                    <span>Vet Collaborators</span>
                </a>
            </nav>
            
            <!-- Mobile User Profile -->
            <div class="p-4 border-t border-white/10">
                <div class="flex items-center gap-3">
                    <img src="https://ui-avatars.com/api/?name=Rescue+Lead&background=0ea5e9&color=fff" 
                         alt="Rescue Lead" class="w-10 h-10 rounded-full">
                    <div>
                        <h4 class="text-sm font-semibold text-white">Rescue Lead</h4>
                        <p class="text-xs text-gray-400">Operations Manager</p>
                    </div>
                </div>
            </div>
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
        if (closeSidebar) closeSidebar.addEventListener('click', closeMobileSidebar);
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', closeMobileSidebar);

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

        // Button hover effects
        document.querySelectorAll('.btn-primary, .btn-secondary, .btn-success, .btn-warning, .btn-danger').forEach(button => {
            button.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
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

        // Mission status update buttons
        document.querySelectorAll('.btn-success').forEach(button => {
            button.addEventListener('click', function() {
                const mission = this.closest('.bg-white\\/5');
                const statusBadge = mission.querySelector('.status-badge');
                
                if (statusBadge) {
                    statusBadge.className = 'status-badge status-completed';
                    statusBadge.innerHTML = '<i class="fas fa-check"></i> Completed';
                    
                    // Add success animation
                    mission.style.boxShadow = '0 0 20px rgba(16, 185, 129, 0.3)';
                    setTimeout(() => {
                        mission.style.boxShadow = '';
                    }, 1000);
                }
            });
        });

        // Initialize animations
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.animate-fadeIn').forEach((element, index) => {
                element.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>