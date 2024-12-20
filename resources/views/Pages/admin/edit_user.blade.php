<x-layout.admin>
    <div class="container mx-auto h-screen p-6 -mt-[7rem]">
        <!-- Header Section -->
        <div class="flex items-center justify-between pb-4 mb-6 mt-[7rem] border-b border-gray-300">
            <h2 class="text-2xl font-semibold text-gray-800">Edit Employee</h2>

            <div class="flex items-center gap-4">
                <!-- Updated Delete Button -->

                @if($user->id != auth()->id())
                    <button onclick="confirmDelete()" class="flex items-center space-x-2 px-5 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>
                        <span class="text-lg">Delete</span>
                    </button>
                @endif

                <a href="{{ $user->role === 'admin' ? route('admin.manage.users') : route('admin.show.user', $user->id) }}" class="flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"/>
                    </svg>
                    <span class="ml-2">Back</span>
                </a>
            </div>
        </div>

        <!-- Form Section -->
        <div class="rounded-md">
            <form class="flex max-lg:flex-col lg:space-x-8 max-lg:space-y-4" action="{{ route('admin.update.user', $user->id) }}" method="post" enctype="multipart/form-data" id="editForm">
                @method('patch')
                @csrf
                <!-- Image Upload with Preview -->
                <div class="lg:w-1/3 bg-white p-6">
                    <label class="block text-gray-700 font-medium mb-3">Profile Picture</label>

                    <!-- Image Preview Area -->
                    <div id="imagePreview" class="flex items-center justify-center w-full h-[15rem] bg-gray-100 rounded-lg border border-gray-300 overflow-hidden mb-4">
                        @if($user->image)
                            <img src="{{ asset($user->image) }}" alt="Profile Picture" class="w-full h-full object-cover rounded-md">
                        @else
                            <span class="text-gray-400" id="placeholderText">No image selected</span>
                        @endif
                    </div>

                    <!-- File Input -->
                    <input type="file" id="imageUpload" name="image" class="hidden" onchange="previewImage(event)">
                    <label for="imageUpload" class="w-32 flex justify-center px-4 py-2 bg-gray-800 text-white rounded-md cursor-pointer transition">
                        Choose File
                    </label>
                </div>

                <!-- User Information Form -->
                <div class="lg:w-1/2 space-y-6 bg-white p-6">
                    <x-input id="name" label="Name" name="name" type="text" placeholder="John Doe" value="{{ $user->name }}"/>
                    <x-input label="Email" name="email" type="email" placeholder="john@mail.com" value="{{ $user->email }}"/>
                    <x-input label="Change password" name="password" type="text" placeholder="***************" />

                    <!-- Role Select Input -->
                    <div>
                        <label for="role" class="text-slate-400 capitalize">Role</label>
                        <select id="role" name="role" class="w-full px-3 py-2 ring-1 ring-slate-200 p-1 rounded-md focus:outline-none">
                            <option disabled>Select a role</option>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="cashier" {{ $user->role === 'cashier' ? 'selected' : '' }}>Cashier</option>
                        </select>
                    </div>

                    <!-- Save Changes Button (with confirmSubmit function) -->
                    <button type="button" class="w-full py-3 bg-gray-800 text-white font-semibold rounded-lg transition" onclick="confirmSubmit()">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Preview the selected image
        function previewImage(event) {
            const preview = document.getElementById('imagePreview');
            const placeholderText = document.getElementById('placeholderText');
            preview.innerHTML = ''; // Clear existing preview
            if (placeholderText) placeholderText.style.display = 'none'; // Hide placeholder text if it exists

            const file = event.target.files[0];
            if (file) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.className = "w-full h-full object-cover rounded-md";
                preview.appendChild(img);
            }
        }

        // SweetAlert confirmation for delete
        function confirmDelete() {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('admin.destroy.user', $user->id) }}"; // Redirect to the delete route
                }
            });
        }

        // SweetAlert confirmation for form submission (Save Changes)
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

    <div>
        <!-- Success/Error Handling -->
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
    </div>
</x-layout.admin>
