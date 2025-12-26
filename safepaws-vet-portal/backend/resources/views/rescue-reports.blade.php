<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafePaws — Animal Reports Management</title>
    
    <!-- Laravel Vite directive -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Tailwind CSS as backup -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style type="text/tailwindcss">
        /* Reuse same styles from rescue-team dashboard */
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

        @keyframes paw-tap {
            0%,
            100% {
                transform: scale(1);
            }
            50% {
                transform: scale(0.9);
            }
        }

        .animate-paw {
            animation: paw-touch 2s infinite;
        }

        /* Typography */
        .title {
            @apply text-[1.75rem] md:text-[3.125rem] leading-[1.05] font-semibold tracking-wide;
        }
        .subtitle {
            @apply text-[1.125rem] md:text-[1.625rem] font-light;
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
        
        .emergency-btn {
            @apply bg-gradient-to-r from-red-600 to-orange-500 hover:from-red-700 hover:to-orange-600 text-white px-6 py-3 rounded-md font-bold inline-flex items-center gap-2 transition duration-300 shadow-lg shadow-red-500/25;
        }

        /* Card styles */
        .card {
            @apply bg-white/5 p-6 md:p-8 rounded-xl shadow-md border border-white/10;
        }
        
        .emergency-card {
            @apply bg-gradient-to-r from-red-900/30 to-orange-900/20 p-6 md:p-8 rounded-xl shadow-md border border-red-500/30;
        }

        /* Status badges */
        .status-badge {
            @apply px-3 py-1 text-xs font-semibold rounded-full;
        }
        .status-pending { @apply bg-yellow-500/20 text-yellow-300; }
        .status-assigned { @apply bg-blue-500/20 text-blue-300; }
        .status-in-progress { @apply bg-purple-500/20 text-purple-300; }
        .status-rescued { @apply bg-green-500/20 text-green-300; }
        .status-urgent { @apply bg-red-500/20 text-red-300; }
        .status-flood { @apply bg-gradient-to-r from-blue-500/30 to-cyan-500/30 text-white; }
        .status-emergency { @apply bg-gradient-to-r from-red-500/30 to-orange-500/30 text-white animate-pulse; }

        .gray-border {
            @apply border-t-[8px] border-[#0b2447];
        }

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
        
        .flood-row {
            @apply bg-gradient-to-r from-blue-900/10 to-cyan-900/10 hover:from-blue-900/20 hover:to-cyan-900/20;
        }
        
        .emergency-row {
            @apply bg-gradient-to-r from-red-900/10 to-orange-900/10 hover:from-red-900/20 hover:to-orange-900/20 animate-pulse;
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
        
        /* FIX: Make dropdown options visible */
        .filter-select option {
            @apply bg-[#071331] text-white;
        }
        
        /* Fix for all dropdowns */
        select option {
            @apply bg-[#071331] text-white;
        }
        
        .filter-input {
            @apply bg-white/10 border border-white/20 text-white rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-[#0ea5e9];
        }
        
        /* Map styles */
        .flood-map {
            @apply w-full h-64 md:h-80 rounded-lg bg-gradient-to-br from-blue-900 to-gray-900 overflow-hidden relative;
        }
        
        .flood-zone {
            @apply absolute rounded-full border-2 border-blue-400/50 bg-blue-500/20 backdrop-blur-sm flex items-center justify-center text-white font-bold;
        }
        
        /* Alert styles */
        .alert-banner {
            @apply bg-gradient-to-r from-red-600 to-orange-500 text-white p-4 rounded-lg mb-6 animate-pulse shadow-lg;
        }
        
        /* Progress bar */
        .progress-bar {
            @apply h-2 bg-white/10 rounded-full overflow-hidden;
        }
        
        .progress-fill {
            @apply h-full bg-gradient-to-r from-green-500 to-blue-500 transition-all duration-500;
        }
        
        /* Additional fixes for better visibility */
        .text-visible {
            @apply text-gray-200;
        }
        
        h1, h2, h3, h4, h5, h6 {
            @apply text-gray-100;
        }
    </style>
</head>
<body class="text-white">
    <!-- Copy the SAME navbar from rescue-team.blade.php -->
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
                
                <a href="{{ url('/rescue-team') }}" class="transition hover:text-yellow-300">DASHBOARD</a>
                <a href="{{ route('rescue.reports') }}" class="transition hover:text-yellow-300 text-yellow-300">ANIMAL REPORTS</a>
                <a href="{{ route('rescue.animals') }}" class="transition hover:text-yellow-300">ANIMALS</a>
                <a href="{{ route('rescue.adoptions') }}" class="transition hover:text-yellow-300">ADOPTIONS</a>

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
                <a href="{{ url('/') }}" class="block py-2">Home</a>
                <a href="{{ route('rescue.dashboard') }}" class="block py-2">Dashboard</a>
                <a href="{{ route('rescue.reports') }}" class="block py-2 text-yellow-300">Animal Reports</a>
                <a href="{{ route('rescue.assignments') }}" class="block py-2">My Assignments</a>
                <a href="{{ route('rescue.animals') }}" class="block py-2">Animals</a>
                <a href="{{ route('rescue.adoptions') }}" class="block py-2">Adoptions</a>
                <a href="#logout" class="block py-2 text-red-400">Logout</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-5 py-8">
        <!-- SRI LANKA FLOOD EMERGENCY BANNER -->
        <div class="alert-banner mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.886-.833-2.656 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    <div>
                        <h2 class="text-xl font-bold">🚨 SRI LANKA FLOOD EMERGENCY 🚨</h2>
                        <p class="text-sm opacity-90">Veterinary Association on standby to provide assistance for animals affected by floods</p>
                    </div>
                </div>
                <button class="emergency-btn" onclick="launchEmergencyResponse()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    EMERGENCY RESPONSE
                </button>
            </div>
        </div>

        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white">Animal Reports Management</h1>
            <p class="text-gray-300 mt-2">Manage all incoming animal reports, assign to team members, and track progress.</p>
        </div>

        <!-- Flood Emergency Dashboard -->
        <div class="emergency-card mb-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4 4 0 003 15z"/>
                    </svg>
                    FLOOD EMERGENCY RESPONSE
                </h2>
                <div class="flex gap-2">
                    <button class="warning-btn" onclick="coordinateVets()">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Coordinate Vets
                    </button>
                    <button class="danger-btn" onclick="dispatchEmergencyTeam()">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Dispatch Teams
                    </button>
                </div>
            </div>
            
            <!-- Flood Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <div class="bg-blue-900/30 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-blue-300">47</div>
                    <div class="text-sm text-gray-300">Flood-Affected Reports</div>
                </div>
                <div class="bg-red-900/30 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-red-300">18</div>
                    <div class="text-sm text-gray-300">Critical Cases</div>
                </div>
                <div class="bg-green-900/30 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-green-300">12</div>
                    <div class="text-sm text-gray-300">Animals Rescued</div>
                </div>
                <div class="bg-purple-900/30 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-purple-300">8</div>
                    <div class="text-sm text-gray-300">Vets Deployed</div>
                </div>
            </div>
            
            <!-- Affected Districts -->
            <div class="mb-4">
                <h3 class="font-bold mb-2 text-blue-300">Most Affected Districts:</h3>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-sm">Colombo</span>
                    <span class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-sm">Gampaha</span>
                    <span class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-sm">Kalutara</span>
                    <span class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-sm">Ratnapura</span>
                    <span class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-sm">Kegalle</span>
                </div>
            </div>
            
            <!-- Progress -->
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="text-gray-300">Rescue Progress</span>
                    <span class="text-gray-300">25%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 25%"></div>
                </div>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="card mb-6">
            <h2 class="text-xl font-bold mb-4">Filter Reports</h2>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <!-- Emergency Filter -->
                <div>
                    <label class="filter-label">Emergency Type</label>
                    <select class="filter-select" id="emergencyFilter">
                        <option value="" class="text-white bg-[#071331]">All Reports</option>
                        <option value="flood" class="text-white bg-[#071331]">Flood Emergency</option>
                        <option value="critical" class="text-white bg-[#071331]">Critical Only</option>
                        <option value="veterinary" class="text-white bg-[#071331]">Vet Required</option>
                    </select>
                </div>
                
                <!-- Status Filter -->
                <div>
                    <label class="filter-label">Status</label>
                    <select class="filter-select">
                        <option value="" class="text-white bg-[#071331]">All Status</option>
                        <option value="pending" class="text-white bg-[#071331]">Pending</option>
                        <option value="assigned" class="text-white bg-[#071331]">Assigned</option>
                        <option value="in_progress" class="text-white bg-[#071331]">In Progress</option>
                        <option value="resolved" class="text-white bg-[#071331]">Resolved</option>
                        <option value="urgent" class="text-white bg-[#071331]">Urgent</option>
                    </select>
                </div>
                
                <!-- Animal Type Filter -->
                <div>
                    <label class="filter-label">Animal Type</label>
                    <select class="filter-select">
                        <option value="" class="text-white bg-[#071331]">All Types</option>
                        <option value="dog" class="text-white bg-[#071331]">Dog</option>
                        <option value="cat" class="text-white bg-[#071331]">Cat</option>
                        <option value="livestock" class="text-white bg-[#071331]">Livestock</option>
                        <option value="other" class="text-white bg-[#071331]">Other</option>
                    </select>
                </div>
                
                <!-- Priority Filter -->
                <div>
                    <label class="filter-label">Priority</label>
                    <select class="filter-select">
                        <option value="" class="text-white bg-[#071331]">All Priorities</option>
                        <option value="high" class="text-white bg-[#071331]">High</option>
                        <option value="medium" class="text-white bg-[#071331]">Medium</option>
                        <option value="low" class="text-white bg-[#071331]">Low</option>
                    </select>
                </div>
                
                <!-- Date Filter -->
                <div>
                    <label class="filter-label">Reported Date</label>
                    <input type="date" class="filter-input">
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex gap-3 mt-4">
                <button class="primary-btn" onclick="applyFilters()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Apply Filters
                </button>
                <button class="outline-btn" onclick="clearFilters()">Clear Filters</button>
                <button class="success-btn" onclick="exportReports()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export Reports
                </button>
                <button class="emergency-btn" onclick="reportFloodEmergency()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.886-.833-2.656 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    Report Flood Emergency
                </button>
            </div>
        </div>

        <!-- Reports Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-6">
            <div class="filter-card">
                <div class="text-2xl font-bold text-white">24</div>
                <div class="text-sm text-gray-300">Pending Reports</div>
            </div>
            <div class="filter-card">
                <div class="text-2xl font-bold text-white">18</div>
                <div class="text-sm text-gray-300">Assigned</div>
            </div>
            <div class="filter-card">
                <div class="text-2xl font-bold text-white">6</div>
                <div class="text-sm text-gray-300">Urgent</div>
            </div>
            <div class="filter-card bg-gradient-to-r from-blue-900/30 to-cyan-900/30">
                <div class="text-2xl font-bold text-blue-300">47</div>
                <div class="text-sm text-blue-200">Flood Reports</div>
            </div>
            <div class="filter-card">
                <div class="text-2xl font-bold text-white">42</div>
                <div class="text-sm text-gray-300">Total Today</div>
            </div>
        </div>

        <!-- Reports Table -->
        <div class="card">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-white">All Incoming Reports</h2>
                <div class="flex gap-2">
                    <button class="primary-btn text-sm" onclick="createNewReport()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        New Report
                    </button>
                    <button class="outline-btn text-sm" onclick="refreshReports()">Refresh</button>
                    <button class="warning-btn text-sm" onclick="viewVetCoordination()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Vet Coordination
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
                            <th>Report ID</th>
                            <th>Animal</th>
                            <th>Condition</th>
                            <th>Location</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Reported</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- FLOOD EMERGENCY REPORT 1 -->
                        <tr class="emergency-row">
                            <td><input type="checkbox" class="rounded"></td>
                            <td class="font-medium">#SL-FLOOD-001</td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                        </svg>
                                    </div>
                                    <span>Dog (Multiple)</span>
                                </div>
                            </td>
                            <td>Trapped in floodwaters, urgent rescue needed</td>
                            <td>Colombo - Flood Zone A</td>
                            <td><span class="px-2 py-1 text-xs font-bold text-white bg-red-500 rounded-full animate-pulse">FLOOD EMERGENCY</span></td>
                            <td><span class="status-badge status-emergency">Flood Emergency</span></td>
                            <td>15 min ago</td>
                            <td>
                                <div class="flex gap-2">
                                    <button class="text-xs emergency-btn px-3 py-1" onclick="dispatchToFlood('SL-FLOOD-001')">
                                        Rescue Now
                                    </button>
                                    <button class="text-xs outline-btn px-3 py-1" onclick="viewFloodDetails('SL-FLOOD-001')">
                                        <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4 4 0 003 15z"/>
                                        </svg>
                                        Flood Info
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- FLOOD EMERGENCY REPORT 2 -->
                        <tr class="flood-row">
                            <td><input type="checkbox" class="rounded"></td>
                            <td class="font-medium">#SL-FLOOD-002</td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-pink-500/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4z"/>
                                        </svg>
                                    </div>
                                    <span>Cats (Colony)</span>
                                </div>
                            </td>
                            <td>Colony stranded on rooftop, water rising</td>
                            <td>Gampaha - Flood Zone B</td>
                            <td><span class="px-2 py-1 text-xs font-bold text-white bg-red-500 rounded-full">HIGH</span></td>
                            <td><span class="status-badge status-flood">Flood Rescue</span></td>
                            <td>30 min ago</td>
                            <td>
                                <div class="flex gap-2">
                                    <button class="text-xs primary-btn px-3 py-1" onclick="assignVeterinary('SL-FLOOD-002')">
                                        <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Vet Required
                                    </button>
                                    <button class="text-xs outline-btn px-3 py-1" onclick="viewReport('SL-FLOOD-002')">View</button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Report 1 -->
                        <tr>
                            <td><input type="checkbox" class="rounded"></td>
                            <td class="font-medium">#SP-2048</td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 a3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                        </svg>
                                    </div>
                                    <span>Dog</span>
                                </div>
                            </td>
                            <td>Injured leg</td>
                            <td>Central Park</td>
                            <td><span class="px-2 py-1 text-xs font-bold text-white bg-red-500 rounded-full">HIGH</span></td>
                            <td><span class="status-badge status-urgent">Urgent</span></td>
                            <td>10 min ago</td>
                            <td>
                                <div class="flex gap-2">
                                    <button class="text-xs primary-btn px-3 py-1" onclick="assignReport('SP-2048')">Assign</button>
                                    <button class="text-xs outline-btn px-3 py-1" onclick="viewReport('SP-2048')">View</button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Report 2 -->
                        <tr>
                            <td><input type="checkbox" class="rounded"></td>
                            <td class="font-medium">#SP-2047</td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-pink-500/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4z"/>
                                        </svg>
                                    </div>
                                    <span>Cat</span>
                                </div>
                            </td>
                            <td>Stray, hungry</td>
                            <td>Downtown Mall</td>
                            <td><span class="px-2 py-1 text-xs font-bold text-white bg-yellow-500 rounded-full">MEDIUM</span></td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>25 min ago</td>
                            <td>
                                <div class="flex gap-2">
                                    <button class="text-xs primary-btn px-3 py-1" onclick="assignReport('SP-2047')">Assign</button>
                                    <button class="text-xs outline-btn px-3 py-1" onclick="viewReport('SP-2047')">View</button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- VETERINARY ASSISTANCE REQUIRED -->
                        <tr class="flood-row">
                            <td><input type="checkbox" class="rounded"></td>
                            <td class="font-medium">#SL-VET-003</td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-yellow-500/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                        </svg>
                                    </div>
                                    <span>Livestock (Cattle)</span>
                                </div>
                            </td>
                            <td>Drowning risk, need veterinary assessment</td>
                            <td>Kalutara - Flood Zone C</td>
                            <td><span class="px-2 py-1 text-xs font-bold text-white bg-red-500 rounded-full">HIGH</span></td>
                            <td><span class="status-badge status-flood">Vet Required</span></td>
                            <td>45 min ago</td>
                            <td>
                                <div class="flex gap-2">
                                    <button class="text-xs success-btn px-3 py-1" onclick="assignVeterinary('SL-VET-003')">
                                        Assign Vet
                                    </button>
                                    <button class="text-xs warning-btn px-3 py-1" onclick="coordinateRescue('SL-VET-003')">
                                        Rescue Plan
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
                    <button class="outline-btn text-sm" onclick="deleteSelected()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete Selected
                    </button>
                    <button class="emergency-btn text-sm" onclick="bulkFloodResponse()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Flood Response
                    </button>
                </div>
                
                <div class="flex items-center gap-2">
                    <button class="px-3 py-1 rounded bg-white/10 hover:bg-white/20 text-white">1</button>
                    <button class="px-3 py-1 rounded hover:bg-white/10 text-white">2</button>
                    <button class="px-3 py-1 rounded hover:bg-white/10 text-white">3</button>
                    <span class="text-gray-400">...</span>
                    <button class="px-3 py-1 rounded hover:bg-white/10 text-white">Next →</button>
                </div>
            </div>
        </div>
        
        <!-- Veterinary Coordination Section -->
        <div class="card mt-6">
            <h2 class="text-xl font-bold mb-4 text-white">Veterinary Association Coordination</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-green-900/20 p-4 rounded-lg">
                    <h3 class="font-bold text-green-300 mb-2">Available Veterinarians</h3>
                    <div class="text-2xl font-bold text-white">24</div>
                    <p class="text-sm text-gray-300">On standby for flood response</p>
                    <button class="text-xs success-btn mt-2 w-full" onclick="deployVets()">Deploy to Flood Zones</button>
                </div>
                
                <div class="bg-blue-900/20 p-4 rounded-lg">
                    <h3 class="font-bold text-blue-300 mb-2">Emergency Supplies</h3>
                    <div class="text-2xl font-bold text-white">✓ Ready</div>
                    <p class="text-sm text-gray-300">Medical kits, boats, rescue equipment</p>
                    <button class="text-xs primary-btn mt-2 w-full" onclick="manageSupplies()">Manage Inventory</button>
                </div>
                
                <div class="bg-purple-900/20 p-4 rounded-lg">
                    <h3 class="font-bold text-purple-300 mb-2">Coordination Center</h3>
                    <div class="text-2xl font-bold text-white">Active</div>
                    <p class="text-sm text-gray-300">24/7 emergency hotline: 011-234-5678</p>
                    <button class="text-xs outline-btn mt-2 w-full" onclick="openCoordinationCenter()">Open Center</button>
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
        // FLOOD EMERGENCY FUNCTIONS
        // ====================
        
        function launchEmergencyResponse() {
            alert("🚨 LAUNCHING SRI LANKA FLOOD EMERGENCY RESPONSE 🚨\n\nEmergency actions initiated:\n1. Activating all rescue teams\n2. Contacting Veterinary Association\n3. Deploying emergency supplies\n4. Opening coordination centers\n5. Alerting government authorities");
            
            // Show emergency modal
            showEmergencyModal();
        }
        
        function reportFloodEmergency() {
            const location = prompt("Enter flood-affected location in Sri Lanka:");
            const animalCount = prompt("Approximate number of animals affected:");
            const urgency = prompt("Urgency level (Critical/High/Medium):");
            
            if (location && animalCount && urgency) {
                alert(`✅ Flood Emergency Reported!\n\nLocation: ${location}\nAnimals Affected: ${animalCount}\nUrgency: ${urgency}\n\nEmergency response team has been notified. Veterinary Association alerted.`);
            }
        }
        
        function coordinateVets() {
            alert("📞 Coordinating with Sri Lanka Veterinary Association...\n\nActions:\n1. Alerting all available veterinarians\n2. Dispatching emergency medical kits\n3. Setting up field clinics in flood zones\n4. Coordinating with government disaster management");
        }
        
        function dispatchEmergencyTeam() {
            const teamSize = prompt("Enter number of rescue team members to dispatch:");
            const equipment = prompt("Required equipment (Boats/Medical/Rescue):");
            
            if (teamSize && equipment) {
                alert(`🚤 Emergency Team Dispatched!\n\nTeam Size: ${teamSize} members\nEquipment: ${equipment}\nStatus: En route to flood zones\nETA: 15-30 minutes\n\nVeterinary support coordinated.`);
            }
        }
        
        function assignVeterinary(reportId) {
            alert(`🩺 Veterinary Assistance Requested!\n\nReport: ${reportId}\n\nVeterinary Association notified.\nEmergency vet team dispatched.\nMedical supplies en route.`);
        }
        
        function dispatchToFlood(reportId) {
            alert(`🚁 IMMEDIATE FLOOD RESCUE DEPLOYED!\n\nReport: ${reportId}\n\nRescue team with boats dispatched.\nVeterinary team on standby.\nCoordination with Disaster Management Center.`);
        }
        
        function viewFloodDetails(reportId) {
            alert(`🌊 FLOOD SITUATION DETAILS:\n\nReport: ${reportId}\nLocation: Colombo Flood Zone A\nWater Level: 1.5m rising\nAnimals: Multiple dogs trapped\nRescue Status: Boats required\nVet Support: On standby\n\nEmergency Hotline: 011-234-5678`);
        }
        
        function coordinateRescue(reportId) {
            alert(`🔄 COORDINATING RESCUE PLAN:\n\nReport: ${reportId}\n\n1. Assess water levels\n2. Deploy rescue boats\n3. Veterinary assessment on-site\n4. Temporary shelter setup\n5. Medical treatment if needed\n\nVeterinary Association notified.`);
        }
        
        function deployVets() {
            const zone = prompt("Which flood zone to deploy veterinarians? (A/B/C/All):");
            if (zone) {
                alert(`👨‍⚕️ VETERINARIANS DEPLOYED!\n\nZone: ${zone}\nVets: 8 veterinarians\nMedical Kits: 15 emergency kits\nTransport: 4 rescue vehicles\n\nCoordination with Sri Lanka Veterinary Association complete.`);
            }
        }
        
        function bulkFloodResponse() {
            alert(`🌊 BULK FLOOD RESPONSE INITIATED!\n\nSelected all flood emergency reports.\n\nActions:\n1. Mass alert to rescue teams\n2. Veterinary Association emergency meeting\n3. Government disaster management coordination\n4. Emergency supplies distribution\n5. Public alert system activated`);
        }
        
        function viewVetCoordination() {
            alert(`🏥 VETERINARY COORDINATION CENTER\n\nSri Lanka Veterinary Association:\n• 24/7 Emergency Hotline: 011-234-5678\n• Available Vets: 24\n• Field Clinics: 6 established\n• Medical Supplies: Fully stocked\n• Rescue Equipment: Boats, cages, medical kits\n\nCoordination with:\n• Disaster Management Center\n• Local Government\n• Army/Navy rescue teams`);
        }
        
        function showEmergencyModal() {
            // In a real app, this would show a modal
            const modalContent = `
                <div class="fixed inset-0 bg-black/75 flex items-center justify-center z-50 p-4">
                    <div class="bg-gradient-to-br from-red-900 to-blue-900 rounded-xl p-6 max-w-2xl w-full">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-bold text-white">🚨 SRI LANKA FLOOD EMERGENCY 🚨</h2>
                            <button onclick="closeModal()" class="text-white hover:text-gray-300">✕</button>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="bg-white/10 p-4 rounded-lg">
                                <h3 class="font-bold text-yellow-300 mb-2">Veterinary Association Alert</h3>
                                <p>The Sri Lanka Veterinary Association is on standby with 24 veterinarians ready to assist flood-affected animals.</p>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <button class="emergency-btn w-full" onclick="dispatchEmergencyTeam()">
                                    Dispatch Rescue Teams
                                </button>
                                <button class="warning-btn w-full" onclick="coordinateVets()">
                                    Coordinate Vets
                                </button>
                            </div>
                            
                            <div class="text-sm text-gray-300">
                                <p><strong>Emergency Contacts:</strong></p>
                                <p>• Veterinary Association: 011-234-5678</p>
                                <p>• Disaster Management: 117</p>
                                <p>• Police Emergency: 119</p>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            const modal = document.createElement('div');
            modal.innerHTML = modalContent;
            document.body.appendChild(modal);
        }
        
        function closeModal() {
            const modal = document.querySelector('.fixed.inset-0.bg-black');
            if (modal) modal.remove();
        }

        // ====================
        // EXISTING FUNCTIONS
        // ====================
        
        function applyFilters() {
            alert("Filters applied to reports.");
        }
        
        function clearFilters() {
            alert("All filters cleared.");
        }
        
        function exportReports() {
            alert("Exporting reports data...");
        }
        
        function createNewReport() {
            alert("Opening new report form...");
        }
        
        function refreshReports() {
            alert("Refreshing reports data...");
        }
        
        function assignReport(reportId) {
            alert(`Assigning report ${reportId} to team member...`);
        }
        
        function viewReport(reportId) {
            alert(`Viewing details for report ${reportId}...`);
        }
        
        function bulkAssign() {
            alert("Bulk assigning selected reports...");
        }
        
        function deleteSelected() {
            alert("Deleting selected reports...");
        }
        
        function manageSupplies() {
            alert("Opening emergency supplies inventory...");
        }
        
        function openCoordinationCenter() {
            alert("Opening emergency coordination center interface...");
        }

        // Demo functionality for buttons
        document.querySelectorAll('button').forEach(btn => {
            if (!btn.onclick) {
                btn.addEventListener('click', function(e) {
                    if (this.textContent.includes('Assign') || 
                        this.textContent.includes('View') || 
                        this.textContent.includes('Update')) {
                        e.preventDefault();
                        const action = this.textContent.trim();
                        alert(`[Demo] ${action} - This would trigger backend action in production.`);
                    }
                });
            }
        });
    </script>
</body>
</html>