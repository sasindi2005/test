<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users & Teams - SafePaws</title>
    
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

        /* Status Badges */
        .status-badge {
            @apply px-3 py-1 text-xs font-semibold rounded-full inline-flex items-center gap-1;
        }
        
        .status-active { 
            background-color: rgba(16, 185, 129, 0.2);
            color: #10b981;
        }
        
        .status-inactive { 
            background-color: rgba(107, 114, 128, 0.2);
            color: #9ca3af;
        }
        
        .status-on-leave { 
            background-color: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
        }
        
        .status-busy { 
            background-color: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        /* Role Badges */
        .role-admin {
            @apply bg-purple-500/20 text-purple-300;
        }
        
        .role-rescue {
            @apply bg-blue-500/20 text-blue-300;
        }
        
        .role-vet {
            @apply bg-green-500/20 text-green-300;
        }
        
        .role-staff {
            @apply bg-yellow-500/20 text-yellow-300;
        }
        
        .role-volunteer {
            @apply bg-pink-500/20 text-pink-300;
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

        /* Sidebar Navigation */
        .nav-link {
            @apply flex items-center gap-3 px-4 py-3 text-gray-300 hover:text-white 
                   hover:bg-white/10 rounded-lg transition-all duration-300;
        }
        
        .nav-link.active {
            @apply bg-[#0ea5e9]/20 text-[#0ea5e9] border-l-4 border-[#0ea5e9];
        }

        /* Team Cards */
        .team-card {
            @apply glass-card p-6 hover-lift;
        }
        
        .team-members {
            @apply flex -space-x-2;
        }
        
        .team-member {
            @apply w-8 h-8 rounded-full border-2 border-[#0b2447];
        }

        /* User Cards */
        .user-card {
            @apply glass-card p-6 hover-lift;
        }
        
        .user-avatar {
            @apply w-16 h-16 rounded-full mx-auto mb-4 border-2 border-white/20;
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Main Container -->
    <div class="flex min-h-screen">
        <!-- Sidebar - UPDATED TO MATCH IMAGE -->
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

            <!-- Navigation - UPDATED TO MATCH IMAGE -->
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
                
                <a href="{{ url('/adoptions') }}" class="nav-link">
                    <i class="fas fa-home"></i>
                    <span>Adoptions</span>
                </a>
                
                <a href="{{ url('/users') }}" class="nav-link active">
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
                    <img src="https://ui-avatars.com/api/?name=HR+Manager&background=0ea5e9&color=fff" 
                         alt="HR Manager" class="w-10 h-10 rounded-full">
                    <div class="flex-1">
                        <h4 class="text-sm font-semibold text-white">Administrator</h4>
                        <p class="text-xs text-gray-400">Dashboard</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Top Navigation - UPDATED TITLE -->
            <header class="sticky top-0 z-40 bg-[#0b2447]/95 backdrop-blur-sm border-b border-white/10">
                <div class="flex items-center justify-between px-6 py-4">
                    <!-- Mobile Menu Button -->
                    <button id="mobileMenuBtn" class="lg:hidden text-gray-300 hover:text-white">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    
                    <!-- Page Title - UPDATED TO MATCH IMAGE -->
                    <div>
                        <h2 class="text-xl font-bold text-white">Dashboard Overview</h2>
                        <p class="text-sm text-gray-400">Welcome back, Administrator</p>
                    </div>
                    
                    <!-- Right Side Actions -->
                    <div class="flex items-center gap-4">
                        <a href="{{ url('/users/create') }}" class="btn-primary">
                            <i class="fas fa-user-plus"></i>
                            Add New User
                        </a>
                        <a href="{{ url('/teams/create') }}" class="btn-secondary">
                            <i class="fas fa-users"></i>
                            Create Team
                        </a>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="p-6">
                <!-- Stats Overview - UPDATED TO MATCH IMAGE -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <!-- Stat 1 -->
                    <div class="glass-card p-6 hover-lift">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="stats-icon bg-blue-500/20 text-blue-400 mb-4">
                                    <i class="fas fa-flag"></i>
                                </div>
                                <div class="text-2xl font-bold text-white">142</div>
                                <div class="text-gray-300 text-sm">New Reports This Month</div>
                            </div>
                            <div class="text-green-400 text-sm">
                                <i class="fas fa-arrow-up"></i> 12%
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stat 2 -->
                    <div class="glass-card p-6 hover-lift">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="stats-icon bg-green-500/20 text-green-400 mb-4">
                                    <i class="fas fa-ambulance"></i>
                                </div>
                                <div class="text-2xl font-bold text-white">89</div>
                                <div class="text-gray-300 text-sm">Animals Rescued</div>
                            </div>
                            <div class="text-green-400 text-sm">
                                <i class="fas fa-arrow-up"></i> 8%
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stat 3 -->
                    <div class="glass-card p-6 hover-lift">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="stats-icon bg-purple-500/20 text-purple-400 mb-4">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="text-2xl font-bold text-white">67</div>
                                <div class="text-gray-300 text-sm">Successful Adoptions</div>
                            </div>
                            <div class="text-green-400 text-sm">
                                <i class="fas fa-arrow-up"></i> 15%
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stat 4 -->
                    <div class="glass-card p-6 hover-lift">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="stats-icon bg-yellow-500/20 text-yellow-400 mb-4">
                                    <i class="fas fa-donate"></i>
                                </div>
                                <div class="text-2xl font-bold text-white">$2,450</div>
                                <div class="text-gray-300 text-sm">Donations Received</div>
                            </div>
                            <div class="text-green-400 text-sm">
                                <i class="fas fa-arrow-up"></i> 23%
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts and Content -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Rescue Operations Chart -->
                    <div class="glass-card p-6">
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

                    <!-- Recent Activity -->
                    <div class="glass-card p-6">
                        <h3 class="text-lg font-semibold text-white mb-6">Recent Activity</h3>
                        
                        <div class="space-y-4">
                            <!-- Activity 1 -->
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
                            
                            <!-- Activity 2 -->
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
                            
                            <!-- Activity 3 -->
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
                            
                            <!-- Activity 4 -->
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

                <!-- Rest of your existing content (Users Table, Rescue Teams, etc.) -->
                <!-- Keep all your existing content below this point -->

                <!-- Tabs -->
                <div class="glass-card p-6 mb-8">
                    <!-- ... your existing tabs content ... -->
                </div>

                <!-- Rescue Teams -->
                <div class="glass-card p-6 mb-8">
                    <!-- ... your existing teams content ... -->
                </div>

                <!-- Quick Actions & Recent Activity -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- ... your existing quick actions content ... -->
                </div>
            </main>

            <!-- Footer -->
            <footer class="border-t border-white/10 bg-[#0b2447]/80 p-6">
                <div class="max-w-7xl mx-auto">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-[#0ea5e9] rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-white"></i>
                            </div>
                            <div>
                                <div class="font-semibold text-white">SafePaws Team Management</div>
                                <div class="text-xs text-gray-400">Building strong teams • © 2023</div>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4 text-sm text-gray-400">
                            <div class="flex items-center gap-1">
                                <i class="fas fa-phone"></i>
                                <span>HR: (555) 987-6543</span>
                            </div>
                            <a href="{{ url('/contact') }}" class="hover:text-white transition-colors">Contact</a>
                            <a href="{{ url('/help') }}" class="hover:text-white transition-colors">Help</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Mobile Menu Script -->
    <script>
        // Mobile sidebar functionality
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', function() {
                // Create mobile sidebar if it doesn't exist
                if (!document.getElementById('mobileSidebarContent')) {
                    const sidebarHTML = `
                        <div class="fixed inset-0 z-50 lg:hidden" id="mobileSidebar">
                            <div class="absolute inset-0 bg-black/50" id="sidebarOverlay"></div>
                            <div class="absolute left-0 top-0 bottom-0 w-64 bg-[#0b2447] transform -translate-x-full transition-transform duration-300" id="mobileSidebarContent">
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
                                    <a href="{{ url('/adoptions') }}" class="nav-link">
                                        <i class="fas fa-home"></i>
                                        <span>Adoptions</span>
                                    </a>
                                    <a href="{{ url('/users') }}" class="nav-link active">
                                        <i class="fas fa-users"></i>
                                        <span>Users & Teams</span>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    `;
                    
                    document.body.insertAdjacentHTML('beforeend', sidebarHTML);
                    
                    // Add event listeners for the new sidebar
                    const sidebarOverlay = document.getElementById('sidebarOverlay');
                    const closeSidebar = document.getElementById('closeSidebar');
                    const sidebarContent = document.getElementById('mobileSidebarContent');
                    
                    function openMobileSidebar() {
                        document.getElementById('mobileSidebar').classList.remove('hidden');
                        setTimeout(() => {
                            sidebarContent.classList.remove('-translate-x-full');
                        }, 10);
                    }

                    function closeMobileSidebar() {
                        sidebarContent.classList.add('-translate-x-full');
                        setTimeout(() => {
                            document.getElementById('mobileSidebar').classList.add('hidden');
                        }, 300);
                    }

                    mobileMenuBtn.addEventListener('click', openMobileSidebar);
                    closeSidebar.addEventListener('click', closeMobileSidebar);
                    sidebarOverlay.addEventListener('click', closeMobileSidebar);
                    
                    // Open the sidebar
                    openMobileSidebar();
                } else {
                    // Toggle existing sidebar
                    const sidebar = document.getElementById('mobileSidebar');
                    const sidebarContent = document.getElementById('mobileSidebarContent');
                    
                    if (sidebar.classList.contains('hidden')) {
                        sidebar.classList.remove('hidden');
                        setTimeout(() => {
                            sidebarContent.classList.remove('-translate-x-full');
                        }, 10);
                    } else {
                        sidebarContent.classList.add('-translate-x-full');
                        setTimeout(() => {
                            sidebar.classList.add('hidden');
                        }, 300);
                    }
                }
            });
        }

        // Update active nav link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.getAttribute('href') === '#') {
                    e.preventDefault();
                }
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Button hover effects
        document.querySelectorAll('.btn-primary, .btn-secondary, .btn-success, .btn-danger').forEach(button => {
            button.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });

        // Tab switching functionality
        document.querySelectorAll('.glass-card .px-4.py-2').forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                document.querySelectorAll('.glass-card .px-4.py-2').forEach(t => {
                    t.classList.remove('border-b-2', 'border-[#0ea5e9]', 'text-[#0ea5e9]');
                    t.classList.add('text-gray-400', 'hover:text-white');
                });
                
                // Add active class to clicked tab
                this.classList.add('border-b-2', 'border-[#0ea5e9]', 'text-[#0ea5e9]');
                this.classList.remove('text-gray-400', 'hover:text-white');
            });
        });

        // Delete user confirmation
        document.querySelectorAll('.btn-danger').forEach(button => {
            if (button.innerHTML.includes('fa-trash')) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
                        const row = this.closest('tr');
                        row.style.opacity = '0.5';
                        setTimeout(() => {
                            row.style.display = 'none';
                            alert('User deleted successfully!');
                        }, 500);
                    }
                });
            }
        });
    </script>
</body>
</html>