<div class="ml-5 lg:flex items-center space-x-5 hidden relative" x-data="{ show: true }" @click.away="show = false">
    <!-- Search Input Container -->
    <div class="relative flex items-center">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <input 
            class="w-80 pl-10 pr-4 py-3 text-sm border border-gray-300 rounded-lg bg-white shadow-sm focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-200 placeholder-gray-400" 
            placeholder="Search users, products..." 
            wire:model.live="search" 
            @focus="show = true"
        >
    </div>

    <!-- Search Results Dropdown -->
    @if(strlen($search) > 1)
        <div class="absolute top-full left-0 right-0 mt-2 bg-white border border-gray-200 rounded-xl shadow-xl z-50 max-h-96 overflow-y-auto" 
             x-show="show" 
             x-transition:enter="transition ease-out duration-100"
             x-transition:enter-start="transform opacity-0 scale-95"
             x-transition:enter-end="transform opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="transform opacity-100 scale-100"
             x-transition:leave-end="transform opacity-0 scale-95">
            
            <div class="p-4">
                @if(auth()->user()->role == "admin" && $users->count() > 0)
                    <div class="mb-6">
                        <h4 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                            Employees
                        </h4>
                        <div class="space-y-1">
                            @foreach($users as $user)
                                <a href="{{route('admin.show.user', $user->id)}}" 
                                   class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors group">
                                    <img class="h-10 w-10 object-cover rounded-full border-2 border-gray-200" src="{{ asset($user->image) }}"/>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900 group-hover:text-slate-600">{{$user->name}}</p>
                                        <p class="text-xs text-gray-500">{{$user->role}}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($products->count() > 0)
                    <div class="mb-6">
                        <h4 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            Products
                        </h4>
                        <div class="space-y-1">
                            @foreach($products as $item)
                                <a href="{{route(auth()->user()->role == 'admin' ? 'admin.edit.product' : 'cashier.dashboard', $item->id)}}" 
                                   class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors group">
                                    <img class="h-10 w-10 object-cover rounded-lg border-2 border-gray-200" src="{{$item->image}}"/>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900 group-hover:text-slate-600">{{$item->name}}</p>
                                        <p class="text-xs text-gray-500">GH₵{{ number_format($item->selling_price, 2) }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($products->count() <= 0 && $users->count() <= 0)
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <p class="text-sm text-gray-500">No results found for "<span class="font-medium text-gray-700">{{$search}}</span>"</p>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
