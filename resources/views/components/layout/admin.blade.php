<x-app>

    <div x-data="{
        show:false,
    }" >
        <aside class="w-72 h-screen fixed z-[999] text-white bg-dark flex flex-col items-center p-2 -translate-x-80 lg:translate-x-0  duration-300 transition-all" x-bind:class ="show ? 'translate-x-0': '-translate-x-80'" >

            <div class="flex justify-between items-center space-x-10">
                <a href="/admin/dashboard" class="flex items-center space-x-3 p-3 group">
                    <div class="w-12 h-12 bg-gradient-to-br from-slate-600 to-slate-700 rounded-xl flex items-center justify-center shadow-md group-hover:shadow-lg transition-all duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white group-hover:text-gray-200 transition-colors">MIGHTY JESUS</h1>
                        <p class="text-sm text-gray-300 font-medium">POS System</p>
                    </div>
                </a>

                <button class="bg-gray-600 hover:bg-gray-500 p-2 rounded-lg lg:hidden transition-colors" @click = 'show = false' >
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="w-full p-4 space-y-2">

                <div class="px-3 py-2">
                    <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Navigation</h2>
                </div>

                <div class="space-y-1">
                    <x-nav-link
                        name="Dashboard"
                        :active="request()->is('admin/dashboard')"
                        url="/admin/dashboard"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                        </svg>
                    </x-nav-link>

                    <x-nav-link
                        name="Manage Users"
                        :active="request()->is('admin/users/manage')"
                        url="/admin/users/manage"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </x-nav-link>

                    <x-nav-link
                        name="Products"
                        :active="request()->is('admin/products/manage')"
                        url="/admin/products/manage"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </x-nav-link>

                    <x-nav-link
                        name="Sales"
                        :active="request()->is('admin/sales/manage')"
                        url="/admin/sales/manage"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </x-nav-link>

                    <x-nav-link
                        name="Returns"
                        :active="request()->is('admin/show/returns')"
                        url="/admin/show/returns"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                    </x-nav-link>

                    <x-nav-link
                        name="Reports"
                        :active="request()->is('admin/export-data')"
                        url="/admin/export-data"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                    </x-nav-link>


                </div>

            </div>

            <div class="fixed bottom-5 left-4 right-4 space-y-3">
{{--                <livewire:daily-sale-button/>--}}
                <a href="{{route('logout')}}" class="group flex items-center justify-center w-full px-4 py-3 text-white bg-slate-700 hover:bg-slate-600 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                    <svg class="w-5 h-5 mr-2 group-hover:scale-105 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="font-medium">Logout</span>
                </a>
            </div>

        </aside>


        <div class="lg:ml-72 ">
            <!-- Modern Header -->
            <header class="bg-white border-b border-gray-200 sticky top-0 z-40">
                <div class="flex h-16 items-center justify-between px-6">
                    <!-- Mobile menu button -->
                    <div class="lg:hidden">
                        <button @click="show = true" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Search Bar -->
                    <div class="flex-1 max-w-2xl mx-4">
                        <livewire:search/>
                    </div>

                    <!-- Right side actions -->
                    <div class="flex items-center space-x-4">
                        <!-- Cashier Dashboard Button -->
                        <a href="{{ route('cashier.dashboard') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-slate-600 to-slate-700 hover:from-slate-700 hover:to-slate-800 rounded-lg shadow-sm transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Cashier Dashboard
                        </a>

                        <!-- User Profile Section -->
                        <div class="flex items-center space-x-3 pl-4 border-l border-gray-200">
                            <div class="hidden lg:block text-right">
                                <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500 capitalize">{{ auth()->user()->role }}</p>
                            </div>
                            <div class="relative">
                                <img src="{{asset(auth()->user()->image)}}"
                                     class="w-10 h-10 rounded-full object-cover border-2 border-gray-200 hover:border-slate-400 transition-colors cursor-pointer">
                                <!-- Online indicator -->
                                <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class=" p-5 ">
                {{$slot}}
            </div>
        </div>


    </div>

</x-app>
