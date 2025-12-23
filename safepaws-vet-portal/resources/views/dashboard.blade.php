<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafePaws LK - Vet Portal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-900 text-white" x-data="{ activeTab: 'dashboard' }">
    <div class="flex min-h-screen">
        <aside class="fixed left-0 top-0 h-screen w-64 bg-slate-800 border-r border-slate-700 flex flex-col">
            <div class="p-6 border-b border-slate-700">
                <h1 class="text-2xl font-bold text-sky-500">SafePaws LK</h1>
                <p class="text-sm text-slate-400 mt-1">Veterinary Portal</p>
            </div>

            <nav class="flex-1 p-4 space-y-2">
                <button @click="activeTab = 'dashboard'"
                        :class="activeTab === 'dashboard' ? 'bg-sky-500 text-white' : 'text-slate-300 hover:bg-slate-700'"
                        class="w-full text-left px-4 py-3 rounded-lg transition-colors font-medium">
                    <svg class="inline-block w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </button>

                <button @click="activeTab = 'branches'"
                        :class="activeTab === 'branches' ? 'bg-sky-500 text-white' : 'text-slate-300 hover:bg-slate-700'"
                        class="w-full text-left px-4 py-3 rounded-lg transition-colors font-medium">
                    <svg class="inline-block w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Branches
                </button>

                <button @click="activeTab = 'appointments'"
                        :class="activeTab === 'appointments' ? 'bg-sky-500 text-white' : 'text-slate-300 hover:bg-slate-700'"
                        class="w-full text-left px-4 py-3 rounded-lg transition-colors font-medium">
                    <svg class="inline-block w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Appointments
                </button>

                <button @click="activeTab = 'reports'"
                        :class="activeTab === 'reports' ? 'bg-sky-500 text-white' : 'text-slate-300 hover:bg-slate-700'"
                        class="w-full text-left px-4 py-3 rounded-lg transition-colors font-medium">
                    <svg class="inline-block w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Medical Reports
                </button>
            </nav>

            <div class="p-4 border-t border-slate-700">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-full bg-amber-500 flex items-center justify-center font-bold">
                            {{ substr(auth()->user()->name ?? 'V', 0, 1) }}
                        </div>
                        <div>
                            <p class="font-medium">{{ auth()->user()->name ?? 'Vet User' }}</p>
                            <p class="text-xs text-slate-400">Veterinarian</p>
                        </div>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 text-sm text-red-400 hover:bg-red-500/10 rounded-lg transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="ml-64 flex-1 p-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/20 border border-green-500 rounded-lg text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            <div x-show="activeTab === 'dashboard'" x-transition>
                <h2 class="text-3xl font-bold mb-8">Dashboard Overview</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700 rounded-xl p-6 hover:border-sky-500 transition-colors">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-sky-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-slate-400 text-sm font-medium mb-1">Total Patients</h3>
                        <p class="text-3xl font-bold">{{ $stats['patients'] }}</p>
                    </div>

                    <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700 rounded-xl p-6 hover:border-sky-500 transition-colors">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-amber-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-slate-400 text-sm font-medium mb-1">Appointments</h3>
                        <p class="text-3xl font-bold">{{ $stats['appointments'] }}</p>
                    </div>

                    <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700 rounded-xl p-6 hover:border-sky-500 transition-colors">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-slate-400 text-sm font-medium mb-1">Medical Reports</h3>
                        <p class="text-3xl font-bold">{{ $stats['reports'] }}</p>
                    </div>

                    <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700 rounded-xl p-6 hover:border-sky-500 transition-colors">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-amber-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-slate-400 text-sm font-medium mb-1">Monthly Revenue</h3>
                        <p class="text-3xl font-bold">{{ $stats['revenue'] }}</p>
                    </div>
                </div>
            </div>

            <div x-show="activeTab === 'branches'" x-transition>
                <h2 class="text-3xl font-bold mb-8">Our Branches</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($branches as $branch)
                        <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700 rounded-xl p-6 hover:border-sky-500 transition-colors">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-sky-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg mb-1">{{ $branch->name }}</h3>
                                    <p class="text-slate-400 text-sm flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $branch->location }}
                                    </p>
                                    @if($branch->phone)
                                        <p class="text-slate-400 text-sm mt-2">{{ $branch->phone }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-12 text-slate-400">
                            No branches found
                        </div>
                    @endforelse
                </div>
            </div>

            <div x-show="activeTab === 'appointments'" x-transition>
                <h2 class="text-3xl font-bold mb-8">Appointments</h2>

                <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700 rounded-xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-slate-800 border-b border-slate-700">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Patient</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Date</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-700">
                                @forelse($appointments as $appt)
                                    <tr class="hover:bg-slate-700/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-10 h-10 bg-sky-500/20 rounded-full flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="font-medium">{{ $appt->patient->name }}</p>
                                                    <p class="text-sm text-slate-400">{{ $appt->patient->species }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-slate-300">
                                            {{ $appt->time?->format('d M Y, h:i A') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                                {{ $appt->status === 'completed' ? 'bg-green-500/20 text-green-400' : '' }}
                                                {{ $appt->status === 'pending' ? 'bg-amber-500/20 text-amber-400' : '' }}
                                                {{ $appt->status === 'cancelled' ? 'bg-red-500/20 text-red-400' : '' }}">
                                                {{ ucfirst($appt->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center text-slate-400">
                                            No appointments found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div x-show="activeTab === 'reports'" x-transition x-data="{ filePreview: null }">
                <h2 class="text-3xl font-bold mb-8">Medical Reports</h2>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700 rounded-xl overflow-hidden">
                        <div class="p-6 border-b border-slate-700">
                            <h3 class="text-xl font-bold">Recent Reports</h3>
                        </div>
                        <div class="overflow-x-auto max-h-[600px] overflow-y-auto">
                            <table class="w-full">
                                <thead class="bg-slate-800 border-b border-slate-700 sticky top-0">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-sm font-semibold">Title</th>
                                        <th class="px-6 py-3 text-left text-sm font-semibold">Patient</th>
                                        <th class="px-6 py-3 text-left text-sm font-semibold">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-700">
                                    @forelse($reports as $report)
                                        <tr class="hover:bg-slate-700/50 transition-colors">
                                            <td class="px-6 py-3 font-medium">{{ $report->title }}</td>
                                            <td class="px-6 py-3 text-slate-300">{{ $report->patient->name }}</td>
                                            <td class="px-6 py-3 text-slate-400 text-sm">
                                                {{ $report->created_at?->format('d M Y') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-6 py-8 text-center text-slate-400">
                                                No reports found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700 rounded-xl p-6">
                        <h3 class="text-xl font-bold mb-6">Add Medical Record</h3>

                        <form action="{{ route('medical-records.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf

                            <div>
                                <label class="block text-sm font-medium mb-2">Patient</label>
                                <select name="patient_id" required
                                        class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-sky-500">
                                    <option value="">Select Patient</option>
                                    @foreach($patients as $patient)
                                        <option value="{{ $patient->id }}">{{ $patient->name }} - {{ $patient->species }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Title</label>
                                <input type="text" name="title" required
                                       class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-sky-500"
                                       placeholder="e.g., Regular Checkup">
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Symptoms</label>
                                <textarea name="symptoms" rows="3"
                                          class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-sky-500"
                                          placeholder="Describe symptoms..."></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Diagnosis</label>
                                <textarea name="diagnosis" rows="3"
                                          class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-sky-500"
                                          placeholder="Your diagnosis..."></textarea>
                            </div>

                            <div x-data="{ prescriptions: [''] }">
                                <label class="block text-sm font-medium mb-2">Prescription</label>
                                <template x-for="(prescription, index) in prescriptions" :key="index">
                                    <div class="flex gap-2 mb-2">
                                        <input type="text" name="prescription[]" x-model="prescriptions[index]"
                                               class="flex-1 bg-slate-700 border border-slate-600 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-sky-500"
                                               placeholder="Medicine name">
                                        <button type="button" @click="prescriptions.splice(index, 1)" x-show="prescriptions.length > 1"
                                                class="px-3 bg-red-500/20 text-red-400 rounded-lg hover:bg-red-500/30 transition-colors">
                                            ×
                                        </button>
                                    </div>
                                </template>
                                <button type="button" @click="prescriptions.push('')"
                                        class="text-sm text-sky-500 hover:text-sky-400 font-medium">
                                    + Add Medicine
                                </button>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Upload File</label>
                                <input type="file" name="file" accept=".pdf,.jpg,.jpeg,.png"
                                       @change="filePreview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null"
                                       class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-sky-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-sky-500 file:text-white file:cursor-pointer hover:file:bg-sky-600">
                                <p class="text-xs text-slate-400 mt-1">PDF, JPG, JPEG or PNG (max 10MB)</p>

                                <div x-show="filePreview" class="mt-4">
                                    <img :src="filePreview" class="w-full h-48 object-cover rounded-lg border border-slate-600">
                                </div>
                            </div>

                            <button type="submit"
                                    class="w-full bg-sky-500 hover:bg-sky-600 text-white font-semibold py-3 rounded-lg transition-colors">
                                Add Medical Record
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
