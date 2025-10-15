<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 relative group hover:shadow-md transition-all duration-300" x-data="{show:false}">
    <!-- Header with icon and menu -->
    <div class="flex items-start justify-between mb-4">
        <div class="flex items-center space-x-3">
            <div class="p-3 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl shadow-sm">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-600">Returns</h3>
                <p class="text-xs text-gray-400">Products returned</p>
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
            {{$returns}}
        </div>
        <div class="text-sm text-gray-500 mt-1">
            <span class="inline-flex items-center">
                <svg class="w-4 h-4 text-amber-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Items returned
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
                wire:click="week">
            This Week
        </button>
        <button class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors"
                @click="show = false"
                wire:click="month">
            This Month
        </button>
    </div>
</div>
