<x-layout.cashier>
    <div class=" bg-white">
        <div class="w-full flex flex-col xl:flex-row">
            <!-- Profile Image Section -->
            <div class="xl:w-1/3 w-full p-2">
                <img src="{{ asset(auth()->user()->image) }}" alt="User Image" class="object-cover mx-auto rounded-full w-[20rem] h-[20rem] mt-[4rem]">
            </div>

            <!-- User Details Section -->
            <div class="xl:mt-10 xl:w-2/3 xl:ml-[5.5rem]">
                <form>
                    <h1 class="text-3xl font-bold mb-5">User Details</h1>

                    <!-- Name -->
                    <div class="w-80 mb-2">
                        <label class="text-gray-600 font-semibold">Name</label>
                        <input
                            disabled
                            value="{{ old('name', auth()->user()->name) }}"
                            class="w-full border border-gray-200 p-2 rounded-md focus:outline-none"
                            type="text"
                        />
                    </div>

                    <!-- Email -->
                    <div class="w-full xl:flex gap-x-4 items-center">
                        <div class="w-80">
                            <label class="text-gray-600 font-semibold">Email</label>
                            <input
                                disabled
                                value="{{ old('email', auth()->user()->email) }}"
                                class="w-full border border-gray-200 p-2 rounded-md focus:outline-none"
                                type="email"
                            />
                        </div>

                        <!-- Role -->
                        <div class="w-80">
                            <label class="text-gray-600 font-semibold">Role</label>
                            <input
                                disabled
                                value="{{ old('email', auth()->user()->role) }}"
                                class="w-full border border-gray-200 p-2 rounded-md focus:outline-none"
                            />
                        </div>
                    </div>
                </form>

                <!-- Password Change Section -->
                <div class="mt-10 mb-4">
                    <h1 class="text-3xl font-bold mb-5">Change Password</h1>
                    <form id="editForm" action="{{route('cashier.resetPassword')}}" method="post">
                        @csrf
                        <!-- Old Password -->
                        <div class="w-80 mb-2">
                            <label class="text-gray-600 font-semibold">Old Password</label>
                            <input
                                name="current_password"
                                class="w-full border border-gray-200 p-2 rounded-md focus:outline-none"
                                type="password"
                            />
                            @error('current_password')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="w-80 mb-2">
                            <label class="text-gray-600 font-semibold">New Password</label>
                            <input
                                name="password"
                                class="w-full border border-gray-200 p-2 rounded-md focus:outline-none"
                                type="password"
                                required
                            />
                            @error('password')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="w-80 mb-2">
                            <label class="text-gray-600 font-semibold">Confirm Password</label>
                            <input
                                name="password_confirmation"
                                class="w-full border border-gray-200 p-2 rounded-md focus:outline-none"
                                type="password"
                                required
                            />
                            @error('password_confirmation')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Change Password Button -->
                        <button type="button" onclick="confirmSubmit()" class="p-2 bg-black text-white rounded-md mt-2 w-[10rem]">
                            Change Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmSubmit() {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action will save the changes!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Save Changes',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('editForm').submit(); // Submit the form after confirmation
                }
            });
        }
    </script>

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
                    title: 'Error!',
                    text: "{{ session('error') }}",
                    icon: 'error',
                    timer: 3000, // Closes the alert after 3 seconds (3000 ms)
                    timerProgressBar: true, // Displays a progress bar
                    showConfirmButton: true // Shows the "OK" button
                });
            });
        </script>
    @endif
</x-layout.cashier>
