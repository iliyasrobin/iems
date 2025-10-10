<div>
    <div class="flex flex-col gap-6 p-4">
        <!-- Header with breadcrumbs -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Equipment List</h1>
                <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                    <a href="{{ route('dashboard') }}" class="hover:text-indigo-600 hover:underline">Dashboard</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span>Equipment List</span>
                </div>
            </div>
            <button wire:click="create"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg shadow hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-300 focus:ring-offset-1 dark:focus:ring-offset-neutral-800 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Equipment
            </button>
        </div>

        <!-- Dashboard Stats for Equipment -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Total Equipment -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total Equipment</p>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">{{ $totalCount }}</h3>
                    </div>
                </div>
            </div>

            <!-- Active Equipment -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-green-50 dark:bg-green-900/20 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Active Equipment</p>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">
                            {{ $activeCount }}
                        </h3>
                    </div>
                </div>
            </div>

            <!-- Maintenance Equipment -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-amber-50 dark:bg-amber-900/20 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">In Maintenance</p>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">
                            {{ $maintenanceCount }}
                        </h3>
                    </div>
                </div>
            </div>

            <!-- Inactive Equipment -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-red-50 dark:bg-red-900/20 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Inactive Equipment</p>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">
                            {{ $inactiveCount }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-neutral-800 rounded-lg border border-neutral-200 dark:border-neutral-700 shadow-sm">
            <!-- Card Header with Search and Filters -->
            <div class="border-b border-neutral-200 dark:border-neutral-700 p-4">
                <div class="flex flex-col md:flex-row gap-3 md:items-center md:justify-between">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Manage Equipment</h2>

                    <div class="flex flex-col md:flex-row gap-3">
                        <!-- Search Field -->
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input
                                type="search"
                                wire:model.live.debounce.300ms="searchTerm"
                                class="pl-10 pr-4 py-2 w-full md:w-64 text-sm border border-gray-300 dark:border-neutral-700 rounded-lg bg-white dark:bg-neutral-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400"
                                placeholder="Search equipment..."
                            />
                        </div>

                        <!-- Status Filter -->
                        <select wire:model.live="filterStatus" class="py-2 px-3 text-sm border border-gray-300 dark:border-neutral-700 rounded-lg bg-white dark:bg-neutral-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                            <option value="">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="maintenance">In Maintenance</option>
                            <option value="disposed">Disposed</option>
                        </select>

                        <!-- Department Filter -->
                        <select wire:model.live="filterDepartment" class="py-2 px-3 text-sm border border-gray-300 dark:border-neutral-700 rounded-lg bg-white dark:bg-neutral-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                            <option value="">All Departments</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Flash Message -->
            @if (session()->has('message'))
                <div class="px-4 py-3 text-sm font-medium text-green-800 bg-green-100 dark:bg-green-800/20 dark:text-green-400 border-b border-green-200 dark:border-green-800/30">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Debug Information -->
            @if (session()->has('debug_info'))
                <div class="px-4 py-3 text-sm bg-blue-100 dark:bg-blue-800/20 border-b border-blue-200 dark:border-blue-800/30">
                    <h3 class="font-medium text-blue-800 dark:text-blue-200 mb-2">Debug Information:</h3>
                    @foreach(session('debug_info') as $key => $value)
                        <p class="text-xs text-blue-700 dark:text-blue-300">
                            <strong>{{ $key }}:</strong> {{ $value }}
                        </p>
                    @endforeach
                </div>
            @endif

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                    <thead class="bg-gray-100 dark:bg-neutral-700 text-gray-700 dark:text-gray-300">
                        <tr>
                            <th scope="col" class="px-4 py-3">#</th>
                            <th scope="col" class="px-4 py-3 cursor-pointer" wire:click="sortBy('name')">
                                <div class="flex items-center gap-1">
                                    Equipment Name
                                    @if ($sortField === 'name')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            @if ($sortDirection === 'asc')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            @endif
                                        </svg>
                                    @endif
                                </div>
                            </th>
                            <th scope="col" class="px-4 py-3">Category</th>
                            <th scope="col" class="px-4 py-3">Serial No.</th>
                            <th scope="col" class="px-4 py-3">Department</th>
                            <th scope="col" class="px-4 py-3">Assigned To</th>
                            <th scope="col" class="px-4 py-3">Challan Image</th>
                            <th scope="col" class="px-4 py-3 cursor-pointer" wire:click="sortBy('status')">
                                <div class="flex items-center gap-1">
                                    Status
                                    @if ($sortField === 'status')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            @if ($sortDirection === 'asc')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            @endif
                                        </svg>
                                    @endif
                                </div>
                            </th>
                            <th scope="col" class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                        @forelse ($equipments as $index => $equipment)
                            <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700/50">
                                <td class="px-4 py-3">{{ $equipments->firstItem() + $index }}</td>
                                <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $equipment->name }}</td>
                                <td class="px-4 py-3">{{ $equipment->category }}</td>
                                <td class="px-4 py-3">{{ $equipment->serial_number ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $equipment->department->name ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $equipment->assigned_to ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    @if ($equipment->chalan_image)
                                        <div class="relative group">
                                            <img src="{{ asset('storage/' . $equipment->chalan_image) }}"
                                                 class="h-10 w-10 object-cover cursor-pointer rounded border border-gray-200 dark:border-gray-600"
                                                 alt="Challan Image"
                                                 loading="lazy"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                                                 @click="$dispatch('open-modal', { id: 'view-challan-{{ $equipment->id }}' })" />
                                            <div class="hidden text-red-500 text-xs">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Failed to load
                                            </div>
                                            <!-- Tooltip showing image path for debugging -->
                                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 bg-black text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap z-10">
                                                {{ basename($equipment->chalan_image) }}
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm">No image</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if($equipment->status === 'active')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                            Active
                                        </span>
                                    @elseif($equipment->status === 'maintenance')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">
                                            Maintenance
                                        </span>
                                    @elseif($equipment->status === 'disposed')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                                            Disposed
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-neutral-700 dark:text-gray-400">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="inline-flex items-center space-x-2">
                                        <button wire:click="edit({{ $equipment->id }})" class="px-3 py-1 bg-indigo-100 text-indigo-700 hover:bg-indigo-200 rounded-full transition-colors duration-150 ease-in-out dark:bg-indigo-900/30 dark:text-indigo-300 dark:hover:bg-indigo-800/50 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </button>
                                        <button wire:click="delete({{ $equipment->id }})" class="px-3 py-1 bg-red-100 text-red-700 hover:bg-red-200 rounded-full transition-colors duration-150 ease-in-out dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-800/50 flex items-center">
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
                                <td colspan="8" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                        <p>No equipment found</p>
                                        @if($searchTerm || $filterStatus || $filterDepartment || $filterCategory)
                                            <button wire:click="$set('searchTerm', ''); $set('filterStatus', ''); $set('filterDepartment', ''); $set('filterCategory', '');" class="text-sm text-indigo-600 hover:underline mt-1">Clear filters</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4">
                {{ $equipments->links() }}
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
            <div class="relative w-full max-w-2xl p-6 overflow-y-auto max-h-[90vh] transition-all transform bg-white shadow-xl rounded-lg dark:bg-neutral-800 sm:scale-100"
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
                        {{ $updateMode ? 'Edit Equipment' : 'Add New Equipment' }}
                    </h3>
                    <button type="button" @click="open = false" class="text-gray-400 hover:text-gray-500">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Form -->
                <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Equipment Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Equipment Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" wire:model="name"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-neutral-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-neutral-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500"
                                placeholder="Enter equipment name">
                            @error('name')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Category <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="category" wire:model="category"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-neutral-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-neutral-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500"
                                placeholder="Enter category (e.g., Computer, Printer)">
                            @error('category')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Serial Number -->
                        <div>
                            <label for="serial_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Serial Number
                            </label>
                            <input type="text" id="serial_number" wire:model="serial_number"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-neutral-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-neutral-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500"
                                placeholder="Enter serial number">
                            @error('serial_number')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Department -->
                        <div>
                            <label for="department_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Department
                            </label>
                            <select id="department_id" wire:model="department_id"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-neutral-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-neutral-700 dark:text-white">
                                <option value="">Select Department</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Assigned To -->
                        <div>
                            <label for="assigned_to" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Assigned To
                            </label>
                            <input type="text" id="assigned_to" wire:model="assigned_to"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-neutral-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-neutral-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500"
                                placeholder="Enter user name">
                            @error('assigned_to')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select id="status" wire:model="status"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-neutral-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-neutral-700 dark:text-white">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="maintenance">In Maintenance</option>
                                <option value="disposed">Disposed</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Manufacturer -->
                        <div>
                            <label for="manufacturer" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Manufacturer
                            </label>
                            <input type="text" id="manufacturer" wire:model="manufacturer"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-neutral-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-neutral-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500"
                                placeholder="Enter manufacturer">
                            @error('manufacturer')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Model -->
                        <div>
                            <label for="model" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Model
                            </label>
                            <input type="text" id="model" wire:model="model"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-neutral-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-neutral-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500"
                                placeholder="Enter model">
                            @error('model')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Purchase Date -->
                        <div>
                            <label for="purchase_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Purchase Date
                            </label>
                            <input type="date" id="purchase_date" wire:model="purchase_date"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-neutral-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-neutral-700 dark:text-white">
                            @error('purchase_date')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Purchase Price -->
                        <div>
                            <label for="purchase_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Purchase Price
                            </label>
                            <input type="number" step="0.01" id="purchase_price" wire:model="purchase_price"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-neutral-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-neutral-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500"
                                placeholder="Enter purchase price">
                            @error('purchase_price')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Warranty Expiry -->
                        <div>
                            <label for="warranty_expiry" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Warranty Expiry
                            </label>
                            <input type="date" id="warranty_expiry" wire:model="warranty_expiry"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-neutral-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-neutral-700 dark:text-white">
                            @error('warranty_expiry')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Chalan Number -->
                        <div>
                            <label for="chalan_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Chalan Number
                            </label>
                            <input type="text" id="chalan_number" wire:model="chalan_number"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-neutral-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-neutral-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500"
                                placeholder="Enter chalan number">
                            @error('chalan_number')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Chalan Image -->
                        <div>
                            <label for="temp_chalan_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Chalan Image
                            </label>
                            <input type="file" id="temp_chalan_image" wire:model="temp_chalan_image" accept="image/*"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-neutral-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-neutral-700 dark:text-white">
                            @error('temp_chalan_image')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror

                            <!-- Image Preview -->
                            @if($temp_chalan_image)
                                <div class="mt-2">
                                    <img src="{{ $temp_chalan_image->temporaryUrl() }}" class="h-20 w-auto object-cover rounded">
                                </div>
                            @elseif($chalan_image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $chalan_image) }}" class="h-20 w-auto object-cover rounded">
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Description
                        </label>
                        <textarea id="description" wire:model="description" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-neutral-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-neutral-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500"
                            placeholder="Enter equipment description (optional)"></textarea>
                        @error('description')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end pt-2 gap-2">
                        <button type="button" @click="open = false"
                            class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 hover:bg-gray-200 dark:bg-neutral-700 dark:hover:bg-neutral-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 dark:focus:ring-offset-neutral-800 transition-colors duration-200">
                            Cancel
                        </button>
                        <button type="submit"
                            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-neutral-800 transition-colors duration-200">
                            {{ $updateMode ? 'Update Equipment' : 'Save Equipment' }}
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
                        Are you sure you want to delete this equipment? This action cannot be undone.
                    </p>

                    <div class="flex justify-center gap-3">
                        <button type="button" @click="open = false"
                            class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 hover:bg-gray-200 dark:bg-neutral-700 dark:hover:bg-neutral-600 rounded-md">
                            Cancel
                        </button>
                        <button type="button" wire:click="confirmDelete" @click="open = false"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-md">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine JS script for the modals -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('confirmDelete', () => ({
                open: false,
                show() {
                    this.open = true;
                },
                hide() {
                    this.open = false;
                }
            }));
        });
    </script>

    <!-- Challan Image Modals -->
    @foreach($equipments as $equipment)
        @if($equipment->chalan_image)
            <!-- Modal for each equipment with challan image -->
            <div
                x-data="{ open: false }"
                x-show="open"
                @open-modal.window="if ($event.detail.id === 'view-challan-{{ $equipment->id }}') open = true"
                @keydown.escape.window="open = false"
                class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center"
                x-cloak
            >
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-black opacity-50" @click="open = false"></div>

                <!-- Modal container -->
                <div class="relative bg-white dark:bg-neutral-800 rounded-lg shadow-xl max-w-3xl w-full mx-auto z-10">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-neutral-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            Challan Image - {{ $equipment->name }}
                        </h3>
                        <button @click="open = false" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="p-6">
                        <div class="flex justify-center">
                            <div class="relative">
                                <img
                                    src="{{ asset('storage/' . $equipment->chalan_image) }}"
                                    alt="Challan Image for {{ $equipment->name }}"
                                    class="max-h-[70vh] max-w-full object-contain rounded-lg"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                                />
                                <div class="hidden text-center text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-lg font-medium">Failed to load image</p>
                                    <p class="text-sm text-gray-500 mt-2">Path: {{ $equipment->chalan_image }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="flex items-center justify-end p-4 border-t border-gray-200 dark:border-neutral-700">
                        <button
                            @click="open = false"
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 dark:bg-neutral-700 dark:text-gray-300 dark:hover:bg-neutral-600"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
