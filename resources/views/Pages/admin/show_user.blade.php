<x-layout.admin>
    <div class="flex items-center justify-between pb-6 mb-8 border-b border-gray-200">
        <h2 class="text-2xl font-semibold text-gray-800">View Employee</h2>
        <a href="{{ route('admin.manage.users') }}" class="flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition ease-in-out duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"/>
            </svg>
            <span class="ml-2">Back</span>
        </a>
    </div>

    <div class="container flex mx-auto mt-8 gap-6 max-xl:flex-col">
        <!-- User Info Card -->
        <div class="xl:w-1/3 bg-white rounded-md p-4 relative h-full flex flex-col gap-4">
                <!-- Image Container -->
                <div class="relative bg-slate-100 h-32 w-full rounded-t-md">
                    <img src="{{ asset($user->image) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full border-4 border-white object-cover absolute -bottom-12 left-6">
                </div>

                <!-- User Info -->
                <div class="mt-12 px-6 text-center">
                    <h3 class="text-xl font-semibold text-gray-700">{{ $user->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $user->role }}</p>
                    <p class="mt-2 text-gray-600">{{ $user->email }}</p>
                </div>

                <div class="w-full mt-5">
                    <!-- Rank Card Component -->
                    <livewire:rank-card id="{{$user->id}}"/>
                </div>


                <!-- Edit Button -->
                <a href="{{ route('admin.edit.user', $user->id) }}" class="absolute top-4 right-4 bg-gray-800 text-white p-2 rounded-md flex items-center space-x-1 w-16">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.854a.5.5 0 0 1 .708 0l2.292 2.292a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.639-.639l1-4a.5.5 0 0 1 .131-.233l10-10zm1.5 1.707-1-1L11 2.707l1 1 1.646-1.646z"/>
                    </svg>
                    <span>Edit</span>
                </a>
        </div>


        <!-- Details Section -->
        <div class="xl:w-2/3 bg-white rounded-md p-6">
          <livewire:employee-sales id="{{$user->id}}"/>
        </div>
    </div>
</x-layout.admin>
