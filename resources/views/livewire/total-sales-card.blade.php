<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 relative group hover:shadow-md transition-all duration-300" x-data="{show:false}">
    <!-- Header with icon and menu -->
    <div class="flex items-start justify-between mb-4">
        <div class="flex items-center space-x-3">
            <div class="p-3 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-sm">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-600">Total Sales</h3>
                <p class="text-xs text-gray-400">Transactions completed</p>
            </div>
        </div>
        
        <button class="p-2 rounded-lg hover:bg-gray-100 transition-colors" @click="show = !show">
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
            </svg>
        </button>
    </div>

    <!-- Value -->
    <div class="mb-4">
        <div class="text-3xl font-bold text-gray-900">
            {{$sale}}
        </div>
        <div class="text-sm text-gray-500 mt-1">
            <span class="inline-flex items-center">
                <svg class="w-4 h-4 text-blue-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Sales transactions
            </span>
        </div>
    </div>

    <!-- Dropdown Menu -->
    <div class="absolute top-4 right-4 bg-white border border-gray-200 rounded-lg shadow-lg py-1 z-50 min-w-[120px]" 
         x-show="show" 
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         @click.away="show = false">
        <button class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors" 
                @click="show = false" 
                wire:click="day">
            Today
        </button>
        <button class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors" 
                @click="show = false" 
                wire:click="month">
            This Month
        </button>
        <button class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors" 
                @click="show = false" 
                wire:click="year">
            This Year
        </button>
    </div>
</div>
