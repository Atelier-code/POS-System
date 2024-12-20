<x-layout.admin>
    <div class="container mx-auto">
        <div class="flex items-center justify-between p-2 mb-5">
            <h2 class="text-2xl font-semibold text-gray-800">User List</h2>

            <a href="{{route('admin.create.users')}}" class="p-2 bg-gray-800 text-white rounded-md px-5 flex items-center space-x-2 run dev">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle font-bold" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                </svg>
                <span class="text-xl">Add</span>
            </a>
        </div>

        <!-- User Table -->
        <div class="overflow-x-auto w-full xl:h-[35rem] rounded-lg scrollcustom ">
            <table class="w-full bg-white border border-gray-200 rounded-lg shadow-md ">
                <thead class="bg-gray-800 ">
                <tr>
                    <th class="py-4 px-6 text-left text-sm font-semibold text-white">Employee</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold text-white">Email</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold text-white">Role</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold text-white">Created At</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold text-white">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @foreach($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="py-4 px-6 text-sm text-gray-800 flex items-center space-x-4">
                            <img src="{{ asset($user->image) }}" alt="{{ $user->name }}" class="w-10 h-10 object-cover rounded-full border border-gray-300">
                            <span> {{ $user->name }}</span>
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-600">{{ $user->email }}</td>
                        <td class="py-4 px-6 text-sm text-gray-600">{{ ucfirst($user->role) }}</td>
                        <td class="py-4 px-6 text-sm text-gray-600">{{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y') }}</td>

                        <td class="py-4 px-6 ">
                           <a href="{{route('admin.show.user', $user->id)}}" class="p-2 bg-gray-800 w-full rounded-md text-white ">
                               View
                           </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    timer: 3000, // Closes the alert after 3 seconds (3000 ms)
                    timerProgressBar: true, // Displays a progress bar
                    showConfirmButton: false // Hides the "OK" button
                });
            });
        </script>
    @elseif(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('error') }}",
                    icon: 'error',
                    timer: 3000, // Closes the alert after 3 seconds (3000 ms)
                    timerProgressBar: true, // Displays a progress bar
                    showConfirmButton: false // Hides the "OK" button
                });
            });
        </script>
    @endif
</x-layout.admin>
