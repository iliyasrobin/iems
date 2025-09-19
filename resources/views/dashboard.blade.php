<x-layouts.app :title="__('Dashboard')">
    <div class="flex flex-col gap-6 p-4">
        <h1 class="text-2xl font-bold">Dashboard</h1>
        
        <!-- Stats Overview Blocks -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <!-- Active Computers -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5 transition-all hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-neutral-500 dark:text-neutral-400 text-sm font-medium mb-1">Active Computers</p>
                        <h3 class="text-2xl font-bold text-neutral-800 dark:text-white">142</h3>
                        <p class="text-emerald-500 text-xs mt-1 font-medium">
                            <span class="inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12 7a1 1 0 01-1 1H9a1 1 0 01-1-1V6a1 1 0 011-1h2a1 1 0 011 1v1zm-2-2a2 2 0 00-2 2v1a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2zm2 8a1 1 0 01-1 1H9a1 1 0 01-1-1v-1a1 1 0 011-1h2a1 1 0 011 1v1zm-2-2a2 2 0 00-2 2v1a2 2 0 002 2h2a2 2 0 002-2v-1a2 2 0 00-2-2h-2z" clip-rule="evenodd" />
                                </svg>
                                2.5% increase
                            </span>
                        </p>
                    </div>
                    <div class="p-3 bg-emerald-50 dark:bg-emerald-900/20 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Computers Under Service -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5 transition-all hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-neutral-500 dark:text-neutral-400 text-sm font-medium mb-1">On Service</p>
                        <h3 class="text-2xl font-bold text-neutral-800 dark:text-white">23</h3>
                        <p class="text-amber-500 text-xs mt-1 font-medium">
                            <span class="inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                4 new this week
                            </span>
                        </p>
                    </div>
                    <div class="p-3 bg-amber-50 dark:bg-amber-900/20 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Total Departments -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5 transition-all hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-neutral-500 dark:text-neutral-400 text-sm font-medium mb-1">Total Departments</p>
                        <h3 class="text-2xl font-bold text-neutral-800 dark:text-white">17</h3>
                        <p class="text-blue-500 text-xs mt-1 font-medium">
                            <span class="inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
                                </svg>
                                All active
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
            
            <!-- ICT Equipment -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-neutral-200 dark:border-neutral-700 p-5 transition-all hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-neutral-500 dark:text-neutral-400 text-sm font-medium mb-1">Total Equipment</p>
                        <h3 class="text-2xl font-bold text-neutral-800 dark:text-white">248</h3>
                        <p class="text-indigo-500 text-xs mt-1 font-medium">
                            <span class="inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                                </svg>
                                12 new this month
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
        </div>
        
        <!-- Recent Equipment Table -->
        <h2 class="text-xl font-semibold mb-3">Recent Equipment</h2>
        <div class="overflow-x-auto rounded-lg border border-neutral-200 dark:border-neutral-700">
            <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                <thead class="bg-neutral-100 dark:bg-neutral-800">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-200">SL No.~</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-200">Equipments Name</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-200">Category</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-200">SN No.</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-200">Department</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-200">User Name</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-200">Chalan Name</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-200">Chalan Image</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-200">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    {{-- Dynamic rows will be inserted here --}}
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
