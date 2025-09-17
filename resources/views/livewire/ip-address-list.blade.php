<div>
    <div class="flex flex-col gap-6 p-4">
        <!-- Header with breadcrumbs -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">IP Address Management</h1>
                <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                    <a href="{{ route('dashboard') }}" class="hover:text-indigo-600 hover:underline">Dashboard</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span>IP Addresses</span>
                </div>
            </div>
            <button wire:click="create" 
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg shadow hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-300 focus:ring-offset-1 dark:focus:ring-offset-neutral-800 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add IP Address
            </button>
        </div>

        <!-- Dashboard Stats for IP Addresses -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Total IP Addresses -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total IP Addresses</p>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">{{ $totalCount }}</h3>
                    </div>
                </div>
            </div>
            
            <!-- Active IP Addresses -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-green-50 dark:bg-green-900/20 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Active IP Addresses</p>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">{{ $activeCount }}</h3>
                    </div>
                </div>
            </div>
            
            <!-- Reserved IP Addresses -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-amber-50 dark:bg-amber-900/20 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Reserved IP Addresses</p>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">{{ $reservedCount }}</h3>
                    </div>
                </div>
            </div>
            
            <!-- Inactive IP Addresses -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-red-50 dark:bg-red-900/20 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Inactive IP Addresses</p>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">{{ $inactiveCount }}</h3>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Search and filters -->
        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow p-4 flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <label for="search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-neutral-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms="searchTerm" id="search" class="block w-full pl-10 pr-3 py-2 border border-neutral-300 dark:border-neutral-700 rounded-md shadow-sm text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-neutral-800 dark:text-white" placeholder="Search IP addresses...">
                </div>
            </div>
            <div class="flex flex-col md:flex-row gap-3">
                <div>
                    <label for="statusFilter" class="sr-only">Status</label>
                    <select wire:model.live="filterStatus" id="statusFilter" class="block w-full pl-3 pr-10 py-2 text-base border border-neutral-300 dark:border-neutral-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md dark:bg-neutral-800 dark:text-white">
                        <option value="">All Statuses</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="reserved">Reserved</option>
                    </select>
                </div>
                <div>
                    <label for="departmentFilter" class="sr-only">Department</label>
                    <select wire:model.live="filterDepartment" id="departmentFilter" class="block w-full pl-3 pr-10 py-2 text-base border border-neutral-300 dark:border-neutral-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md dark:bg-neutral-800 dark:text-white">
                        <option value="">All Departments</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Session message -->
        @if (session()->has('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 dark:bg-green-900/50 dark:text-green-300" role="alert">
                <p>{{ session('message') }}</p>
            </div>
        @endif
        
        <!-- IP Addresses Table -->
        <div class="overflow-x-auto bg-white dark:bg-neutral-800 rounded-lg shadow">
            <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                <thead class="bg-neutral-50 dark:bg-neutral-800">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider cursor-pointer" wire:click="sortBy('ip_address')">
                            <div class="flex items-center">
                                IP Address
                                @if ($sortField === 'ip_address')
                                    <span class="ml-1">
                                        @if ($sortDirection === 'asc')
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                            </svg>
                                        @else
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        @endif
                                    </span>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">
                            Subnet Mask
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider cursor-pointer" wire:click="sortBy('device_name')">
                            <div class="flex items-center">
                                Device
                                @if ($sortField === 'device_name')
                                    <span class="ml-1">
                                        @if ($sortDirection === 'asc')
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                            </svg>
                                        @else
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        @endif
                                    </span>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">
                            Department
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">
                            Location
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">
                            Assigned To
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-neutral-800 divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse ($ipAddresses as $ipAddress)
                        <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-700/30 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-neutral-900 dark:text-neutral-200">
                                {{ $ipAddress->ip_address }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500 dark:text-neutral-400">
                                {{ $ipAddress->subnet_mask ?? '255.255.255.0' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500 dark:text-neutral-400">
                                {{ $ipAddress->device_name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500 dark:text-neutral-400">
                                {{ $ipAddress->department ? $ipAddress->department->name : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500 dark:text-neutral-400">
                                {{ $ipAddress->location ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($ipAddress->status == 'active') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                                    @elseif($ipAddress->status == 'reserved') bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400
                                    @else bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 @endif">
                                    {{ ucfirst($ipAddress->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500 dark:text-neutral-400">
                                {{ $ipAddress->assigned_to ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button wire:click="edit({{ $ipAddress->id }})" class="px-3 py-1 bg-indigo-100 text-indigo-700 hover:bg-indigo-200 rounded-full transition-colors duration-150 ease-in-out dark:bg-indigo-900/30 dark:text-indigo-300 dark:hover:bg-indigo-800/50 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </button>
                                    <button wire:click="delete({{ $ipAddress->id }})" class="px-3 py-1 bg-red-100 text-red-700 hover:bg-red-200 rounded-full transition-colors duration-150 ease-in-out dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-800/50 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-center text-neutral-500 dark:text-neutral-400">
                                No IP addresses found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-4 border-t border-neutral-200 dark:border-neutral-700">
                {{ $ipAddresses->links() }}
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div x-data="{ open: @entangle('modalOpen').live }" 
         x-show="open" 
         x-cloak
         class="fixed inset-0 z-50 overflow-y-auto"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div class="flex items-center justify-center min-h-screen p-4">
            <!-- Overlay -->
            <div class="fixed inset-0 bg-black/50" x-show="open" @click="open = false"></div>
            
            <!-- Modal Content -->
            <div class="relative w-full max-w-md p-6 overflow-hidden transition-all transform bg-white shadow-xl rounded-lg dark:bg-neutral-800 sm:scale-100"
                 x-show="open"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                
                <!-- Header -->
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-white">
                        {{ $updateMode ? 'Edit IP Address' : 'Add New IP Address' }}
                    </h3>
                    <button type="button" @click="open = false" class="text-gray-400 hover:text-gray-500">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <!-- Form -->
                <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" class="space-y-4">
                    <!-- IP Address -->
                    <div>
                        <label for="ip_address" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">IP Address <span class="text-red-500">*</span></label>
                        <input type="text" wire:model="ip_address" id="ip_address" class="mt-1 block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border-neutral-300 dark:border-neutral-700 dark:bg-neutral-700 dark:text-white rounded-md">
                        @error('ip_address') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Subnet Mask -->
                    <div>
                        <label for="subnet_mask" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">Subnet Mask</label>
                        <input type="text" wire:model="subnet_mask" id="subnet_mask" class="mt-1 block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border-neutral-300 dark:border-neutral-700 dark:bg-neutral-700 dark:text-white rounded-md">
                        @error('subnet_mask') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Gateway -->
                        <div>
                            <label for="gateway" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">Gateway</label>
                            <input type="text" wire:model="gateway" id="gateway" class="mt-1 block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border-neutral-300 dark:border-neutral-700 dark:bg-neutral-700 dark:text-white rounded-md">
                            @error('gateway') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- DNS -->
                        <div>
                            <label for="dns" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">DNS</label>
                            <input type="text" wire:model="dns" id="dns" class="mt-1 block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border-neutral-300 dark:border-neutral-700 dark:bg-neutral-700 dark:text-white rounded-md">
                            @error('dns') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Department -->
                        <div>
                            <label for="department_id" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">Department</label>
                            <select wire:model="department_id" id="department_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-neutral-300 dark:border-neutral-700 dark:bg-neutral-700 dark:text-white focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">Status <span class="text-red-500">*</span></label>
                            <select wire:model="status" id="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-neutral-300 dark:border-neutral-700 dark:bg-neutral-700 dark:text-white focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="reserved">Reserved</option>
                            </select>
                            @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Location -->
                        <div>
                            <label for="location" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">Location</label>
                            <input type="text" wire:model="location" id="location" class="mt-1 block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border-neutral-300 dark:border-neutral-700 dark:bg-neutral-700 dark:text-white rounded-md">
                            @error('location') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Device Name -->
                        <div>
                            <label for="device_name" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">Device Name</label>
                            <input type="text" wire:model="device_name" id="device_name" class="mt-1 block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border-neutral-300 dark:border-neutral-700 dark:bg-neutral-700 dark:text-white rounded-md">
                            @error('device_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- MAC Address -->
                        <div>
                            <label for="mac_address" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">MAC Address</label>
                            <input type="text" wire:model="mac_address" id="mac_address" class="mt-1 block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border-neutral-300 dark:border-neutral-700 dark:bg-neutral-700 dark:text-white rounded-md">
                            @error('mac_address') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Assigned Date -->
                        <div>
                            <label for="assigned_date" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">Assigned Date</label>
                            <input type="date" wire:model="assigned_date" id="assigned_date" class="mt-1 block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border-neutral-300 dark:border-neutral-700 dark:bg-neutral-700 dark:text-white rounded-md">
                            @error('assigned_date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Assigned To -->
                    <div>
                        <label for="assigned_to" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">Assigned To</label>
                        <input type="text" wire:model="assigned_to" id="assigned_to" class="mt-1 block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border-neutral-300 dark:border-neutral-700 dark:bg-neutral-700 dark:text-white rounded-md">
                        @error('assigned_to') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">Description</label>
                        <textarea wire:model="description" id="description" rows="3" class="mt-1 block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border-neutral-300 dark:border-neutral-700 dark:bg-neutral-700 dark:text-white rounded-md"></textarea>
                        @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Buttons -->
                    <div class="flex justify-end pt-2 gap-2">
                        <button type="button" @click="open = false"
                            class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 hover:bg-gray-200 dark:bg-neutral-700 dark:hover:bg-neutral-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 dark:focus:ring-offset-neutral-800 transition-colors duration-200">
                            Cancel
                        </button>
                        <button type="submit"
                            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-neutral-800 transition-colors duration-200">
                            {{ $updateMode ? 'Update IP Address' : 'Save IP Address' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div x-data="{ open: false }"
         x-show="open" 
         x-cloak
         @show-delete-confirmation.window="open = true"
         class="fixed inset-0 z-50 overflow-y-auto"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div class="flex items-center justify-center min-h-screen p-4">
            <!-- Overlay -->
            <div class="fixed inset-0 bg-black/50" x-show="open" @click="open = false"></div>
            
            <!-- Modal Content -->
            <div class="relative w-full max-w-sm p-6 overflow-hidden transition-all transform bg-white shadow-xl rounded-lg dark:bg-neutral-800 sm:scale-100"
                 x-show="open"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900/30 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 dark:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Delete Confirmation</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                        Are you sure you want to delete this IP address? This action cannot be undone.
                    </p>
                    
                    <div class="flex justify-center gap-3">
                        <button @click="open = false" type="button" 
                            class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 hover:bg-gray-200 dark:bg-neutral-700 dark:hover:bg-neutral-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 dark:focus:ring-offset-neutral-800 transition-colors duration-200">
                            Cancel
                        </button>
                        <button wire:click="confirmDelete" @click="open = false" type="button"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:focus:ring-offset-neutral-800 transition-colors duration-200">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>