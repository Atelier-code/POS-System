<x-layout.admin>
    <div class="container mx-auto h-screen p-6 -mt-[7rem]">
        <!-- Header Section -->
        <div class="flex items-center justify-between pb-4 mb-6 mt-[7rem] border-b border-gray-300">
            <h2 class="text-2xl font-semibold text-gray-800">Add Employee</h2>
            <a href="{{ route('admin.manage.users') }}" class="flex items-center space-x-2 px-5 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>
                <span class="text-lg">Cancel</span>
            </a>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-md p-6">
            <form id="addEmployeeForm" class="flex max-lg:flex-col lg:space-x-8 space-y-4" action="{{ route('admin.store.user') }}" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <!-- Image Upload with Preview -->
                <div class="lg:w-1/2">
                    <label class="block text-gray-700 font-medium mb-3">Profile Picture</label>

                    <!-- Image Preview Area -->
                    <div id="imagePreview" class="flex items-center justify-center w-full h-[15rem] bg-gray-100 rounded-lg border border-gray-300 overflow-hidden mb-4">
                        <span class="text-gray-400" id="placeholderText">No image selected</span>
                    </div>

                    <!-- File Input -->
                    <input type="file" id="imageUpload" class="hidden" name="image" onchange="previewImage(event)">
                    <label for="imageUpload" class="w-32 flex justify-center px-4 py-2 bg-gray-800 text-white rounded-lg cursor-pointer ">
                        Choose File
                    </label>
                </div>

                <!-- User Information Form -->
                <div class="lg:w-1/2 space-y-6">
                    <x-input id="name" label="Name" name="name" type="text" placeholder="John Doe" :required="true" />
                    <x-input label="Email" name="email" type="email" placeholder="john@mail.com" :required="true" id="emailEl" onchange="handleChange()" />
                    <x-input label="Password" name="password" type="text" placeholder="***************" :required="true"  id="passwordEl" disabled="true" />

                    <!-- Role Select Input -->
                    <div>
                        <label for="role" class="text-slate-400 capitalize">Role</label>
                        <select id="role" name="role" class="w-full px-3 py-2 ring-1 ring-slate-200 rounded-md focus:outline-none">
                            <option disabled selected>Select a role</option>
                            <option value="admin">Admin</option>
                            <option value="cashier">Cashier</option>
                        </select>
                    </div>

                    <button type="button" onclick="confirmSubmit()" class="w-full py-3 bg-gray-800 text-white font-semibold rounded-lg ">
                        Save User
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('imagePreview');
            const placeholderText = document.getElementById('placeholderText');
            preview.innerHTML = ''; // Clear existing preview
            placeholderText.style.display = 'none'; // Hide placeholder text

            const file = event.target.files[0];
            if (file) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.className = "w-full h-full object-cover rounded-md";
                preview.appendChild(img);
            }
        }


        function handleChange() {
            const passwordEl = document.getElementById("passwordEl");
            const emailEl = document.getElementById("emailEl");

            // Immediately synchronize the password field as the user types
            emailEl.addEventListener('input', () => {
                passwordEl.value = emailEl.value;
            });

            // Ensure if the user pastes an email in the field, it syncs immediately
            emailEl.addEventListener('paste', () => {
                passwordEl.value = emailEl.value;
            });

        }

        function confirmSubmit() {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action will save the changes!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Save User',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('addEmployeeForm').submit(); // Submit the form after confirmation
                }
            });
        }
    </script>

    <div>
        <!-- Your form and other content -->

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        title: 'Success!',
                        text:  "{{ session('success') }}",
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
                        showConfirmButton: false // Hides the "OK" button
                    });
                });
            </script>
        @endif
    </div>
</x-layout.admin>
