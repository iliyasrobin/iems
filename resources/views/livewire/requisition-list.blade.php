<div>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    
    <div class="sm:flex sm:items-center sm:justify-between mb-6">
        <div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Requisitions</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Create and manage your requisitions for items and supplies.
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <button wire:click="createNewRequisition"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-500 dark:hover:bg-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 inline" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                New Requisition
            </button>
        </div>
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
            role="alert">
            {{ session('message') }}
        </div>
    @endif

    <!-- Error Message -->
    @if (session()->has('error'))
        <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
            role="alert">
            {{ session('error') }}
        </div>
    @endif

    <!-- Status Filter Tabs -->
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
            <li class="mr-2">
                <button wire:click="setActiveTab('all')"
                    class="inline-block p-4 {{ $activeTab === 'all' ? 'text-indigo-600 border-b-2 border-indigo-600 dark:text-indigo-500 dark:border-indigo-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }}">
                    All
                </button>
            </li>
            <li class="mr-2">
                <button wire:click="setActiveTab('pending')"
                    class="inline-block p-4 {{ $activeTab === 'pending' ? 'text-indigo-600 border-b-2 border-indigo-600 dark:text-indigo-500 dark:border-indigo-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }}">
                    Pending
                </button>
            </li>
            <li class="mr-2">
                <button wire:click="setActiveTab('approved')"
                    class="inline-block p-4 {{ $activeTab === 'approved' ? 'text-indigo-600 border-b-2 border-indigo-600 dark:text-indigo-500 dark:border-indigo-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }}">
                    Approved
                </button>
            </li>
            <li>
                <button wire:click="setActiveTab('declined')"
                    class="inline-block p-4 {{ $activeTab === 'declined' ? 'text-indigo-600 border-b-2 border-indigo-600 dark:text-indigo-500 dark:border-indigo-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }}">
                    Declined
                </button>
            </li>
        </ul>
    </div>

    <!-- Requisitions Table -->
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-700 dark:text-gray-300">
                <thead class="bg-gray-50 dark:bg-gray-700/30 text-xs uppercase text-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">ID</th>
                        <th scope="col" class="px-4 py-3">Item Name</th>
                        <th scope="col" class="px-4 py-3">Quantity</th>
                        <th scope="col" class="px-4 py-3">Purpose</th>
                        <th scope="col" class="px-4 py-3">Status</th>
                        <th scope="col" class="px-4 py-3">Submitted On</th>
                        <th scope="col" class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($requisitions as $requisition)
                        <tr
                            class="border-b dark:border-gray-700/30 hover:bg-gray-50/30 dark:hover:bg-gray-700/10">
                            <td class="px-4 py-3">{{ $requisition->id }}</td>
                            <td class="px-4 py-3 font-medium">{{ $requisition->item_name }}</td>
                            <td class="px-4 py-3">{{ $requisition->quantity }}</td>
                            <td class="px-4 py-3">{{ $requisition->purpose }}</td>
                            <td class="px-4 py-3">
                                @if ($requisition->status === 'pending')
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-200/20 dark:text-yellow-100">
                                        Pending
                                    </span>
                                @elseif ($requisition->status === 'approved')
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-200/20 dark:text-green-100">
                                        Approved
                                    </span>
                                @else
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-200/20 dark:text-red-100">
                                        Declined
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3">{{ $requisition->created_at->format('M d, Y H:i') }}</td>
                            <td class="px-4 py-3">
                                <div class="inline-flex items-center space-x-2">
                                    <!-- Show Details Button -->
                                    <button type="button" wire:click="loadRequisitionDetails({{ $requisition->id }})"
                                        class="px-3 py-1 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-full transition-colors duration-150 ease-in-out dark:bg-blue-900/30 dark:text-blue-300 dark:hover:bg-blue-800/50 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Details
                                    </button>

                                    @if ($requisition->status === 'pending')
                                        <!-- Edit Button -->
                                        <button wire:click="edit({{ $requisition->id }})"
                                            class="px-3 py-1 bg-indigo-100 text-indigo-700 hover:bg-indigo-200 rounded-full transition-colors duration-150 ease-in-out dark:bg-indigo-900/30 dark:text-indigo-300 dark:hover:bg-indigo-800/50 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </button>

                                        <!-- Delete Button -->
                                        <button wire:click="confirmDelete({{ $requisition->id }})"
                                            class="px-3 py-1 bg-red-100 text-red-700 hover:bg-red-200 rounded-full transition-colors duration-150 ease-in-out dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-800/50 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                                No requisitions found. Click the "New Requisition" button to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $requisitions->links() }}
    </div>

    <!-- Create/Edit Requisition Modal -->
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
                        {{ $isEditing ? 'Edit Requisition' : 'Create New Requisition' }}
                    </h3>
                    <button type="button" @click="open = false" class="text-gray-400 hover:text-gray-500">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <!-- Form -->
                <form wire:submit.prevent="saveRequisition" class="space-y-4">
                    <!-- Item Name -->
                    <div>
                        <label for="item_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Item Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="item_name" id="item_name" 
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                        @error('item_name') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>
                    
                    <!-- Quantity -->
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Quantity <span class="text-red-500">*</span>
                        </label>
                        <input type="number" wire:model="quantity" id="quantity" min="1" 
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                        @error('quantity') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>
                    
                    <!-- Purpose -->
                    <div>
                        <label for="purpose" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Purpose <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="purpose" id="purpose" 
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                        @error('purpose') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>
                    
                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Description (Optional)
                        </label>
                        <textarea wire:model="description" id="description" rows="3" 
                                  class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm"></textarea>
                        @error('description') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>
                    
                    <!-- Form Buttons -->
                    <div class="flex justify-end space-x-3 mt-5">
                        <button @click="open = false" type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ $isEditing ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-data="{ open: @entangle('confirmingDelete').live }" 
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
            <div class="relative w-full max-w-sm p-6 overflow-hidden transition-all transform bg-white shadow-xl rounded-lg dark:bg-neutral-800 sm:scale-100"
                 x-show="open"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                
                <div class="flex flex-col items-center text-center">
                    <div class="flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900/30 mb-4">
                        <svg class="h-6 w-6 text-red-600 dark:text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                        Delete Requisition
                    </h3>
                    
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                        Are you sure you want to delete this requisition? This action cannot be undone.
                    </p>
                    
                    <div class="flex space-x-3 w-full">
                        <button @click="open = false" type="button" class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                            Cancel
                        </button>
                        <button wire:click="delete" type="button" class="flex-1 px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Details Modal -->
    <div x-data="{ open: @entangle('showDetailModal').live }"
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
            <div class="relative w-full max-w-lg p-6 overflow-hidden transition-all transform bg-white shadow-xl rounded-lg dark:bg-neutral-800 sm:scale-100"
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
                        Requisition Details
                    </h3>
                    <button type="button" @click="open = false" class="text-gray-400 hover:text-gray-500">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <!-- Content -->
                <div class="space-y-4">
                    @if($detailRequisition)
                        <!-- Status Badge -->
                        <div class="mb-4 flex justify-between items-center">
                            <div>
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Status:</span>
                                @if($detailRequisition->status === 'pending')
                                    <span class="ml-2 px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-200/20 dark:text-yellow-100">Pending</span>
                                @elseif($detailRequisition->status === 'approved')
                                    <span class="ml-2 px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-200/20 dark:text-green-100">Approved</span>
                                @else
                                    <span class="ml-2 px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-200/20 dark:text-red-100">Declined</span>
                                @endif
                            </div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">#{{ $detailRequisition->id }}</span>
                        </div>
                        
                        <!-- Details Grid -->
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Item Name</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $detailRequisition->item_name }}</dd>
                            </div>
                            
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Quantity</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $detailRequisition->quantity }}</dd>
                            </div>
                            
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Submitted On</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $detailRequisition->created_at->format('M d, Y H:i') }}</dd>
                            </div>
                            
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Purpose</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $detailRequisition->purpose }}</dd>
                            </div>
                            
                            @if($detailRequisition->description)
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white whitespace-pre-line">{{ $detailRequisition->description }}</dd>
                            </div>
                            @endif
                            
                            @if($detailRequisition->status !== 'pending' && $detailRequisition->approver)
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Processed By</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                                    {{ $detailRequisition->approver ? $detailRequisition->approver->name : 'N/A' }}
                                </dd>
                            </div>
                            
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Processed On</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                                    {{ $detailRequisition->updated_at->format('M d, Y H:i') }}
                                </dd>
                            </div>
                            
                            @if($detailRequisition->approval_remarks)
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Remarks</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $detailRequisition->approval_remarks }}</dd>
                            </div>
                            @endif
                            @endif
                        </dl>
                    @else
                        <div class="py-4 text-center text-gray-500 dark:text-gray-400">
                            Loading requisition details...
                        </div>
                    @endif
                    
                    <!-- Footer -->
                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                        <button @click="open = false" type="button" class="w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>