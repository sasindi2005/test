<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafePaws — Rescue Team Dashboard</title>
    
    <!-- Laravel Vite directive for CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style type="text/tailwindcss">
        /* Animations */
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

        /* Card styles */
        .card {
            @apply bg-white/5 p-6 md:p-8 rounded-xl shadow-md border border-white/10;
        }

        /* Status badges */
        .status-badge {
            @apply px-3 py-1 text-xs font-semibold rounded-full;
        }
        .status-pending { @apply bg-yellow-500/20 text-yellow-300; }
        .status-assigned { @apply bg-blue-500/20 text-blue-300; }
        .status-in-progress { @apply bg-purple-500/20 text-purple-300; }
        .status-rescued { @apply bg-green-500/20 text-green-300; }
        .status-in-treatment { @apply bg-indigo-500/20 text-indigo-300; }
        .status-ready-for-adoption { @apply bg-emerald-500/20 text-emerald-300; }

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

        /* Stats cards */
        .stats-grid {
            @apply grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6;
        }
        
        .stats-card {
            @apply bg-gradient-to-br from-white/10 to-transparent p-6 rounded-xl border border-white/10;
        }
        
        .stats-value {
            @apply text-3xl font-bold text-white mb-2;
        }
        
        .stats-label {
            @apply text-gray-300 text-sm;
        }
    </style>
</head>
<body class="text-white">
    <!-- Navbar -->
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
    
                <a href="{{ url('/rescue-team') }}" class="transition hover:text-yellow-300 text-yellow-300">DASHBOARD</a>
                <a href="{{ route('rescue.reports') }}" class="transition hover:text-yellow-300">ANIMAL REPORTS</a>
                <a href="{{ route('rescue.animals') }}" class="transition hover:text-yellow-300">ANIMALS</a>
                <a href="{{ route('rescue.adoptions') }}" class="transition hover:text-yellow-300">ADOPTIONS</a>
            </nav>

            <!-- Mobile menu button -->
            <button class="md:hidden" id="mobileMenuBtn">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile menu -->
        <div class="md:hidden hidden" id="mobileMenu">
            <div class="px-5 py-4 space-y-4 bg-[#0b2447]">
                <a href="{{ url('/') }}" class="block transition hover:text-yellow-300">HOME</a>
                <a href="{{ route('rescue.dashboard') }}" class="block transition hover:text-yellow-300 text-yellow-300">DASHBOARD</a>
                <a href="{{ route('rescue.reports') }}" class="block transition hover:text-yellow-300">ANIMAL REPORTS</a>
                <a href="{{ route('rescue.animals') }}" class="block transition hover:text-yellow-300">ANIMALS</a>
                <a href="{{ route('rescue.adoptions') }}" class="block transition hover:text-yellow-300">ADOPTIONS</a>
            </div>
        </div>
    </header>

    <!-- Main Dashboard Content -->
    <main class="max-w-7xl mx-auto px-5 py-8">
        <!-- Dashboard Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white">Rescue Team Dashboard</h1>
            <p class="text-gray-300 mt-2">Welcome back, Rescue Team Alpha. Manage your rescue operations and assignments.</p>
        </div>

        <!-- Stats Overview -->
        <div class="stats-grid mb-8">
            <div class="stats-card">
                <div class="stats-value">8</div>
                <div class="stats-label">Assigned to You</div>
                <div class="mt-2 text-xs text-gray-400">Active rescue missions</div>
            </div>
            
            <div class="stats-card">
                <div class="stats-value">12</div>
                <div class="stats-label">Completed Today</div>
                <div class="mt-2 text-xs text-gray-400">Successful rescues</div>
            </div>
            
            <div class="stats-card">
                <div class="stats-value">3</div>
                <div class="stats-label">Urgent Cases</div>
                <div class="mt-2 text-xs text-gray-400">Require immediate attention</div>
            </div>
            
            <div class="stats-card">
                <div class="stats-value">15</div>
                <div class="stats-label">Animals in Shelter</div>
                <div class="mt-2 text-xs text-gray-400">Under your care</div>
            </div>
        </div>

        <!-- Rescue Team Quick Actions -->
        <div class="mb-8">
            <h2 class="text-xl font-bold mb-4 text-white">Quick Actions</h2>
            <div class="flex flex-wrap gap-4">
                <button class="primary-btn">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Accept New Assignment
                </button>
                <button class="outline-btn">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Update Rescue Status
                </button>
                <button class="success-btn">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Mark Rescue Complete
                </button>
                <button class="warning-btn">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Report Issue
                </button>
            </div>
        </div>

        <!-- My Active Assignments -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-white">My Active Assignments</h2>
                <button class="text-sm text-[#0ea5e9] hover:text-[#0891b2]">View All →</button>
            </div>
            
            <div class="table-container">
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>Report ID</th>
                            <th>Animal</th>
                            <th>Condition</th>
                            <th>Location</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Assignment 1 -->
                        <tr>
                            <td class="font-medium">#SP-2047</td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                        </svg>
                                    </div>
                                    <span>Dog (Sick)</span>
                                </div>
                            </td>
                            <td>Severe infection</td>
                            <td>Central Park</td>
                            <td><span class="px-2 py-1 text-xs font-bold text-white bg-red-500 rounded-full">HIGH</span></td>
                            <td><span class="status-badge status-in-progress">En Route</span></td>
                            <td>
                                <div class="flex gap-2">
                                    <button class="text-xs primary-btn px-3 py-1">Update Location</button>
                                    <button class="text-xs success-btn px-3 py-1">Arrived</button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Assignment 2 -->
                        <tr>
                            <td class="font-medium">#SP-2046</td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-pink-500/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4z"/>
                                        </svg>
                                    </div>
                                    <span>Cat (Aggressive)</span>
                                </div>
                            </td>
                            <td>Cornered, scared</td>
                            <td>Downtown Area</td>
                            <td><span class="px-2 py-1 text-xs font-bold text-white bg-yellow-500 rounded-full">MEDIUM</span></td>
                            <td><span class="status-badge status-assigned">Assigned</span></td>
                            <td>
                                <div class="flex gap-2">
                                    <button class="text-xs primary-btn px-3 py-1">Start Rescue</button>
                                    <button class="text-xs outline-btn px-3 py-1">Need Assistance</button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Assignment 3 -->
                        <tr>
                            <td class="font-medium">#SP-2045</td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                        </svg>
                                    </div>
                                    <span>Dog (Injured)</span>
                                </div>
                            </td>
                            <td>Leg injury</td>
                            <td>River Street</td>
                            <td><span class="px-2 py-1 text-xs font-bold text-white bg-green-500 rounded-full">LOW</span></td>
                            <td><span class="status-badge status-rescued">At Shelter</span></td>
                            <td>
                                <div class="flex gap-2">
                                    <button class="text-xs primary-btn px-3 py-1">Add Medical Notes</button>
                                    <button class="text-xs success-btn px-3 py-1">Mark Treated</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Animals Under Your Care -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-white">Animals Under Your Care</h2>
                <button class="text-sm text-[#0ea5e9] hover:text-[#0891b2]">View All →</button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Animal 1 -->
                <div class="card">
                    <img src="{{ asset('Buddy.jpg') }}" alt="Buddy"
                    class="w-full h-48 object-cover rounded-lg mb-4">

                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-lg">Buddy</h3>
                            <p class="text-gray-300 text-sm">Dog • Report #SP-2043</p>
                        </div>
                        <span class="status-badge status-in-treatment">In Treatment</span>
                    </div>
                    <p class="text-sm text-gray-300 mt-2">Rescued 2 days ago. Under medication for infection.</p>
                    <div class="mt-4 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Treatment:</span>
                            <span class="text-white">Antibiotics</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Next Check:</span>
                            <span class="text-white">Tomorrow</span>
                        </div>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <button class="primary-btn flex-1 text-center justify-center">Update Health</button>
                        <button class="outline-btn">Notes</button>
                    </div>
                </div>
                
                <!-- Animal 2 -->
                <div class="card">
                    <img src="{{ asset('Mittens.jpg') }}" 
 
                         alt="Mittens - Cat" 
                         class="w-full h-48 object-cover rounded-lg mb-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-lg">Mittens</h3>
                            <p class="text-gray-300 text-sm">Cat • Report #SP-2042</p>
                        </div>
                        <span class="status-badge status-ready-for-adoption">Ready for Adoption</span>
                    </div>
                    <p class="text-sm text-gray-300 mt-2">Calm and healthy. Completed all vaccinations.</p>
                    <div class="mt-4 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Vaccinations:</span>
                            <span class="text-white">Complete</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Adoption Requests:</span>
                            <span class="text-white">3</span>
                        </div>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <button class="success-btn flex-1 text-center justify-center">Review Requests</button>
                        <button class="outline-btn">Profile</button>
                    </div>
                </div>
                
                <!-- Animal 3 -->
                <div class="card">
                    <img src="{{ asset('Rocky.jpg') }}" 
 
                         alt="Rocky - Dog" 
                         class="w-full h-48 object-cover rounded-lg mb-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-lg">Rocky</h3>
                            <p class="text-gray-300 text-sm">Dog • Report #SP-2041</p>
                        </div>
                        <span class="status-badge status-in-treatment">Post-Op Care</span>
                    </div>
                    <p class="text-sm text-gray-300 mt-2">Recovering from surgery. Needs daily dressing change.</p>
                    <div class="mt-4 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Surgery:</span>
                            <span class="text-white">Leg operation</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Recovery Time:</span>
                            <span class="text-white">2 weeks</span>
                        </div>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <button class="warning-btn flex-1 text-center justify-center">Update Recovery</button>
                        <button class="outline-btn">Medical Log</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rescue Process Tracking -->
        <div class="mb-8 card">
            <h2 class="text-xl font-bold mb-6 text-white">Rescue Process Status Updates</h2>
            <div class="space-y-6">
                <!-- Process 1 -->
                <div class="p-4 bg-white/5 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <div class="font-medium">Report #SP-2047 - Dog Rescue</div>
                        <span class="text-sm text-gray-400">Last updated: 30 min ago</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex-1">
                            <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full bg-[#0ea5e9] rounded-full" style="width: 60%"></div>
                            </div>
                            <div class="flex justify-between mt-2 text-sm text-gray-300">
                                <span>Reported</span>
                                <span>Assigned</span>
                                <span>En Route</span>
                                <span>Rescued</span>
                                <span>At Shelter</span>
                            </div>
                        </div>
                        <button class="primary-btn text-sm px-3 py-1">Update Progress</button>
                    </div>
                </div>
                
                <!-- Process 2 -->
                <div class="p-4 bg-white/5 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <div class="font-medium">Report #SP-2046 - Cat Rescue</div>
                        <span class="text-sm text-gray-400">Last updated: 2 hours ago</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex-1">
                            <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full bg-[#0ea5e9] rounded-full" style="width: 20%"></div>
                            </div>
                            <div class="flex justify-between mt-2 text-sm text-gray-300">
                                <span>Reported</span>
                                <span>Assigned</span>
                                <span>En Route</span>
                                <span>Rescued</span>
                                <span>At Shelter</span>
                            </div>
                        </div>
                        <button class="outline-btn text-sm px-3 py-1">Start Rescue</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Reports Needing Assignment -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-white">New Reports Needing Assignment</h2>
                <button class="text-sm text-[#0ea5e9] hover:text-[#0891b2]">View All →</button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- New Report 1 -->
                <div class="card">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="font-bold">Stray Dogs Group</h3>
                            <p class="text-sm text-gray-300 mt-1">Location: Industrial Area</p>
                            <p class="text-sm text-gray-400 mt-2">Reported: 1 hour ago • 3 dogs, appears healthy but need shelter</p>
                        </div>
                        <span class="status-badge status-pending">Pending</span>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <button class="primary-btn flex-1">Accept Assignment</button>
                        <button class="outline-btn">View Details</button>
                    </div>
                </div>
                
                <!-- New Report 2 -->
                <div class="card">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="font-bold">Injured Puppy</h3>
                            <p class="text-sm text-gray-300 mt-1">Location: City Park</p>
                            <p class="text-sm text-gray-400 mt-2">Reported: 45 min ago • Limping, seems to have leg injury</p>
                        </div>
                        <span class="status-badge status-pending">Pending</span>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <button class="primary-btn flex-1">Accept Assignment</button>
                        <button class="outline-btn">View Details</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="gray-border">
        <div class="max-w-[1000px] mx-auto px-5 py-12 text-gray-300">
            <div class="flex flex-col items-start justify-between gap-6 md:flex-row">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <svg width="34" height="34" viewBox="0 0 64 64" fill="none">
                            <rect width="64" height="64" rx="12" fill="#0ea5e9"></rect>
                            <path d="M34.5 36c4-1 8.5 0 11 3 2.5 3 1.8 7.4-0.6 10.7C43.9 53 39.6 54 34.5 54c-5 0-9.7-1-12.6-3.8C17.2 47.4 16.4 43 18.9 40c2.7-3.2 6.9-4.2 11.6-4z" fill="#fff"></path>
                        </svg>
                        <div>
                            <div class="font-semibold">SafePaws Rescue Team</div>
                            <div class="text-xs text-gray-400">Protecting Every Paw</div>
                        </div>
                    </div>
                    <p class="max-w-sm text-sm text-gray-400">
                        Dedicated to rescuing and caring for stray animals in our community.
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-6 mt-4 text-sm md:mt-0">
                    <div>
                        <div class="mb-2 font-medium text-white">Quick Links</div>
                        <div class="text-gray-400">My Assignments</div>
                        <div class="text-gray-400">Rescue Reports</div>
                        <div class="text-gray-400">Animal Care</div>
                    </div>

                    <div>
                        <div class="mb-2 font-medium text-white">Support</div>
                        <div class="text-gray-400">Emergency Contact</div>
                        <div class="text-gray-400">Equipment Request</div>
                        <div class="text-gray-400">Team Resources</div>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-xs text-gray-500">
                © <span id="year"></span> SafePaws Rescue Team. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
       // ADD THIS CODE - Hash-based navigation for SPA
function navigateTo(section) {
    console.log('Navigating to:', section);
    
    // Update URL hash without page reload
    window.location.hash = section;
    
    // Show the corresponding section
    showSection(section);
}

function showSection(section) {
    console.log('Showing section:', section);
    
    // Hide all sections first (you'll need to add sections to your HTML)
    document.querySelectorAll('.dashboard-section').forEach(div => {
        div.style.display = 'none';
    });
    
    // Show the selected section
    const target = document.getElementById(section + '-section');
    if (target) {
        target.style.display = 'block';
    }
}

// Handle initial load
document.addEventListener('DOMContentLoaded', function() {
    // Check if there's a hash in the URL
    const hash = window.location.hash.substring(1);
    if (hash) {
        navigateTo(hash);
    }
});

// Handle hash changes
window.addEventListener('hashchange', function() {
    const hash = window.location.hash.substring(1);
    if (hash) {
        showSection(hash);
    }
});
    </script>
    
</body>
</html>