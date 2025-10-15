<div class="">
    <div class="">
        <div class="">

            <h2 class="text-2xl font-semibold text-gray-800">Export Data</h2>
        </div>

        <!-- Date pickers -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 mt-6">
            <div class="max-w-[400px]">
                <label for="start_date" class="block text-sm font-medium text-gray-600 mb-2">Start Date</label>
                <div class="relative">
                    <input wire:model="startDate" id="start_date" type="date"
                           class="peer w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 pl-10 pr-3 py-2 transition-all hover:border-indigo-400">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="absolute left-3 top-2.5 h-5 w-5 text-gray-400 peer-focus:text-indigo-500"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M8 7V3m8 4V3m-9 8h10m-12 7h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v9a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>

            <div class="max-w-[400px]">
                <label for="end_date" class="block text-sm font-medium text-gray-600 mb-2">End Date</label>
                <div class="relative">
                    <input wire:model="endDate" id="end_date" type="date"
                           class="peer w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 pl-10 pr-3 py-2 transition-all hover:border-indigo-400">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="absolute left-3 top-2.5 h-5 w-5 text-gray-400 peer-focus:text-indigo-500"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M8 7V3m8 4V3m-9 8h10m-12 7h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v9a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Checkboxes -->
        <div class="mb-8">
            <label class="block text-sm font-medium text-gray-600 mb-3">Select Data to Export</label>
            <div class="flex items-center gap-6 flex-wrap">
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input wire:model="exportSales" type="checkbox"
                           class="form-checkbox h-5 w-5 text-indigo-600 border-gray-300 rounded-md focus:ring-indigo-500 hover:scale-105 transition-transform">
                    <span class="text-gray-700 font-medium">Sales</span>
                </label>

                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input wire:model="exportReturns" type="checkbox"
                           class="form-checkbox h-5 w-5 text-indigo-600 border-gray-300 rounded-md focus:ring-indigo-500 hover:scale-105 transition-transform">
                    <span class="text-gray-700 font-medium">Returns</span>
                </label>
            </div>
        </div>

        <!-- Export Button -->
        <div class="flex justify-end">
            <button wire:click="exportData"
                    class="inline-flex items-center gap-2 px-6 py-2.5 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                </svg>
                <span wire:loading>Loading...</span>
                <span wire:loading.remove>Export Report</span>
            </button>
        </div>
    </div>
</div>
