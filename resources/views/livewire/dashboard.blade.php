<div class="flex flex-col gap-6 p-4" wire:poll.30s>
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Dashboard</h1>
        <button 
            wire:click="refresh" 
            class="flex items-center gap-1 px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 dark:bg-neutral-800 dark:text-gray-200 dark:border-neutral-700 dark:hover:bg-neutral-700"
            wire:loading.class="opacity-75"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" wire:loading.class="animate-spin">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            <span>Refresh</span>
        </button>
    </div>
    
    <!-- Main Stats Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Equipment Card -->
        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5 transition-all hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-500 dark:text-neutral-400 text-sm font-medium mb-1">Total Equipment</p>
                    <h3 class="text-2xl font-bold text-neutral-800 dark:text-white">{{ $totalEquipment }}</h3>
                    <p class="text-indigo-500 text-xs mt-1 font-medium">
                        <span class="inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
                            </svg>
                            {{ $activeEquipment }} active
                        </span>
                    </p>
                </div>
                <div class="p-3 bg-indigo-50 dark:bg-indigo-900/20 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
            </div>
        </div>
        
        <!-- Departments Card -->
        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5 transition-all hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-500 dark:text-neutral-400 text-sm font-medium mb-1">Departments</p>
                    <h3 class="text-2xl font-bold text-neutral-800 dark:text-white">{{ $totalDepartments }}</h3>
                    <p class="text-blue-500 text-xs mt-1 font-medium">
                        <span class="inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                            </svg>
                            {{ $activeDepartments }} active
                        </span>
                    </p>
                </div>
                <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            </div>
        </div>
        
        <!-- Gate Passes Card -->
        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5 transition-all hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-500 dark:text-neutral-400 text-sm font-medium mb-1">Gate Passes</p>
                    <h3 class="text-2xl font-bold text-neutral-800 dark:text-white">{{ $totalGatePasses }}</h3>
                    <p class="text-emerald-500 text-xs mt-1 font-medium">
                        <span class="inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                            {{ $pendingGatePasses }} pending
                        </span>
                    </p>
                </div>
                <div class="p-3 bg-emerald-50 dark:bg-emerald-900/20 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
        </div>
        
        <!-- Requisitions Card -->
        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5 transition-all hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-500 dark:text-neutral-400 text-sm font-medium mb-1">Requisitions</p>
                    <h3 class="text-2xl font-bold text-neutral-800 dark:text-white">{{ $totalRequisitions }}</h3>
                    <p class="text-amber-500 text-xs mt-1 font-medium">
                        <span class="inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            {{ $pendingRequisitions }} pending
                        </span>
                    </p>
                </div>
                <div class="p-3 bg-amber-50 dark:bg-amber-900/20 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts & Detailed Stats Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Equipment Status Distribution -->
        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Equipment Status</h3>
            <div class="flex items-center justify-between mb-4">
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-emerald-500 mr-2"></div>
                        <span class="text-xs dark:text-gray-300">Active ({{ $activeEquipment }})</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-amber-500 mr-2"></div>
                        <span class="text-xs dark:text-gray-300">Maintenance ({{ $maintenanceEquipment }})</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-red-500 mr-2"></div>
                        <span class="text-xs dark:text-gray-300">Inactive ({{ $inactiveEquipment }})</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-gray-500 mr-2"></div>
                        <span class="text-xs dark:text-gray-300">Disposed ({{ $disposedEquipment }})</span>
                    </div>
                </div>
            </div>
            <div class="h-64" wire:ignore>
                <canvas id="equipmentStatusChart"></canvas>
            </div>
        </div>
        
        <!-- Monthly Equipment Additions -->
        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Monthly Additions ({{ date('Y') }})</h3>
            <div class="h-64" wire:ignore>
                <canvas id="monthlyAdditionsChart"></canvas>
            </div>
        </div>
        
        <!-- Equipment by Department -->
        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Equipment by Department (Top 5)</h3>
            <div class="h-64" wire:ignore>
                <canvas id="departmentEquipmentChart"></canvas>
            </div>
        </div>
        
        <!-- Gate Pass & Requisition Status -->
        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Approval Statistics</h3>
            <div class="flex flex-col gap-4">
                <!-- Gate Pass Status -->
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Gate Passes</h4>
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $totalGatePasses }} total</span>
                    </div>
                    <div class="w-full h-4 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="flex h-full">
                            <div class="bg-emerald-500 h-full" style="width: {{ $totalGatePasses > 0 ? ($approvedGatePasses / $totalGatePasses * 100) : 0 }}%"></div>
                            <div class="bg-amber-500 h-full" style="width: {{ $totalGatePasses > 0 ? ($pendingGatePasses / $totalGatePasses * 100) : 0 }}%"></div>
                            <div class="bg-red-500 h-full" style="width: {{ $totalGatePasses > 0 ? ($declinedGatePasses / $totalGatePasses * 100) : 0 }}%"></div>
                        </div>
                    </div>
                    <div class="flex text-xs gap-4 mt-1">
                        <div class="flex items-center">
                            <div class="w-2 h-2 rounded-full bg-emerald-500 mr-1"></div>
                            <span class="dark:text-gray-300">Approved ({{ $approvedGatePasses }})</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-2 h-2 rounded-full bg-amber-500 mr-1"></div>
                            <span class="dark:text-gray-300">Pending ({{ $pendingGatePasses }})</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-2 h-2 rounded-full bg-red-500 mr-1"></div>
                            <span class="dark:text-gray-300">Declined ({{ $declinedGatePasses }})</span>
                        </div>
                    </div>
                </div>
                
                <!-- Requisition Status -->
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Requisitions</h4>
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $totalRequisitions }} total</span>
                    </div>
                    <div class="w-full h-4 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="flex h-full">
                            <div class="bg-emerald-500 h-full" style="width: {{ $totalRequisitions > 0 ? ($approvedRequisitions / $totalRequisitions * 100) : 0 }}%"></div>
                            <div class="bg-amber-500 h-full" style="width: {{ $totalRequisitions > 0 ? ($pendingRequisitions / $totalRequisitions * 100) : 0 }}%"></div>
                            <div class="bg-red-500 h-full" style="width: {{ $totalRequisitions > 0 ? ($declinedRequisitions / $totalRequisitions * 100) : 0 }}%"></div>
                        </div>
                    </div>
                    <div class="flex text-xs gap-4 mt-1">
                        <div class="flex items-center">
                            <div class="w-2 h-2 rounded-full bg-emerald-500 mr-1"></div>
                            <span class="dark:text-gray-300">Approved ({{ $approvedRequisitions }})</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-2 h-2 rounded-full bg-amber-500 mr-1"></div>
                            <span class="dark:text-gray-300">Pending ({{ $pendingRequisitions }})</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-2 h-2 rounded-full bg-red-500 mr-1"></div>
                            <span class="dark:text-gray-300">Declined ({{ $declinedRequisitions }})</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Tables Section -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        <!-- Recent Equipment -->
        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Recent Equipment</h3>
                <a href="{{ route('equipment') }}" class="text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 flex items-center">
                    View All
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Department</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($recentEquipment as $equipment)
                            <tr>
                                <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $equipment->name }}</td>
                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $equipment->department->name ?? 'Unassigned' }}</td>
                                <td class="px-3 py-2 whitespace-nowrap">
                                    @switch($equipment->status)
                                        @case('active')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-200/20 dark:text-green-100">Active</span>
                                            @break
                                        @case('maintenance')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-200/20 dark:text-yellow-100">Maintenance</span>
                                            @break
                                        @case('inactive')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-200/20 dark:text-red-100">Inactive</span>
                                            @break
                                        @case('disposed')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-200/20 dark:text-gray-100">Disposed</span>
                                            @break
                                        @default
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-200/20 dark:text-gray-100">{{ ucfirst($equipment->status) }}</span>
                                    @endswitch
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-3 py-4 text-center text-sm text-gray-500 dark:text-gray-400">No equipment data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Recent Gate Passes -->
        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Recent Gate Passes</h3>
                <a href="{{ route('gate-passes') }}" class="text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 flex items-center">
                    View All
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Item</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">User</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($recentGatePasses as $gatePass)
                            <tr>
                                <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $gatePass->item_name }}</td>
                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $gatePass->user->name }}</td>
                                <td class="px-3 py-2 whitespace-nowrap">
                                    @switch($gatePass->status)
                                        @case('approved')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-200/20 dark:text-green-100">Approved</span>
                                            @break
                                        @case('pending')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-200/20 dark:text-yellow-100">Pending</span>
                                            @break
                                        @case('declined')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-200/20 dark:text-red-100">Declined</span>
                                            @break
                                        @default
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-200/20 dark:text-gray-100">{{ ucfirst($gatePass->status) }}</span>
                                    @endswitch
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-3 py-4 text-center text-sm text-gray-500 dark:text-gray-400">No gate pass data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Recent Requisitions -->
        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5 xl:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Recent Requisitions</h3>
                <a href="{{ route('requisitions') }}" class="text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 flex items-center">
                    View All
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Item</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Quantity</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">User</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Purpose</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($recentRequisitions as $requisition)
                            <tr>
                                <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $requisition->item_name }}</td>
                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $requisition->quantity }}</td>
                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $requisition->user->name }}</td>
                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ \Illuminate\Support\Str::limit($requisition->purpose, 30) }}</td>
                                <td class="px-3 py-2 whitespace-nowrap">
                                    @switch($requisition->status)
                                        @case('approved')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-200/20 dark:text-green-100">Approved</span>
                                            @break
                                        @case('pending')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-200/20 dark:text-yellow-100">Pending</span>
                                            @break
                                        @case('declined')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-200/20 dark:text-red-100">Declined</span>
                                            @break
                                        @default
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-200/20 dark:text-gray-100">{{ ucfirst($requisition->status) }}</span>
                                    @endswitch
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-3 py-4 text-center text-sm text-gray-500 dark:text-gray-400">No requisition data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Store chart instances in an object to better manage them
        let dashboardCharts = {
            equipmentStatus: null,
            monthlyAdditions: null,
            departmentEquipment: null
        };
        
        function initCharts() {
            // Destroy existing chart instances if they exist
            Object.keys(dashboardCharts).forEach(key => {
                if (dashboardCharts[key]) {
                    dashboardCharts[key].destroy();
                    dashboardCharts[key] = null;
                }
            });
            
            // Equipment Status Chart
            const equipmentStatusCtx = document.getElementById('equipmentStatusChart');
            if (equipmentStatusCtx) {
                const ctx = equipmentStatusCtx.getContext('2d');
                dashboardCharts.equipmentStatus = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Active', 'Maintenance', 'Inactive', 'Disposed'],
                        datasets: [{
                            data: [
                                {{ $activeEquipment }}, 
                                {{ $maintenanceEquipment }}, 
                                {{ $inactiveEquipment }}, 
                                {{ $disposedEquipment }}
                            ],
                            backgroundColor: [
                                '#10b981', // emerald-500
                                '#f59e0b', // amber-500
                                '#ef4444', // red-500
                                '#6b7280'  // gray-500
                            ],
                            borderWidth: 0
                        }]
                    },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    cutout: '70%'
                }
            });
            
            }
            
            // Monthly Additions Chart
            const monthlyAdditionsCtx = document.getElementById('monthlyAdditionsChart');
            if (monthlyAdditionsCtx) {
                const ctx = monthlyAdditionsCtx.getContext('2d');
                dashboardCharts.monthlyAdditions = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($monthlyLabels),
                    datasets: [
                        {
                            label: 'Equipment',
                            data: @json($monthlyEquipmentData),
                            borderColor: '#6366f1', // indigo-500
                            backgroundColor: 'rgba(99, 102, 241, 0.2)', // indigo with transparency
                            fill: true,
                            tension: 0.4
                        },
                        {
                            label: 'Gate Passes',
                            data: @json($monthlyGatePassData),
                            borderColor: '#10b981', // emerald-500
                            backgroundColor: 'rgba(16, 185, 129, 0.2)', // emerald with transparency
                            fill: true,
                            tension: 0.4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(156, 163, 175, 0.1)' // gray-400 with transparency
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
            
            }
            
            // Department Equipment Chart
            const departmentEquipmentCtx = document.getElementById('departmentEquipmentChart');
            if (departmentEquipmentCtx) {
                const ctx = departmentEquipmentCtx.getContext('2d');
                dashboardCharts.departmentEquipment = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($equipmentByDepartment->pluck('name')->toArray()),
                    datasets: [{
                        label: 'Equipment Count',
                        data: @json($equipmentByDepartment->pluck('count')->toArray()),
                        backgroundColor: [
                            'rgba(99, 102, 241, 0.7)', // indigo-500
                            'rgba(16, 185, 129, 0.7)', // emerald-500
                            'rgba(245, 158, 11, 0.7)', // amber-500
                            'rgba(59, 130, 246, 0.7)', // blue-500
                            'rgba(139, 92, 246, 0.7)'  // violet-500
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(156, 163, 175, 0.1)' // gray-400 with transparency
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
            }
        }
        
        // Initialize charts on first page load
        document.addEventListener('DOMContentLoaded', initCharts);
        
        // Initialize charts when the Livewire component is initialized
        document.addEventListener('livewire:init', () => {
            // Listen for component-specific events
            Livewire.on('dashboardUpdated', () => {
                // Small timeout to ensure DOM is ready
                setTimeout(initCharts, 50);
            });
            
            // Auto-refresh dashboard data every 30 seconds
            setInterval(() => {
                // Only refresh if the dashboard is visible
                if (document.getElementById('equipmentStatusChart')) {
                    Livewire.dispatch('refreshDashboard');
                }
            }, 30000);
        });
        
        // Handle Livewire navigation events
        document.addEventListener('livewire:navigated', () => {
            setTimeout(initCharts, 50);
        });
        
        // Handle Livewire updates
        document.addEventListener('livewire:update', () => {
            setTimeout(initCharts, 50);
        });
        
        // Call initCharts immediately in case we're already loaded
        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            setTimeout(initCharts, 100);
        }
    </script>
</div>
