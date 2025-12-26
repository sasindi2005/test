<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafePaws — Animal Management</title>
    
    <!-- Laravel Vite directive -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Tailwind CSS as backup -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style type="text/tailwindcss">
        /* Reuse same styles from reports page */
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
        .status-available { @apply bg-green-500/20 text-green-300; }
        .status-adopted { @apply bg-blue-500/20 text-blue-300; }
        .status-medical { @apply bg-purple-500/20 text-purple-300; }
        .status-quarantine { @apply bg-yellow-500/20 text-yellow-300; }
        .status-pending { @apply bg-yellow-500/20 text-yellow-300; }
        .status-urgent { @apply bg-red-500/20 text-red-300; }

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

        /* Animal card styles */
        .animal-card {
            @apply bg-white/5 rounded-xl border border-white/10 overflow-hidden transition-all duration-300 hover:bg-white/10 hover:border-[#0ea5e9]/50;
        }

        .animal-image {
            @apply w-full h-48 bg-gray-800 object-cover;
        }

        .animal-id {
            @apply text-xs text-gray-400 font-mono;
        }

        .animal-type-icon {
            @apply w-10 h-10 rounded-full flex items-center justify-center;
        }

        .dog-icon { @apply bg-blue-500/20 text-blue-300; }
        .cat-icon { @apply bg-pink-500/20 text-pink-300; }
        .rabbit-icon { @apply bg-purple-500/20 text-purple-300; }
        .other-icon { @apply bg-gray-500/20 text-gray-300; }
        
        /* Additional fixes for better visibility */
        h1, h2, h3, h4, h5, h6 {
            @apply text-gray-100;
        }
        
        p, span, div {
            @apply text-gray-200;
        }
    </style>
</head>
<body class="text-white">
    <!-- Copy the SAME navbar from reports page -->
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
             
<a href="{{ route('rescue.dashboard') }}" class="transition hover:text-yellow-300">DASHBOARD</a>
<a href="{{ route('rescue.reports') }}" class="transition hover:text-yellow-300">ANIMAL REPORTS</a>
<a href="{{ route('rescue.animals') }}" class="transition hover:text-yellow-300 text-yellow-300">ANIMALS</a>
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
                <a href="{{ route('rescue.reports') }}" class="block py-2">Animal Reports</a>
                <a href="{{ route('rescue.animals') }}" class="block py-2 text-yellow-300">Animals</a>
                <a href="{{ route('rescue.adoptions') }}" class="block py-2">Adoptions</a>
                <a href="#logout" class="block py-2 text-red-400">Logout</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-5 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white">Animal Management</h1>
            <p class="text-gray-300 mt-2">Manage all animals in the shelter, track medical records, and process adoptions.</p>
        </div>

        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="filter-card">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-blue-500/20 rounded-lg">
                        <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-white">42</div>
                        <div class="text-sm text-gray-300">Total Animals</div>
                    </div>
                </div>
            </div>
            
            <div class="filter-card">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-green-500/20 rounded-lg">
                        <svg class="w-6 h-6 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-white">24</div>
                        <div class="text-sm text-gray-300">Available for Adoption</div>
                    </div>
                </div>
            </div>
            
            <div class="filter-card">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-purple-500/20 rounded-lg">
                        <svg class="w-6 h-6 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-white">8</div>
                        <div class="text-sm text-gray-300">Medical Care</div>
                    </div>
                </div>
            </div>
            
            <div class="filter-card">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-yellow-500/20 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-white">6</div>
                        <div class="text-sm text-gray-300">In Quarantine</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="card mb-6">
            <h2 class="text-xl font-bold mb-4">Filter Animals</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Animal Type Filter -->
                <div>
                    <label class="filter-label">Animal Type</label>
                    <select class="filter-select" id="animalTypeFilter">
                        <option value="" class="text-white bg-[#071331]">All Types</option>
                        <option value="dog" class="text-white bg-[#071331]">Dog</option>
                        <option value="cat" class="text-white bg-[#071331]">Cat</option>
                        <option value="rabbit" class="text-white bg-[#071331]">Rabbit</option>
                        <option value="other" class="text-white bg-[#071331]">Other</option>
                    </select>
                </div>
                
                <!-- Status Filter -->
                <div>
                    <label class="filter-label">Status</label>
                    <select class="filter-select" id="statusFilter">
                        <option value="" class="text-white bg-[#071331]">All Status</option>
                        <option value="available" class="text-white bg-[#071331]">Available</option>
                        <option value="adopted" class="text-white bg-[#071331]">Adopted</option>
                        <option value="medical" class="text-white bg-[#071331]">Medical Care</option>
                        <option value="quarantine" class="text-white bg-[#071331]">Quarantine</option>
                    </select>
                </div>
                
                <!-- Gender Filter -->
                <div>
                    <label class="filter-label">Gender</label>
                    <select class="filter-select" id="genderFilter">
                        <option value="" class="text-white bg-[#071331]">All Genders</option>
                        <option value="male" class="text-white bg-[#071331]">Male</option>
                        <option value="female" class="text-white bg-[#071331]">Female</option>
                    </select>
                </div>
                
                <!-- Age Filter -->
                <div>
                    <label class="filter-label">Age</label>
                    <select class="filter-select" id="ageFilter">
                        <option value="" class="text-white bg-[#071331]">All Ages</option>
                        <option value="puppy_kitten" class="text-white bg-[#071331]">Puppy/Kitten (0-1 yr)</option>
                        <option value="young" class="text-white bg-[#071331]">Young (1-3 yrs)</option>
                        <option value="adult" class="text-white bg-[#071331]">Adult (3-8 yrs)</option>
                        <option value="senior" class="text-white bg-[#071331]">Senior (8+ yrs)</option>
                    </select>
                </div>
            </div>
            
            <!-- Search Bar -->
            <div class="mt-4">
                <div class="relative">
                    <input 
                        type="text" 
                        id="animalSearch" 
                        placeholder="Search animals by name, ID, or breed..." 
                        class="filter-input pl-10"
                    >
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
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
                <button class="success-btn" onclick="exportAnimals()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export
                </button>
                <button class="primary-btn bg-green-500 hover:bg-green-600" onclick="addNewAnimal()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add New Animal
                </button>
            </div>
        </div>

        <!-- View Toggle -->
        <div class="flex items-center justify-between mb-4">
            <div class="flex gap-2">
                <button id="gridViewBtn" class="px-4 py-2 rounded bg-[#0ea5e9] text-white">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                    Grid View
                </button>
                <button id="tableViewBtn" class="px-4 py-2 rounded bg-white/10 hover:bg-white/20 text-white">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    Table View
                </button>
            </div>
            <div class="text-sm text-gray-400">
                Showing <span id="animalCount" class="text-white">8</span> animals
            </div>
        </div>

        <!-- Animals Grid View -->
        <div id="animalsGridView" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Animal Card 1 -->
            <div class="animal-card">
                <div class="relative">
                    <img 
                        src="https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                        alt="Max" 
                        class="animal-image"
                    >
                    <div class="absolute top-3 right-3">
                        <span class="status-badge status-available">Available</span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <h3 class="text-lg font-bold text-white">Max</h3>
                            <p class="text-sm text-gray-400">Golden Retriever • 2 years</p>
                        </div>
                        <div class="animal-type-icon dog-icon">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="animal-id mb-3">#SP-0012</div>
                    
                    <div class="grid grid-cols-2 gap-3 mb-4">
                        <div class="text-center p-2 bg-white/5 rounded">
                            <div class="text-xs text-gray-400">Gender</div>
                            <div class="font-medium text-white">Male</div>
                        </div>
                        <div class="text-center p-2 bg-white/5 rounded">
                            <div class="text-xs text-gray-400">Weight</div>
                            <div class="font-medium text-white">28 kg</div>
                        </div>
                    </div>
                    
                    <div class="flex gap-2">
                        <button class="flex-1 text-xs primary-btn px-3 py-2" onclick="viewAnimal('SP-0012')">
                            View Details
                        </button>
                        <button class="text-xs outline-btn px-3 py-2" onclick="editAnimal('SP-0012')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Animal Card 2 -->
            <div class="animal-card">
                <div class="relative">
                    <img src="{{ asset('Luna.jpg') }}" 

                        alt="Luna" 
                        class="animal-image"
                    >
                    <div class="absolute top-3 right-3">
                        <span class="status-badge status-adopted">Adopted</span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <h3 class="text-lg font-bold text-white">Luna</h3>
                            <p class="text-sm text-gray-400">Domestic Cat • 1.5 years</p>
                        </div>
                        <div class="animal-type-icon cat-icon">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="animal-id mb-3">#SP-0015</div>
                    
                    <div class="grid grid-cols-2 gap-3 mb-4">
                        <div class="text-center p-2 bg-white/5 rounded">
                            <div class="text-xs text-gray-400">Gender</div>
                            <div class="font-medium text-white">Female</div>
                        </div>
                        <div class="text-center p-2 bg-white/5 rounded">
                            <div class="text-xs text-gray-400">Weight</div>
                            <div class="font-medium text-white">4.2 kg</div>
                        </div>
                    </div>
                    
                    <div class="flex gap-2">
                        <button class="flex-1 text-xs outline-btn px-3 py-2" onclick="viewAnimal('SP-0015')">
                            View History
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Animal Card 3 -->
            <div class="animal-card">
                <div class="relative">
                    <img 
                        src="https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                        alt="Rocky" 
                        class="animal-image"
                    >
                    <div class="absolute top-3 right-3">
                        <span class="status-badge status-medical">Medical</span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <h3 class="text-lg font-bold text-white">Rocky</h3>
                            <p class="text-sm text-gray-400">German Shepherd • 4 years</p>
                        </div>
                        <div class="animal-type-icon dog-icon">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="animal-id mb-3">#SP-0008</div>
                    
                    <div class="grid grid-cols-2 gap-3 mb-4">
                        <div class="text-center p-2 bg-white/5 rounded">
                            <div class="text-xs text-gray-400">Gender</div>
                            <div class="font-medium text-white">Male</div>
                        </div>
                        <div class="text-center p-2 bg-white/5 rounded">
                            <div class="text-xs text-gray-400">Weight</div>
                            <div class="font-medium text-white">34 kg</div>
                        </div>
                    </div>
                    
                    <div class="flex gap-2">
                        <button class="flex-1 text-xs warning-btn px-3 py-2" onclick="viewMedical('SP-0008')">
                            Medical Records
                        </button>
                        <button class="text-xs outline-btn px-3 py-2" onclick="editAnimal('SP-0008')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Animal Card 4 -->
            <div class="animal-card">
                <div class="relative">
                   <img src="{{ asset('Thumper.jpg') }}" 
 
                        alt="Thumper" 
                        class="animal-image"
                    >
                    <div class="absolute top-3 right-3">
                        <span class="status-badge status-quarantine">Quarantine</span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <h3 class="text-lg font-bold text-white">Thumper</h3>
                            <p class="text-sm text-gray-400">Mini Lop Rabbit • 8 months</p>
                        </div>
                        <div class="animal-type-icon rabbit-icon">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="animal-id mb-3">#SP-0018</div>
                    
                    <div class="grid grid-cols-2 gap-3 mb-4">
                        <div class="text-center p-2 bg-white/5 rounded">
                            <div class="text-xs text-gray-400">Gender</div>
                            <div class="font-medium text-white">Female</div>
                        </div>
                        <div class="text-center p-2 bg-white/5 rounded">
                            <div class="text-xs text-gray-400">Weight</div>
                            <div class="font-medium text-white">1.8 kg</div>
                        </div>
                    </div>
                    
                    <div class="flex gap-2">
                        <button class="flex-1 text-xs outline-btn px-3 py-2" onclick="viewAnimal('SP-0018')">
                            Quarantine Details
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Animals Table View (Hidden by default) -->
        <div id="animalsTableView" class="hidden">
            <div class="table-container">
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th class="w-12">
                                <input type="checkbox" class="rounded">
                            </th>
                            <th>Animal ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Breed</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Status</th>
                            <th>Intake Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Animal 1 -->
                        <tr>
                            <td><input type="checkbox" class="rounded"></td>
                            <td class="font-medium">#SP-0012</td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full overflow-hidden">
                                        <img src="https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" class="w-full h-full object-cover">
                                    </div>
                                    <span class="text-white">Max</span>
                                </div>
                            </td>
                            <td class="text-white">Dog</td>
                            <td class="text-white">Golden Retriever</td>
                            <td class="text-white">2 years</td>
                            <td class="text-white">Male</td>
                            <td><span class="status-badge status-available">Available</span></td>
                            <td class="text-white">2023-10-15</td>
                            <td>
                                <div class="flex gap-2">
                                    <button class="text-xs primary-btn px-3 py-1" onclick="viewAnimal('SP-0012')">View</button>
                                    <button class="text-xs outline-btn px-3 py-1" onclick="editAnimal('SP-0012')">Edit</button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Animal 2 -->
                        <tr>
                            <td><input type="checkbox" class="rounded"></td>
                            <td class="font-medium">#SP-0015</td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full overflow-hidden">
                                        <img src="https://images.unsplash.com/photo-1514888286974-6d03bdeacba8?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" class="w-full h-full object-cover">
                                    </div>
                                    <span class="text-white">Luna</span>
                                </div>
                            </td>
                            <td class="text-white">Cat</td>
                            <td class="text-white">Domestic Shorthair</td>
                            <td class="text-white">1.5 years</td>
                            <td class="text-white">Female</td>
                            <td><span class="status-badge status-adopted">Adopted</span></td>
                            <td class="text-white">2023-09-22</td>
                            <td>
                                <div class="flex gap-2">
                                    <button class="text-xs outline-btn px-3 py-1" onclick="viewAnimal('SP-0015')">History</button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Add more animals as needed -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-between mt-8">
            <div class="text-sm text-gray-400">
                Showing 1-8 of 42 animals
            </div>
            
            <div class="flex items-center gap-2">
                <button class="px-3 py-1 rounded bg-white/10 hover:bg-white/20 disabled:opacity-50 text-white" disabled>
                    ← Previous
                </button>
                <button class="px-3 py-1 rounded bg-[#0ea5e9] text-white">1</button>
                <button class="px-3 py-1 rounded hover:bg-white/10 text-white">2</button>
                <button class="px-3 py-1 rounded hover:bg-white/10 text-white">3</button>
                <span class="text-gray-400">...</span>
                <button class="px-3 py-1 rounded hover:bg-white/10 text-white">6</button>
                <button class="px-3 py-1 rounded hover:bg-white/10 text-white">
                    Next →
                </button>
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

        // View toggle
        const gridViewBtn = document.getElementById('gridViewBtn');
        const tableViewBtn = document.getElementById('tableViewBtn');
        const animalsGridView = document.getElementById('animalsGridView');
        const animalsTableView = document.getElementById('animalsTableView');

        if (gridViewBtn && tableViewBtn) {
            gridViewBtn.addEventListener('click', () => {
                gridViewBtn.classList.add('bg-[#0ea5e9]', 'text-white');
                gridViewBtn.classList.remove('bg-white/10');
                tableViewBtn.classList.remove('bg-[#0ea5e9]', 'text-white');
                tableViewBtn.classList.add('bg-white/10');
                animalsGridView.classList.remove('hidden');
                animalsTableView.classList.add('hidden');
            });

            tableViewBtn.addEventListener('click', () => {
                tableViewBtn.classList.add('bg-[#0ea5e9]', 'text-white');
                tableViewBtn.classList.remove('bg-white/10');
                gridViewBtn.classList.remove('bg-[#0ea5e9]', 'text-white');
                gridViewBtn.classList.add('bg-white/10');
                animalsTableView.classList.remove('hidden');
                animalsGridView.classList.add('hidden');
            });
        }

        // Filter functions
        function applyFilters() {
            const type = document.getElementById('animalTypeFilter').value;
            const status = document.getElementById('statusFilter').value;
            const gender = document.getElementById('genderFilter').value;
            const age = document.getElementById('ageFilter').value;
            const search = document.getElementById('animalSearch').value;
            
            alert(`Filters applied:\nType: ${type || 'All'}\nStatus: ${status || 'All'}\nGender: ${gender || 'All'}\nAge: ${age || 'All'}\nSearch: ${search || 'None'}`);
            
            // In real app, this would filter the animals
            updateAnimalCount(8); // Demo count
        }

        function clearFilters() {
            document.getElementById('animalTypeFilter').value = '';
            document.getElementById('statusFilter').value = '';
            document.getElementById('genderFilter').value = '';
            document.getElementById('ageFilter').value = '';
            document.getElementById('animalSearch').value = '';
            alert('All filters cleared');
            updateAnimalCount(42); // Reset to total
        }

        function exportAnimals() {
            alert('Exporting animals data...');
        }

        function addNewAnimal() {
            alert('Opening form to add new animal...');
        }

        function viewAnimal(id) {
            alert(`Viewing details for animal ${id}`);
        }

        function editAnimal(id) {
            alert(`Editing animal ${id}`);
        }

        function viewMedical(id) {
            alert(`Opening medical records for animal ${id}`);
        }

        function updateAnimalCount(count) {
            const countElement = document.getElementById('animalCount');
            if (countElement) {
                countElement.textContent = count;
            }
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            updateAnimalCount(42);
            
            // Search functionality
            const searchInput = document.getElementById('animalSearch');
            if (searchInput) {
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        applyFilters();
                    }
                });
            }
        });
    </script>
</body>
</html>