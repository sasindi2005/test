<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafePaws — Adoption Management</title>
    
    <!-- Laravel Vite directive -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Tailwind CSS as backup -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style type="text/tailwindcss">
        /* Reuse same styles from animal-reports */
        @keyframes paw-touch {
            0%,
            80%,
            100% {
                opacity: 0;
                transform: translateY(0) scale(1);
            }
            10%,
            50% {
                opacity: 1;
                transform: translateY(-10px) scale(1.1);
            }
        }

        .animate-paw {
            animation: paw-touch 2s infinite;
        }

        /* Buttons */
        .primary-btn {
            @apply bg-[#0ea5e9] hover:bg-[#0891b2] text-white px-6 py-3 rounded-md font-medium inline-flex items-center gap-2 transition duration-300;
        }
        .outline-btn {
            @apply border border-[#0ea5e9] text-[#0ea5e9] hover:bg-[#0ea5e9] hover:text-white px-5 py-2 rounded-md font-medium transition duration-300;
        }
        
        .success-btn {
            @apply bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md font-medium transition duration-300;
        }
        .warning-btn {
            @apply bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md font-medium transition duration-300;
        }
        .danger-btn {
            @apply bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md font-medium transition duration-300;
        }
        
        .approve-btn {
            @apply bg-gradient-to-r from-green-600 to-emerald-500 hover:from-green-700 hover:to-emerald-600 text-white px-6 py-3 rounded-md font-bold inline-flex items-center gap-2 transition duration-300 shadow-lg shadow-green-500/25;
        }

        /* Card styles */
        .card {
            @apply bg-white/5 p-6 md:p-8 rounded-xl shadow-md border border-white/10;
        }
        
        .adoption-card {
            @apply bg-white/5 p-4 rounded-xl shadow-md border border-white/10 hover:border-[#0ea5e9]/50 transition-all duration-300 hover:shadow-lg hover:shadow-[#0ea5e9]/10;
        }

        /* Status badges */
        .status-badge {
            @apply px-3 py-1 text-xs font-semibold rounded-full;
        }
        .status-pending { @apply bg-yellow-500/20 text-yellow-300; }
        .status-approved { @apply bg-green-500/20 text-green-300; }
        .status-rejected { @apply bg-red-500/20 text-red-300; }
        .status-completed { @apply bg-blue-500/20 text-blue-300; }
        .status-review { @apply bg-purple-500/20 text-purple-300; }
        .status-homecheck { @apply bg-orange-500/20 text-orange-300; }

        body {
            background-color: #071331;
            font-family: system-ui, -apple-system, sans-serif;
        }

        /* Table styles */
        .table-container {
            @apply overflow-x-auto rounded-lg border border-white/10;
        }
        
        .dashboard-table {
            @apply min-w-full bg-white/5;
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
            @apply hover:bg-white/10 border-b border-white/5 transition duration-150;
        }
        
        .urgent-row {
            @apply bg-gradient-to-r from-yellow-900/10 to-orange-900/10 hover:from-yellow-900/20 hover:to-orange-900/20;
        }
        
        .approved-row {
            @apply bg-gradient-to-r from-green-900/10 to-emerald-900/10 hover:from-green-900/20 hover:to-emerald-900/20;
        }

        /* Filter styles */
        .filter-card {
            @apply bg-white/5 p-4 rounded-lg border border-white/10;
        }
        
        .filter-label {
            @apply block text-sm font-medium text-gray-300 mb-1;
        }
        
        .filter-select {
            @apply bg-white/10 border border-white/20 text-white rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-[#0ea5e9];
        }
        
        .filter-input {
            @apply bg-white/10 border border-white/20 text-white rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-[#0ea5e9];
        }
        
        /* Alert styles */
        .alert-banner {
            @apply bg-gradient-to-r from-[#0ea5e9] to-blue-500 text-white p-4 rounded-lg mb-6 shadow-lg;
        }
        
        /* Progress bar */
        .progress-bar {
            @apply h-2 bg-white/10 rounded-full overflow-hidden;
        }
        
        .progress-fill {
            @apply h-full bg-gradient-to-r from-green-500 to-blue-500 transition-all duration-500;
        }
    </style>
</head>
<body class="text-white">
    <!-- Navigation Bar -->
    <header class="sticky top-0 z-50 bg-[#071331]/95 backdrop-blur-sm border-b border-white/10">
        <div class="flex items-center justify-between px-5 py-4 mx-auto max-w-7xl md:px-12">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <svg width="42" height="42" viewBox="0 0 64 64" fill="none">
                    <rect width="64" height="64" rx="12" fill="#0ea5e9"></rect>
                    <path d="M34.5 36c4-1 8.5 0 11 3 2.5 3 1.8 7.4-0.6 10.7C43.9 53 39.6 54 34.5 54c-5 0-9.7-1-12.6-3.8C17.2 47.4 16.4 43 18.9 40c2.7-3.2 6.9-4.2 11.6-4z" fill="#fff"></path>
                    <circle cx="22.5" cy="20.5" r="6" fill="#fff"></circle>
                    <circle cx="31.5" cy="14.5" r="5" fill="#fff"></circle>
                    <circle cx="43.5" cy="18.5" r="4.5" fill="#fff"></circle>
                </svg>
                <span class="text-xl font-semibold text-white">SafePaws</span>
            </a>

            <!-- Desktop Menu -->
            <nav class="items-center hidden gap-6 text-sm font-medium text-white md:flex">
                <!-- Rescue Team Navigation -->
                <a href="{{ url('/rescue-team') }}" class="transition hover:text-yellow-300">DASHBOARD</a>
                <a href="{{ route('rescue.reports') }}" class="transition hover:text-yellow-300">ANIMAL REPORTS</a>
                <a href="{{ route('rescue.animals') }}" class="transition hover:text-yellow-300">ANIMALS</a>
                <a href="{{ route('rescue.adoptions') }}" class="transition hover:text-yellow-300 text-yellow-300">ADOPTIONS</a>

                <!-- User dropdown -->
                <div class="relative ml-4">
                    <button class="flex items-center gap-2 dropdown-btn">
                        <div class="w-8 h-8 bg-[#0ea5e9] rounded-full flex items-center justify-center">
                            <span class="font-semibold">RT</span>
                        </div>
                        <span>Rescue Team</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute right-0 hidden w-48 mt-2 rounded shadow-lg dropdown bg-blue-500/90 backdrop-blur-sm">
                        <a href="#profile" class="block px-4 py-2 transition hover:bg-blue-400">My Profile</a>
                        <a href="#settings" class="block px-4 py-2 transition hover:bg-blue-400">Settings</a>
                        <a href="#logout" class="block px-4 py-2 transition hover:bg-red-400">Logout</a>
                    </div>
                </div>
            </nav>

            <!-- Mobile menu button -->
            <button class="md:hidden" id="mobileMenuBtn">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile menu -->
        <div class="hidden md:hidden" id="mobileMenu">
            <div class="px-5 py-4 space-y-4 bg-[#0b2447]">
                <a href="{{ url('/rescue-team') }}" class="block py-2">Dashboard</a>
                <a href="{{ route('rescue.reports') }}" class="block py-2">Animal Reports</a>
                <a href="{{ route('rescue.animals') }}" class="block py-2">Animals</a>
                <a href="{{ route('rescue.adoptions') }}" class="block py-2 text-yellow-300">Adoptions</a>
                <a href="#logout" class="block py-2 text-red-400">Logout</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-5 py-8">
        <!-- Adoption Management Banner -->
        <div class="alert-banner mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h2 class="text-xl font-bold">🏠 ADOPTION MANAGEMENT</h2>
                        <p class="text-sm opacity-90">Manage adoption applications, schedule home checks, and approve adoptions</p>
                    </div>
                </div>
                <button class="approve-btn" onclick="processBatchAdoptions()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    BATCH PROCESS
                </button>
            </div>
        </div>

        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white">Adoption Management</h1>
            <p class="text-gray-300 mt-2">Review adoption applications, schedule home checks, and manage the adoption process for rescued animals.</p>
        </div>

        <!-- Adoption Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-6">
            <div class="filter-card">
                <div class="text-2xl font-bold text-yellow-300">18</div>
                <div class="text-sm text-gray-300">Pending Review</div>
            </div>
            <div class="filter-card">
                <div class="text-2xl font-bold text-orange-300">6</div>
                <div class="text-sm text-gray-300">Home Checks Needed</div>
            </div>
            <div class="filter-card">
                <div class="text-2xl font-bold text-green-300">12</div>
                <div class="text-sm text-gray-300">Ready for Approval</div>
            </div>
            <div class="filter-card">
                <div class="text-2xl font-bold text-blue-300">24</div>
                <div class="text-sm text-gray-300">Adopted This Month</div>
            </div>
            <div class="filter-card bg-gradient-to-r from-green-900/30 to-emerald-900/30">
                <div class="text-2xl font-bold text-green-300">156</div>
                <div class="text-sm text-green-200">Total Adopted</div>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="card mb-6">
            <h2 class="text-xl font-bold mb-4">Filter Adoption Applications</h2>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <!-- Status Filter -->
                <div>
                    <label class="filter-label">Adoption Status</label>
                    <select class="filter-select" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="pending">Pending Review</option>
                        <option value="homecheck">Home Check Scheduled</option>
                        <option value="approved">Ready for Approval</option>
                        <option value="rejected">Rejected</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                
                <!-- Animal Type Filter -->
                <div>
                    <label class="filter-label">Animal Type</label>
                    <select class="filter-select" id="animalTypeFilter">
                        <option value="">All Types</option>
                        <option value="dog">Dog</option>
                        <option value="cat">Cat</option>
                        <option value="rabbit">Rabbit</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                
                <!-- Priority Filter -->
                <div>
                    <label class="filter-label">Priority</label>
                    <select class="filter-select" id="priorityFilter">
                        <option value="">All Priorities</option>
                        <option value="high">High Priority</option>
                        <option value="normal">Normal</option>
                        <option value="urgent">Urgent Approval</option>
                    </select>
                </div>
                
                <!-- Date Filter -->
                <div>
                    <label class="filter-label">Application Date</label>
                    <input type="date" class="filter-input" id="dateFilter">
                </div>
                
                <!-- Team Member Filter -->
                <div>
                    <label class="filter-label">Assigned To</label>
                    <select class="filter-select" id="assignedFilter">
                        <option value="">All Team Members</option>
                        <option value="john">John (Team Lead)</option>
                        <option value="sarah">Sarah</option>
                        <option value="mike">Mike</option>
                        <option value="unassigned">Unassigned</option>
                    </select>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex gap-3 mt-4">
                <button class="primary-btn" onclick="applyAdoptionFilters()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Apply Filters
                </button>
                <button class="outline-btn" onclick="clearAdoptionFilters()">Clear Filters</button>
                <button class="success-btn" onclick="exportAdoptionData()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export Data
                </button>
                <button class="warning-btn" onclick="scheduleHomeChecks()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Schedule Home Checks
                </button>
            </div>
        </div>

        <!-- Adoption Applications Table -->
        <div class="card">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold">Adoption Applications</h2>
                <div class="flex gap-2">
                    <button class="primary-btn text-sm" onclick="createAdoptionRecord()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Create Record
                    </button>
                    <button class="outline-btn text-sm" onclick="refreshApplications()">Refresh</button>
                    <button class="approve-btn text-sm" onclick="approveSelected()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Approve Selected
                    </button>
                </div>
            </div>
            
            <div class="table-container">
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th class="w-12">
                                <input type="checkbox" class="rounded">
                            </th>
                            <th>Application ID</th>
                            <th>Applicant</th>
                            <th>Animal</th>
                            <th>Status</th>
                            <th>Applied</th>
                            <th>Assigned To</th>
                            <th>Priority</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Urgent Application -->
                        <tr class="urgent-row">
                            <td><input type="checkbox" class="rounded" checked></td>
                            <td class="font-medium">#ADP-1042</td>
                            <td>
                                <div class="font-medium">Sarah Johnson</div>
                                <div class="text-xs text-gray-400">Family of 4, House with yard</div>
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-medium">Buddy (Dog)</div>
                                        <div class="text-xs text-gray-400">#SP045 • Golden Retriever</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="status-badge status-homecheck">Home Check Scheduled</span></td>
                            <td>
                                <div class="text-white">Nov 14, 2023</div>
                                <div class="text-xs text-gray-400">3 days ago</div>
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 bg-[#0ea5e9] rounded-full flex items-center justify-center text-xs">J</div>
                                    <span>John (Team Lead)</span>
                                </div>
                            </td>
                            <td><span class="px-2 py-1 text-xs font-bold text-white bg-red-500 rounded-full">URGENT</span></td>
                            <td>
                                <div class="flex gap-2">
                                    <button class="text-xs success-btn px-3 py-1" onclick="approveAdoption('ADP-1042')">
                                        Approve
                                    </button>
                                    <button class="text-xs primary-btn px-3 py-1" onclick="viewApplication('ADP-1042')">
                                        View
                                    </button>
                                    <button class="text-xs warning-btn px-3 py-1" onclick="rescheduleHomeCheck('ADP-1042')">
                                        Reschedule
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Pending Application -->
                        <tr>
                            <td><input type="checkbox" class="rounded"></td>
                            <td class="font-medium">#ADP-1041</td>
                            <td>
                                <div class="font-medium">Michael Chen</div>
                                <div class="text-xs text-gray-400">Single, Apartment</div>
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-pink-500/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-medium">Whiskers (Cat)</div>
                                        <div class="text-xs text-gray-400">#SP039 • Tabby</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="status-badge status-pending">Pending Review</span></td>
                            <td>
                                <div class="text-white">Nov 12, 2023</div>
                                <div class="text-xs text-gray-400">5 days ago</div>
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center text-xs">S</div>
                                    <span>Sarah</span>
                                </div>
                            </td>
                            <td><span class="px-2 py-1 text-xs font-bold text-white bg-yellow-500 rounded-full">NORMAL</span></td>
                            <td>
                                <div class="flex gap-2">
                                    <button class="text-xs primary-btn px-3 py-1" onclick="assignToMe('ADP-1041')">
                                        Assign to Me
                                    </button>
                                    <button class="text-xs outline-btn px-3 py-1" onclick="viewApplication('ADP-1041')">
                                        Review
                                    </button>
                                    <button class="text-xs danger-btn px-3 py-1" onclick="rejectApplication('ADP-1041')">
                                        Reject
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Approved Application -->
                        <tr class="approved-row">
                            <td><input type="checkbox" class="rounded"></td>
                            <td class="font-medium">#ADP-1040</td>
                            <td>
                                <div class="font-medium">Emma Wilson</div>
                                <div class="text-xs text-gray-400">Family of 3, House</div>
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-medium">Rocky (Dog)</div>
                                        <div class="text-xs text-gray-400">#SP038 • German Shepherd Mix</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="status-badge status-approved">Ready for Pickup</span></td>
                            <td>
                                <div class="text-white">Nov 10, 2023</div>
                                <div class="text-xs text-gray-400">7 days ago</div>
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 bg-purple-500 rounded-full flex items-center justify-center text-xs">M</div>
                                    <span>Mike</span>
                                </div>
                            </td>
                            <td><span class="px-2 py-1 text-xs font-bold text-white bg-green-500 rounded-full">READY</span></td>
                            <td>
                                <div class="flex gap-2">
                                    <button class="text-xs success-btn px-3 py-1" onclick="completeAdoption('ADP-1040')">
                                        Complete
                                    </button>
                                    <button class="text-xs primary-btn px-3 py-1" onclick="viewApplication('ADP-1040')">
                                        Details
                                    </button>
                                    <button class="text-xs outline-btn px-3 py-1" onclick="sendReminder('ADP-1040')">
                                        Remind
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Completed Adoption -->
                        <tr>
                            <td><input type="checkbox" class="rounded"></td>
                            <td class="font-medium">#ADP-1039</td>
                            <td>
                                <div class="font-medium">Robert Davis</div>
                                <div class="text-xs text-gray-400">Retired, House with yard</div>
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-medium">Charlie (Dog)</div>
                                        <div class="text-xs text-gray-400">#SP037 • Labrador</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="status-badge status-completed">Completed</span></td>
                            <td>
                                <div class="text-white">Nov 8, 2023</div>
                                <div class="text-xs text-gray-400">9 days ago</div>
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 bg-[#0ea5e9] rounded-full flex items-center justify-center text-xs">J</div>
                                    <span>John (Team Lead)</span>
                                </div>
                            </td>
                            <td><span class="px-2 py-1 text-xs font-bold text-white bg-blue-500 rounded-full">DONE</span></td>
                            <td>
                                <div class="flex gap-2">
                                    <button class="text-xs primary-btn px-3 py-1" onclick="viewApplication('ADP-1039')">
                                        View Record
                                    </button>
                                    <button class="text-xs outline-btn px-3 py-1" onclick="followUp('ADP-1039')">
                                        Follow-up
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Rejected Application -->
                        <tr>
                            <td><input type="checkbox" class="rounded"></td>
                            <td class="font-medium">#ADP-1038</td>
                            <td>
                                <div class="font-medium">James Miller</div>
                                <div class="text-xs text-gray-400">Student, Small apartment</div>
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-pink-500/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-medium">Luna (Cat)</div>
                                        <div class="text-xs text-gray-400">#SP036 • Siamese</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="status-badge status-rejected">Rejected</span></td>
                            <td>
                                <div class="text-white">Nov 5, 2023</div>
                                <div class="text-xs text-gray-400">12 days ago</div>
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center text-xs">S</div>
                                    <span>Sarah</span>
                                </div>
                            </td>
                            <td><span class="px-2 py-1 text-xs font-bold text-white bg-gray-500 rounded-full">CLOSED</span></td>
                            <td>
                                <div class="flex gap-2">
                                    <button class="text-xs primary-btn px-3 py-1" onclick="viewApplication('ADP-1038')">
                                        View Reason
                                    </button>
                                    <button class="text-xs outline-btn px-3 py-1" onclick="reopenApplication('ADP-1038')">
                                        Reopen
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Bulk Actions & Pagination -->
            <div class="flex items-center justify-between mt-6">
                <div class="flex items-center gap-3">
                    <button class="outline-btn text-sm" onclick="bulkAssign()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Bulk Assign
                    </button>
                    <button class="outline-btn text-sm" onclick="exportSelected()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Export Selected
                    </button>
                    <button class="approve-btn text-sm" onclick="processBatchAdoptions()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Batch Approve
                    </button>
                </div>
                
                <div class="flex items-center gap-2">
                    <button class="px-3 py-1 rounded bg-white/10 hover:bg-white/20">1</button>
                    <button class="px-3 py-1 rounded hover:bg-white/10">2</button>
                    <button class="px-3 py-1 rounded hover:bg-white/10">3</button>
                    <span class="text-gray-400">...</span>
                    <button class="px-3 py-1 rounded hover:bg-white/10">Next →</button>
                </div>
            </div>
        </div>
        
        <!-- Adoption Process Statistics -->
        <div class="card mt-6">
            <h2 class="text-xl font-bold mb-4">Adoption Process Statistics</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-blue-900/20 p-4 rounded-lg">
                    <h3 class="font-bold text-blue-300 mb-2">Average Processing Time</h3>
                    <div class="text-2xl font-bold">4.2 days</div>
                    <p class="text-sm text-gray-300">From application to approval</p>
                    <div class="progress-bar mt-2">
                        <div class="progress-fill" style="width: 75%"></div>
                    </div>
                </div>
                
                <div class="bg-green-900/20 p-4 rounded-lg">
                    <h3 class="font-bold text-green-300 mb-2">Success Rate</h3>
                    <div class="text-2xl font-bold">92%</div>
                    <p class="text-sm text-gray-300">Applications completed successfully</p>
                    <div class="progress-bar mt-2">
                        <div class="progress-fill" style="width: 92%"></div>
                    </div>
                </div>
                
                <div class="bg-purple-900/20 p-4 rounded-lg">
                    <h3 class="font-bold text-purple-300 mb-2">Team Performance</h3>
                    <div class="text-2xl font-bold">18/month</div>
                    <p class="text-sm text-gray-300">Average adoptions per team member</p>
                    <div class="progress-bar mt-2">
                        <div class="progress-fill" style="width: 90%"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Upcoming Home Checks -->
        <div class="card mt-6">
            <h2 class="text-xl font-bold mb-4">Upcoming Home Checks</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-yellow-900/20 p-4 rounded-lg">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <h3 class="font-bold text-white">Today, 2:00 PM</h3>
                            <p class="text-sm text-gray-300">Sarah Johnson • Buddy (Dog)</p>
                        </div>
                        <span class="status-badge status-homecheck">Scheduled</span>
                    </div>
                    <div class="text-sm text-gray-300">
                        <div class="flex items-center gap-2 mb-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>123 Main St, Cityville</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>Assigned to: John (Team Lead)</span>
                        </div>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <button class="text-xs primary-btn flex-1" onclick="startHomeCheck('ADP-1042')">
                            Start Checklist
                        </button>
                        <button class="text-xs outline-btn flex-1" onclick="rescheduleHomeCheck('ADP-1042')">
                            Reschedule
                        </button>
                    </div>
                </div>
                
                <div class="bg-blue-900/20 p-4 rounded-lg">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <h3 class="font-bold text-white">Tomorrow, 10:00 AM</h3>
                            <p class="text-sm text-gray-300">Lisa Parker • Mittens (Cat)</p>
                        </div>
                        <span class="status-badge status-review">Confirmed</span>
                    </div>
                    <div class="text-sm text-gray-300">
                        <div class="flex items-center gap-2 mb-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>456 Oak Ave, Townsville</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>Assigned to: Sarah</span>
                        </div>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <button class="text-xs primary-btn flex-1" onclick="prepareChecklist('ADP-1043')">
                            Prepare
                        </button>
                        <button class="text-xs outline-btn flex-1" onclick="contactApplicant('ADP-1043')">
                            Contact
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScript -->
    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Dropdown functionality
        document.querySelectorAll('.dropdown-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const dropdown = this.closest('.relative').querySelector('.dropdown');
                dropdown.classList.toggle('hidden');
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', () => {
            document.querySelectorAll('.dropdown').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        });

        // ====================
        // ADOPTION MANAGEMENT FUNCTIONS
        // ====================
        
        function applyAdoptionFilters() {
            const status = document.getElementById('statusFilter').value;
            const animalType = document.getElementById('animalTypeFilter').value;
            const priority = document.getElementById('priorityFilter').value;
            const assigned = document.getElementById('assignedFilter').value;
            
            const filters = [];
            if (status) filters.push(`Status: ${status}`);
            if (animalType) filters.push(`Animal Type: ${animalType}`);
            if (priority) filters.push(`Priority: ${priority}`);
            if (assigned) filters.push(`Assigned To: ${assigned}`);
            
            if (filters.length > 0) {
                alert(`Applying adoption filters:\n${filters.join('\n')}\n\nFiltering applications...`);
            } else {
                alert('Showing all adoption applications...');
            }
        }
        
        function clearAdoptionFilters() {
            document.getElementById('statusFilter').value = '';
            document.getElementById('animalTypeFilter').value = '';
            document.getElementById('priorityFilter').value = '';
            document.getElementById('assignedFilter').value = '';
            document.getElementById('dateFilter').value = '';
            
            alert('All filters cleared. Showing all applications.');
        }
        
        function exportAdoptionData() {
            alert('📊 Exporting adoption data to CSV...\n\nFile: SafePaws_Adoption_Report.csv\n\nIncludes all application data, status, and team assignments.');
        }
        
        function scheduleHomeChecks() {
            const count = prompt("How many home checks to schedule?", "5");
            if (count) {
                alert(`📅 Scheduling ${count} home checks...\n\nHome checks will be scheduled for the next 7 days.\nTeam members will be assigned automatically.\nApplicants will receive email notifications.`);
            }
        }
        
        function createAdoptionRecord() {
            alert("Creating new adoption record...\n\nThis opens a form to manually create an adoption record for:\n- Direct adoptions from shelter\n- Foster-to-adopt cases\n- Special circumstances");
        }
        
        function refreshApplications() {
            alert("Refreshing adoption applications data...\n\nFetching latest updates from database.");
        }
        
        function approveSelected() {
            alert("Approving selected adoption applications...\n\nSelected applications will be:\n- Moved to 'Ready for Pickup'\n- Applicants notified via email\n- Animals marked as 'Adopted'\n- Records updated in system");
        }
        
        function processBatchAdoptions() {
            alert("🚀 PROCESSING BATCH ADOPTIONS\n\nBatch actions initiated:\n1. Bulk approval of selected applications\n2. Automated email notifications\n3. Animal status updates\n4. Documentation generation\n5. Follow-up scheduling");
        }
        
        function viewApplication(appId) {
            alert(`Viewing adoption application ${appId}\n\nOpening detailed view with:\n- Applicant information\n- Animal details\n- Application history\n- Notes and comments\n- Documents and forms`);
        }
        
        function approveAdoption(appId) {
            alert(`✅ APPROVING ADOPTION ${appId}\n\nActions:\n1. Application approved\n2. Applicant notified\n3. Pickup scheduled\n4. Animal status updated to 'Adopted'\n5. Documentation sent`);
        }
        
        function assignToMe(appId) {
            alert(`👤 Assigning application ${appId} to you...\n\nYou are now responsible for:\n- Reviewing application\n- Contacting applicant\n- Scheduling home check\n- Making final recommendation`);
        }
        
        function rejectApplication(appId) {
            const reason = prompt("Enter reason for rejection:", "Insufficient space for animal");
            if (reason) {
                alert(`❌ REJECTING APPLICATION ${appId}\n\nReason: ${reason}\n\nApplication will be:\n- Moved to 'Rejected' status\n- Applicant notified with reason\n- Record kept for future reference`);
            }
        }
        
        function completeAdoption(appId) {
            alert(`🏁 COMPLETING ADOPTION ${appId}\n\nMarking adoption as completed:\n1. Animal handed over to adopter\n2. Final paperwork signed\n3. Follow-up scheduled (30 days)\n4. Record archived\n5. Success story logged`);
        }
        
        function rescheduleHomeCheck(appId) {
            const newDate = prompt("Enter new date for home check (YYYY-MM-DD):", "2023-11-20");
            const newTime = prompt("Enter new time (HH:MM):", "14:00");
            
            if (newDate && newTime) {
                alert(`📅 RESCHEDULING HOME CHECK ${appId}\n\nNew date: ${newDate} at ${newTime}\n\nApplicant will be notified automatically.\nCalendar updated.`);
            }
        }
        
        function sendReminder(appId) {
            alert(`📨 SENDING REMINDER ${appId}\n\nReminder email sent to applicant:\n- Pickup date reminder\n- Required documents\n- Shelter contact information\n- FAQ link`);
        }
        
        function followUp(appId) {
            alert(`📞 SCHEDULING FOLLOW-UP ${appId}\n\n30-day follow-up scheduled:\n- Welfare check call\n- Photo request\n- Support offered\n- Feedback collected`);
        }
        
        function reopenApplication(appId) {
            alert(`🔄 REOPENING APPLICATION ${appId}\n\nApplication reopened for review.\nStatus changed to 'Pending Review'.\nAssigned to original team member.`);
        }
        
        function bulkAssign() {
            alert("Bulk assigning selected applications to team members...\n\nApplications will be distributed evenly among available team members.");
        }
        
        function exportSelected() {
            alert("Exporting selected adoption applications...\n\nSelected records will be exported as PDF and CSV files.");
        }
        
        function startHomeCheck(appId) {
            alert(`🏠 STARTING HOME CHECK ${appId}\n\nOpening home check checklist:\n1. Safety assessment\n2. Space evaluation\n3. Family meeting\n4. Animal introduction\n5. Documentation`);
        }
        
        function prepareChecklist(appId) {
            alert(`📋 PREPARING HOME CHECKLIST ${appId}\n\nPreparing documents:\n- Checklist form\n- Safety guidelines\n- Animal profile\n- Contact information\n- Maps and directions`);
        }
        
        function contactApplicant(appId) {
            alert(`📞 CONTACTING APPLICANT ${appId}\n\nCalling applicant to confirm home check appointment.\nAvailable communication methods:\n- Phone call\n- SMS\n- Email\n- WhatsApp`);
        }

        // Demo functionality for buttons
        document.querySelectorAll('button').forEach(btn => {
            if (!btn.onclick) {
                btn.addEventListener('click', function(e) {
                    if (this.textContent.includes('View') || 
                        this.textContent.includes('Details') || 
                        this.textContent.includes('Review')) {
                        e.preventDefault();
                        const action = this.textContent.trim();
                        alert(`[Demo] ${action} - This would trigger the full feature in production.`);
                    }
                });
            }
        });
        
        // Set active nav link
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('nav a');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('text-yellow-300');
                } else {
                    link.classList.remove('text-yellow-300');
                }
            });
        });
    </script>
</body>
</html>