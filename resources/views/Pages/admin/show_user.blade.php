<x-layout.admin>
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Employee Details</h1>
                <p class="text-gray-600 mt-1">View employee information and performance</p>
            </div>

            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.edit.user', $user->id) }}" class="inline-flex items-center px-4 py-2 bg-slate-600 hover:bg-slate-700 text-white font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Employee
                </a>
                <a href="{{ route('admin.manage.users') }}" class="inline-flex items-center px-4 py-2 text-gray-600 hover:text-gray-900 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Users
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <!-- Employee Profile Card -->
            <div class="xl:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <!-- Profile Header -->
                    <div class="bg-gradient-to-r from-slate-600 to-slate-700 h-32 relative">
                        <div class="absolute -bottom-12 left-6">
                            <div class="relative">
                                <img src="{{ asset($user->image) }}"
                                     alt="{{ $user->name }}"
                                     class="w-24 h-24 rounded-full border-4 border-white object-cover shadow-lg">
                                <!-- Online indicator -->
                                <div class="absolute bottom-1 right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Content -->
                    <div class="pt-16 pb-6 px-6">
                        <div class="text-center mb-6">
                            <h3 class="text-xl font-bold text-gray-900">{{ $user->name }}</h3>
                            <div class="flex items-center justify-center mt-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                            <p class="text-gray-600 mt-2">{{ $user->email }}</p>
                            <p class="text-sm text-gray-500 mt-1">
                                Joined {{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}
                            </p>
                        </div>

                        <!-- Employee Stats -->
                        <div class="w-full">
                            <livewire:rank-card id="{{$user->id}}"/>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Employee Performance & Details -->
            <div class="xl:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Performance & Activity</h3>
                        <p class="text-sm text-gray-600 mt-1">Employee sales and performance data</p>
                    </div>
                    <div class="p">
                        <livewire:employee-sales id="{{$user->id}}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.admin>
