<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 relative group hover:shadow-md transition-all duration-300" x-data="{show:false}">
    <!-- Header with icon and menu -->
    <div class="flex items-start justify-between mb-4">
        <div class="flex items-center space-x-3">
            <div class="p-3 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-sm">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-600">Employees</h3>
                <p class="text-xs text-gray-400">Team members</p>
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
            {{$users}}
        </div>
        <div class="text-sm text-gray-500 mt-1">
            <span class="inline-flex items-center">
                <svg class="w-4 h-4 text-purple-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Active team members
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
        <a href="{{route('admin.manage.users')}}" 
           class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors" 
           @click="show = false">
            View All Employees
        </a>
    </div>
</div>
