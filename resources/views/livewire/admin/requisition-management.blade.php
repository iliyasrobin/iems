<div>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    
    <div class="sm:flex sm:items-center sm:justify-between mb-6">
        <div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Requisition Management</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Approve or decline requisitions submitted by users.
            </p>
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

    <!-- Filter by User -->
    <div class="mb-4">
        <label for="userFilter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter by User</label>
        <div class="flex space-x-2">
            <select id="userFilter" wire:model="viewingUserId" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                <option value="">All Users</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <button wire:click="resetUserFilter" 
                class="px-3 py-1 bg-gray-100 text-gray-700 hover:bg-gray-200 rounded-md transition-colors duration-150 ease-in-out dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                Reset
            </button>
        </div>
    </div>

    <!-- Status Filter Tabs -->
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
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
                        <th scope="col" class="px-4 py-3">User</th>
                        <th scope="col" class="px-4 py-3">Item Name</th>
                        <th scope="col" class="px-4 py-3">Quantity</th>
                        <th scope="col" class="px-4 py-3">Purpose</th>
                        <th scope="col" class="px-4 py-3">Submitted On</th>
                        <th scope="col" class="px-4 py-3">Status</th>
                        <th scope="col" class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($requisitions as $requisition)
                        <tr
                            class="border-b dark:border-gray-700/30 hover:bg-gray-50/30 dark:hover:bg-gray-700/10">
                            <td class="px-4 py-3">{{ $requisition->id }}</td>
                            <td class="px-4 py-3">{{ $requisition->user->name }}</td>
                            <td class="px-4 py-3 font-medium">{{ $requisition->item_name }}</td>
                            <td class="px-4 py-3">{{ $requisition->quantity }}</td>
                            <td class="px-4 py-3">{{ $requisition->purpose }}</td>
                            <td class="px-4 py-3">{{ $requisition->created_at->format('M d, Y H:i') }}</td>
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
                                        <!-- Approve Button -->
                                        <button wire:click="confirmAction({{ $requisition->id }}, 'approved')"
                                            class="px-3 py-1 bg-green-100 text-green-700 hover:bg-green-200 rounded-full transition-colors duration-150 ease-in-out dark:bg-green-900/30 dark:text-green-300 dark:hover:bg-green-800/50 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Approve
                                        </button>

                                        <!-- Decline Button -->
                                        <button wire:click="confirmAction({{ $requisition->id }}, 'declined')"
                                            class="px-3 py-1 bg-red-100 text-red-700 hover:bg-red-200 rounded-full transition-colors duration-150 ease-in-out dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-800/50 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Decline
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                                No requisitions found for the selected status.
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

    <!-- Action Modal (Approve/Decline) -->
    <div x-data="{ open: @entangle('actionModalOpen').live }" 
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
                        {{ $actionType === 'approved' ? 'Approve' : 'Decline' }} Requisition
                    </h3>
                    <button type="button" @click="open = false" class="text-gray-400 hover:text-gray-500">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <!-- Form -->
                <form wire:submit.prevent="processAction" class="space-y-4">
                    <div class="flex flex-col items-center mb-4">
                        <div class="flex items-center justify-center h-12 w-12 rounded-full {{ $actionType === 'approved' ? 'bg-green-100 dark:bg-green-900/30' : 'bg-red-100 dark:bg-red-900/30' }} mb-3">
                            @if ($actionType === 'approved')
                                <svg class="h-6 w-6 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            @else
                                <svg class="h-6 w-6 text-red-600 dark:text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            @endif
                        </div>
                        
                        <p class="text-sm text-gray-500 dark:text-gray-400 text-center mb-4">
                            Are you sure you want to {{ $actionType === 'approved' ? 'approve' : 'decline' }} this requisition? 
                            Please add your remarks below.
                        </p>
                    </div>
                    
                    <div>
                        <label for="remarks" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Remarks <span class="text-red-500">*</span>
                        </label>
                        <textarea wire:model="remarks" id="remarks" rows="3" 
                                  class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm"></textarea>
                        @error('remarks') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>
                    
                    <!-- Form Buttons -->
                    <div class="flex justify-end space-x-3 mt-5">
                        <button @click="open = false" type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white {{ $actionType === 'approved' ? 'bg-green-600 hover:bg-green-700 focus:ring-green-500' : 'bg-red-600 hover:bg-red-700 focus:ring-red-500' }} border border-transparent rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2">
                            {{ $actionType === 'approved' ? 'Approve' : 'Decline' }}
                        </button>
                    </div>
                </form>
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
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Requested By</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $detailRequisition->user->name }}</dd>
                            </div>
                            
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Quantity</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $detailRequisition->quantity }}</dd>
                            </div>
                            
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Submitted On</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $detailRequisition->created_at->format('M d, Y H:i') }}</dd>
                            </div>
                            
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $detailRequisition->updated_at->format('M d, Y H:i') }}</dd>
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
                            
                            @if($detailRequisition->status !== 'pending')
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
                        
                        @if($detailRequisition->status === 'pending')
                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700 flex space-x-3">
                            <button wire:click="confirmAction({{ $detailRequisition->id }}, 'declined')" @click="open = false" type="button" class="flex-1 px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Decline
                            </button>
                            <button wire:click="confirmAction({{ $detailRequisition->id }}, 'approved')" @click="open = false" type="button" class="flex-1 px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Approve
                            </button>
                        </div>
                        @else
                        <!-- Footer -->
                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                            <button @click="open = false" type="button" class="w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                                Close
                            </button>
                        </div>
                        @endif
                    @else
                        <div class="py-4 text-center text-gray-500 dark:text-gray-400">
                            Loading requisition details...
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>