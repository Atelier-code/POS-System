<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 relative group hover:shadow-md transition-all duration-300" x-data="{show:false}">
    <!-- Header with icon and menu -->
    <div class="flex items-start justify-between mb-4">
        <div class="flex items-center space-x-3">
            <div class="p-3 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl shadow-sm">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-600">Total Revenue</h3>
                <p class="text-xs text-gray-400">Today's earnings</p>
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
        <div class="text-3xl font-bold text-gray-900 overflow-x-scroll scrollcustom">
            GH₵{{number_format($revenue,2)}}
        </div>
        <div class="text-sm text-gray-500 mt-1">
            <span class="inline-flex items-center">
                <svg class="w-4 h-4 text-emerald-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
                Revenue generated
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
