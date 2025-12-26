<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adoptions - SafePaws</title>
    
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

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
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
        
        .status-under-review { 
            background-color: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
        }
        
        .status-home-check { 
            background-color: rgba(139, 92, 246, 0.2);
            color: #8b5cf6;
        }
        
        .status-approved { 
            background-color: rgba(16, 185, 129, 0.2);
            color: #10b981;
        }
        
        .status-rejected { 
            background-color: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }
        
        .status-completed { 
            background-color: rgba(34, 197, 94, 0.2);
            color: #22c55e;
        }

        /* Animal Type Badges */
        .type-dog {
            @apply bg-blue-500/20 text-blue-300;
        }
        
        .type-cat {
            @apply bg-pink-500/20 text-pink-300;
        }
        
        .type-other {
            @apply bg-purple-500/20 text-purple-300;
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

        /* Animal Cards */
        .animal-card {
            @apply glass-card overflow-hidden hover-lift;
        }
        
        .animal-image {
            @apply w-full h-48 object-cover;
        }
        
        .animal-features {
            @apply flex flex-wrap gap-2 mt-2;
        }
        
        .feature-tag {
            @apply px-2 py-1 text-xs bg-white/10 rounded-full;
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
                
                <a href="{{ url('/rescues') }}" class="nav-link">
                    <i class="fas fa-ambulance"></i>
                    <span>Rescue Operations</span>
                </a>
                
                <a href="{{ url('/adoptions') }}" class="nav-link active">
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
                    <img src="https://ui-avatars.com/api/?name=Adoption+Officer&background=0ea5e9&color=fff" 
                         alt="Adoption Officer" class="w-10 h-10 rounded-full">
                    <div class="flex-1">
                        <h4 class="text-sm font-semibold text-white">Adoption Officer</h4>
                        <p class="text-xs text-gray-400">Adoption Coordinator</p>
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
                        <h2 class="text-xl font-bold text-white">Adoption Management</h2>
                        <p class="text-sm text-gray-400">Find loving homes for rescued animals</p>
                    </div>
                    
                    <!-- Right Side Actions -->
                    <div class="flex items-center gap-4">
                        <!-- Notifications -->
                        <div class="relative">
                            <button class="text-gray-300 hover:text-white relative dropdown-toggle">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">8</span>
                            </button>
                            <div class="absolute right-0 mt-2 w-80 bg-[#0b2447] border border-white/10 rounded-lg shadow-lg hidden dropdown-menu">
                                <div class="p-4 border-b border-white/10">
                                    <h3 class="font-semibold text-white">Adoption Notifications</h3>
                                </div>
                                <div class="max-h-64 overflow-y-auto">
                                    <a href="#" class="block px-4 py-3 hover:bg-white/10 border-b border-white/5">
                                        <p class="text-sm text-white">New application received</p>
                                        <p class="text-xs text-gray-400">30 minutes ago</p>
                                    </a>
                                    <a href="#" class="block px-4 py-3 hover:bg-white/10 border-b border-white/5">
                                        <p class="text-sm text-white">Home check scheduled</p>
                                        <p class="text-xs text-gray-400">2 hours ago</p>
                                    </a>
                                    <a href="#" class="block px-4 py-3 hover:bg-white/10">
                                        <p class="text-sm text-white">Adoption completed</p>
                                        <p class="text-xs text-gray-400">1 day ago</p>
                                    </a>
                                </div>
                                <a href="{{ url('/notifications') }}" class="block px-4 py-3 text-center text-sm text-[#0ea5e9] hover:bg-white/10">
                                    View All Notifications
                                </a>
                            </div>
                        </div>
                        
                        <!-- Quick Actions -->
                        <a href="{{ url('/adoptions/create') }}" class="btn-primary">
                            <i class="fas fa-plus"></i>
                            New Adoption
                        </a>
                        <a href="{{ url('/animals') }}" class="btn-secondary">
                            <i class="fas fa-search"></i>
                            Browse Animals
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
                                <div class="stats-icon bg-green-500/20 text-green-400">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="stats-value text-white">67</div>
                                <div class="stats-label">Total Adoptions</div>
                            </div>
                            <div class="text-green-400">
                                <i class="fas fa-arrow-up"></i> 12 this month
                            </div>
                        </div>
                    </div>
                    
                    <div class="stats-card">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="stats-icon bg-yellow-500/20 text-yellow-400">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="stats-value text-white">15</div>
                                <div class="stats-label">Pending Applications</div>
                            </div>
                            <div class="text-yellow-400">
                                <i class="fas fa-exclamation-circle"></i> Needs review
                            </div>
                        </div>
                    </div>
                    
                    <div class="stats-card">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="stats-icon bg-blue-500/20 text-blue-400">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <div class="stats-value text-white">28</div>
                                <div class="stats-label">Available Animals</div>
                            </div>
                            <div class="text-blue-400">
                                <i class="fas fa-paw"></i> Ready for homes
                            </div>
                        </div>
                    </div>
                    
                    <div class="stats-card">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="stats-icon bg-purple-500/20 text-purple-400">
                                    <i class="fas fa-user-friends"></i>
                                </div>
                                <div class="stats-value text-white">42</div>
                                <div class="stats-label">Active Applicants</div>
                            </div>
                            <div class="text-purple-400">
                                <i class="fas fa-users"></i> Seeking pets
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Applications -->
                <div class="glass-card p-6 mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-white">Pending Adoption Applications</h3>
                        <div class="flex gap-2">
                            <select class="bg-white/10 text-white text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0ea5e9]">
                                <option>All Status</option>
                                <option>Under Review</option>
                                <option>Home Check</option>
                                <option>Approved</option>
                            </select>
                            <select class="bg-white/10 text-white text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0ea5e9]">
                                <option>All Animals</option>
                                <option>Dogs</option>
                                <option>Cats</option>
                                <option>Other</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="dashboard-table">
                            <thead>
                                <tr>
                                    <th>Application ID</th>
                                    <th>Applicant</th>
                                    <th>Animal</th>
                                    <th>Applied</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Application 1 -->
                                <tr class="animate-fadeIn">
                                    <td class="font-medium">#AD-1048</td>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name=John+Doe&background=0ea5e9&color=fff" 
                                                 alt="John Doe" class="w-8 h-8 rounded-full">
                                            <div>
                                                <div class="font-medium text-white">John Doe</div>
                                                <div class="text-xs text-gray-400">Family of 4</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center">
                                                <i class="fas fa-dog text-blue-400"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-white">Buddy</div>
                                                <div class="text-xs text-gray-400">Golden Retriever</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm">Today</div>
                                        <div class="text-xs text-gray-400">10:30 AM</div>
                                    </td>
                                    <td>
                                        <span class="status-badge status-under-review">
                                            <i class="fas fa-search"></i>
                                            Under Review
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex gap-2">
                                            <a href="{{ url('/adoptions/AD-1048') }}" class="btn-primary text-sm px-3 py-1">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button class="btn-success text-sm px-3 py-1">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="btn-warning text-sm px-3 py-1">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Application 2 -->
                                <tr class="animate-fadeIn" style="animation-delay: 0.1s">
                                    <td class="font-medium">#AD-1047</td>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name=Sarah+Smith&background=ec4899&color=fff" 
                                                 alt="Sarah Smith" class="w-8 h-8 rounded-full">
                                            <div>
                                                <div class="font-medium text-white">Sarah Smith</div>
                                                <div class="text-xs text-gray-400">Single</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-pink-500/20 rounded-full flex items-center justify-center">
                                                <i class="fas fa-cat text-pink-400"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-white">Mittens</div>
                                                <div class="text-xs text-gray-400">Tabby Cat</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm">Yesterday</div>
                                        <div class="text-xs text-gray-400">3:45 PM</div>
                                    </td>
                                    <td>
                                        <span class="status-badge status-home-check">
                                            <i class="fas fa-home"></i>
                                            Home Check Scheduled
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex gap-2">
                                            <a href="{{ url('/adoptions/AD-1047') }}" class="btn-primary text-sm px-3 py-1">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button class="btn-secondary text-sm px-3 py-1">
                                                <i class="fas fa-calendar"></i>
                                            </button>
                                            <button class="btn-success text-sm px-3 py-1">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Application 3 -->
                                <tr class="animate-fadeIn" style="animation-delay: 0.2s">
                                    <td class="font-medium">#AD-1046</td>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name=Mike+Wilson&background=10b981&color=fff" 
                                                 alt="Mike Wilson" class="w-8 h-8 rounded-full">
                                            <div>
                                                <div class="font-medium text-white">Mike Wilson</div>
                                                <div class="text-xs text-gray-400">Couple</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center">
                                                <i class="fas fa-dog text-blue-400"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-white">Rocky</div>
                                                <div class="text-xs text-gray-400">Mixed Breed</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm">2 days ago</div>
                                        <div class="text-xs text-gray-400">11:20 AM</div>
                                    </td>
                                    <td>
                                        <span class="status-badge status-pending">
                                            <i class="fas fa-clock"></i>
                                            Pending Review
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex gap-2">
                                            <a href="{{ url('/adoptions/AD-1046') }}" class="btn-primary text-sm px-3 py-1">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button class="btn-secondary text-sm px-3 py-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Application 4 -->
                                <tr class="animate-fadeIn" style="animation-delay: 0.3s">
                                    <td class="font-medium">#AD-1045</td>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name=Emma+Johnson&background=8b5cf6&color=fff" 
                                                 alt="Emma Johnson" class="w-8 h-8 rounded-full">
                                            <div>
                                                <div class="font-medium text-white">Emma Johnson</div>
                                                <div class="text-xs text-gray-400">Family of 3</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-pink-500/20 rounded-full flex items-center justify-center">
                                                <i class="fas fa-cat text-pink-400"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-white">Luna</div>
                                                <div class="text-xs text-gray-400">Siamese Cat</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm">3 days ago</div>
                                        <div class="text-xs text-gray-400">2:15 PM</div>
                                    </td>
                                    <td>
                                        <span class="status-badge status-approved">
                                            <i class="fas fa-thumbs-up"></i>
                                            Approved
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex gap-2">
                                            <a href="{{ url('/adoptions/AD-1045') }}" class="btn-primary text-sm px-3 py-1">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button class="btn-success text-sm px-3 py-1">
                                                <i class="fas fa-file-contract"></i>
                                            </button>
                                            <button class="btn-secondary text-sm px-3 py-1">
                                                <i class="fas fa-calendar-check"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="flex justify-between items-center mt-6">
                        <div class="text-sm text-gray-400">
                            Showing 4 of 15 pending applications
                        </div>
                        <a href="{{ url('/applications') }}" class="btn-secondary">
                            <i class="fas fa-list"></i>
                            View All Applications
                        </a>
                    </div>
                </div>

                <!-- Available Animals -->
                <div class="glass-card p-6 mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-white">Available for Adoption</h3>
                        <a href="{{ url('/animals') }}" class="text-sm text-[#0ea5e9] hover:text-[#0891b2]">
                            <i class="fas fa-search"></i>
                            Browse All Animals
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Animal 1 -->
                        <div class="animal-card animate-fadeIn">
                            <img src="https://images.unsplash.com/photo-1558944350-b2ec1b2a4b5a?q=80&w=400&auto=format&fit=crop" 
                                 alt="Buddy" 
                                 class="animal-image">
                            <div class="p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-bold text-lg">Buddy</h4>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="status-badge type-dog">Dog</span>
                                            <span class="text-sm text-gray-400">• 3 years</span>
                                        </div>
                                    </div>
                                    <span class="status-badge status-approved">
                                        Ready
                                    </span>
                                </div>
                                <p class="text-sm text-gray-300 mt-2">
                                    Friendly Golden Retriever rescued 2 months ago. Great with kids and other pets.
                                </p>
                                <div class="animal-features">
                                    <span class="feature-tag">Vaccinated</span>
                                    <span class="feature-tag">Neutered</span>
                                    <span class="feature-tag">House-trained</span>
                                </div>
                                <div class="flex gap-2 mt-4">
                                    <a href="{{ url('/animals/buddy') }}" class="btn-primary flex-1 text-center justify-center">
                                        <i class="fas fa-eye"></i>
                                        View Profile
                                    </a>
                                    <a href="{{ url('/adoptions/create') }}" class="btn-success">
                                        <i class="fas fa-home"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Animal 2 -->
                        <div class="animal-card animate-fadeIn" style="animation-delay: 0.1s">
                            <img src="https://images.unsplash.com/photo-1546182990-dffeafbe841d?q=80&w=400&auto=format&fit=crop" 
                                 alt="Mittens" 
                                 class="animal-image">
                            <div class="p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-bold text-lg">Mittens</h4>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="status-badge type-cat">Cat</span>
                                            <span class="text-sm text-gray-400">• 2 years</span>
                                        </div>
                                    </div>
                                    <span class="status-badge status-approved">
                                        Ready
                                    </span>
                                </div>
                                <p class="text-sm text-gray-300 mt-2">
                                    Calm and affectionate Tabby cat. Loves cuddles and quiet environments.
                                </p>
                                <div class="animal-features">
                                    <span class="feature-tag">Vaccinated</span>
                                    <span class="feature-tag">Spayed</span>
                                    <span class="feature-tag">Litter-trained</span>
                                </div>
                                <div class="flex gap-2 mt-4">
                                    <a href="{{ url('/animals/mittens') }}" class="btn-primary flex-1 text-center justify-center">
                                        <i class="fas fa-eye"></i>
                                        View Profile
                                    </a>
                                    <a href="{{ url('/adoptions/create') }}" class="btn-success">
                                        <i class="fas fa-home"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Animal 3 -->
                        <div class="animal-card animate-fadeIn" style="animation-delay: 0.2s">
                            <img src="https://images.unsplash.com/photo-1514888286974-6d03bde4ba4?q=80&w=400&auto=format&fit=crop" 
                                 alt="Rocky" 
                                 class="animal-image">
                            <div class="p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-bold text-lg">Rocky</h4>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="status-badge type-dog">Dog</span>
                                            <span class="text-sm text-gray-400">• 4 years</span>
                                        </div>
                                    </div>
                                    <span class="status-badge status-under-review">
                                        In Treatment
                                    </span>
                                </div>
                                <p class="text-sm text-gray-300 mt-2">
                                    Brave mixed breed recovering from surgery. Will be ready for adoption in 2 weeks.
                                </p>
                                <div class="animal-features">
                                    <span class="feature-tag">Vaccinated</span>
                                    <span class="feature-tag">Post-op care</span>
                                    <span class="feature-tag">Friendly</span>
                                </div>
                                <div class="flex gap-2 mt-4">
                                    <a href="{{ url('/animals/rocky') }}" class="btn-primary flex-1 text-center justify-center">
                                        <i class="fas fa-eye"></i>
                                        View Profile
                                    </a>
                                    <button class="btn-secondary" disabled>
                                        <i class="fas fa-clock"></i>
                                        Coming Soon
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Adoption Process & Stats -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Adoption Process -->
                    <div class="glass-card p-6">
                        <h3 class="text-lg font-semibold text-white mb-6">Adoption Process</h3>
                        
                        <div class="space-y-4">
                            <div class="progress-step step-completed">
                                <div class="step-number">1</div>
                                <div class="flex-1">
                                    <div class="font-medium text-white">Application Submission</div>
                                    <div class="text-sm text-gray-400">Applicant fills out adoption form</div>
                                </div>
                            </div>
                            <div class="step-line"></div>
                            
                            <div class="progress-step step-completed">
                                <div class="step-number">2</div>
                                <div class="flex-1">
                                    <div class="font-medium text-white">Initial Review</div>
                                    <div class="text-sm text-gray-400">We review application details</div>
                                </div>
                            </div>
                            <div class="step-line"></div>
                            
                            <div class="progress-step step-active">
                                <div class="step-number">3</div>
                                <div class="flex-1">
                                    <div class="font-medium text-white">Home Check</div>
                                    <div class="text-sm text-gray-400">Visit applicant's home environment</div>
                                </div>
                            </div>
                            <div class="step-line"></div>
                            
                            <div class="progress-step">
                                <div class="step-number">4</div>
                                <div class="flex-1">
                                    <div class="font-medium text-white">Approval</div>
                                    <div class="text-sm text-gray-400">Final decision and paperwork</div>
                                </div>
                            </div>
                            <div class="step-line"></div>
                            
                            <div class="progress-step">
                                <div class="step-number">5</div>
                                <div class="flex-1">
                                    <div class="font-medium text-white">Adoption Day</div>
                                    <div class="text-sm text-gray-400">Animal goes to new home</div>
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{ url('/adoptions/process') }}" class="w-full mt-6 btn-secondary inline-flex justify-center">
                            <i class="fas fa-info-circle"></i>
                            Learn More About Process
                        </a>
                    </div>

                    <!-- Success Stories -->
                    <div class="glass-card p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-white">Recent Success Stories</h3>
                            <a href="{{ url('/success-stories') }}" class="text-sm text-[#0ea5e9] hover:text-[#0891b2]">
                                View All
                            </a>
                        </div>
                        
                        <div class="space-y-4">
                            <!-- Story 1 -->
                            <div class="p-4 bg-white/5 rounded-lg">
                                <div class="flex items-start gap-3">
                                    <img src="https://images.unsplash.com/photo-1568640347023-a616a30bc3bd?q=80&w=100&auto=format&fit=crop" 
                                         alt="Max" 
                                         class="w-16 h-16 rounded-lg object-cover">
                                    <div class="flex-1">
                                        <div class="font-medium text-white">Max found his forever home!</div>
                                        <div class="text-sm text-gray-400">Adopted by the Johnson family last week</div>
                                        <div class="mt-2 text-xs text-gray-500">
                                            "Max has brought so much joy to our family. Thank you SafePaws!"
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Story 2 -->
                            <div class="p-4 bg-white/5 rounded-lg">
                                <div class="flex items-start gap-3">
                                    <img src="https://images.unsplash.com/photo-1592194996308-7b43878e84a6?q=80&w=100&auto=format&fit=crop" 
                                         alt="Luna" 
                                         class="w-16 h-16 rounded-lg object-cover">
                                    <div class="flex-1">
                                        <div class="font-medium text-white">Luna's new beginning</div>
                                        <div class="text-sm text-gray-400">Rescued from streets, now loving apartment life</div>
                                        <div class="mt-2 text-xs text-gray-500">
                                            "She's the perfect companion for my small apartment."
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Story 3 -->
                            <div class="p-4 bg-white/5 rounded-lg">
                                <div class="flex items-start gap-3">
                                    <img src="https://images.unsplash.com/photo-1517849845537-4d257902454a?q=80&w=100&auto=format&fit=crop" 
                                         alt="Charlie" 
                                         class="w-16 h-16 rounded-lg object-cover">
                                    <div class="flex-1">
                                        <div class="font-medium text-white">Charlie helps with anxiety</div>
                                        <div class="text-sm text-gray-400">Therapy dog adoption success</div>
                                        <div class="mt-2 text-xs text-gray-500">
                                            "Charlie has made a huge difference in my mental health journey."
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 p-4 bg-green-500/10 rounded-lg border border-green-500/20">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-heart text-green-400"></i>
                                </div>
                                <div>
                                    <div class="font-medium text-white">67 Happy Endings</div>
                                    <div class="text-sm text-gray-300">Animals finding loving homes this year</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="glass-card p-6">
                    <h3 class="text-lg font-semibold text-white mb-6">Quick Actions</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ url('/adoptions/create') }}" class="btn-primary text-center justify-center">
                            <i class="fas fa-file-alt"></i>
                            New Application
                        </a>
                        
                        <a href="{{ url('/applicants') }}" class="btn-secondary text-center justify-center">
                            <i class="fas fa-user-check"></i>
                            Review Applicants
                        </a>
                        
                        <a href="{{ url('/home-checks') }}" class="btn-secondary text-center justify-center">
                            <i class="fas fa-home"></i>
                            Schedule Home Check
                        </a>
                        
                        <a href="{{ url('/adoptions/completed') }}" class="btn-success text-center justify-center">
                            <i class="fas fa-check-circle"></i>
                            Mark Complete
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
                                <div class="font-semibold text-white">SafePaws Adoption Management</div>
                                <div class="text-xs text-gray-400">Creating forever families • © 2023 All rights reserved</div>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4 text-sm text-gray-400">
                            <a href="{{ url('/') }}" class="hover:text-white transition-colors">Dashboard</a>
                            <a href="{{ url('/reports') }}" class="hover:text-white transition-colors">Reports</a>
                            <a href="{{ url('/help') }}" class="hover:text-white transition-colors">Help Center</a>
                            <div class="flex items-center gap-1 text-blue-400">
                                <i class="fas fa-phone"></i>
                                <span>Adoption: (555) 123-4567</span>
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
                <a href="{{ url('/rescues') }}" class="nav-link" onclick="closeMobileSidebar()">
                    <i class="fas fa-ambulance"></i>
                    <span>Rescue Operations</span>
                </a>
                <a href="{{ url('/adoptions') }}" class="nav-link active" onclick="closeMobileSidebar()">
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
                    <img src="https://ui-avatars.com/api/?name=Adoption+Officer&background=0ea5e9&color=fff" 
                         alt="Adoption Officer" class="w-10 h-10 rounded-full">
                    <div>
                        <h4 class="text-sm font-semibold text-white">Adoption Officer</h4>
                        <p class="text-xs text-gray-400">Adoption Coordinator</p>
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
        document.querySelectorAll('.btn-primary, .btn-secondary, .btn-success, .btn-warning').forEach(button => {
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

        // Application status updates
        document.querySelectorAll('.btn-success').forEach(button => {
            if (button.innerHTML.includes('fa-check')) {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const statusBadge = row.querySelector('.status-badge');
                    
                    if (statusBadge) {
                        statusBadge.className = 'status-badge status-approved';
                        statusBadge.innerHTML = '<i class="fas fa-thumbs-up"></i> Approved';
                        
                        // Add success animation
                        row.style.backgroundColor = 'rgba(16, 185, 129, 0.1)';
                        setTimeout(() => {
                            row.style.backgroundColor = '';
                        }, 2000);
                        
                        // Show success message
                        alert('Application approved successfully!');
                    }
                });
            }
        });

        // Animal card hover effects
        document.querySelectorAll('.animal-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.classList.add('animate-fadeIn');
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