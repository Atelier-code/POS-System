<x-layout.admin>
    <div class="container mx-auto h-screen p-6 -mt-[7rem]">
        <!-- Header Section -->
        <div class="flex items-center justify-between pb-4 mb-6 mt-[7rem] border-b border-gray-300">
            <h2 class="text-2xl font-semibold text-gray-800">Add Product</h2>
            <a href="{{route('admin.manage.products')}}" class="flex items-center space-x-2 px-5 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>
                <span class="text-lg">Cancel</span>
            </a>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-md p-6">
            <form id="productForm" class="flex max-lg:flex-col lg:space-x-8 space-y-4" action="{{route('admin.store.products')}}" method="POST" enctype="multipart/form-data" onsubmit="event.preventDefault(); confirmSubmit(this)">
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

                <!-- Product Information Form -->
                <div class="lg:w-1/2 space-y-6">
                    <!-- Product Name -->
                    <x-input id="name" label="Product Name" name="name" type="text" placeholder="Product Name" :required="true" />


                    <div class="flex item-center space-x-2">
                        <!-- Cost Price -->
                        <x-input id="cost_price" label="Cost Price" name="cost_price" type="number" placeholder="0.00" :required="true"  />

                        <!-- Selling Price -->
                        <x-input id="selling_price" label="Selling Price" name="selling_price" type="number" placeholder="0.00" :required="true"/>

                    </div>

                    <div class="flex item-center space-x-2">
                        <!-- Quantity -->
                        <x-input id="quantity" label="Quantity" name="quantity" type="number" placeholder="0" :required="true" />

                        <!-- Tax Rate -->
                        <x-input id="tax_rate" label="Tax Rate (%)" name="tax_rate" type="number" placeholder="0.00" :required="true" />

                    </div>

                    <x-input id="tax_rate" label="Low stock alert" name="low_stock" type="number" placeholder="0" :required="true" />


                    <button type="submit" class="w-full py-3 bg-gray-800 text-white font-semibold rounded-lg ">
                        Save Product
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

        function confirmSubmit(form) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action will save the changes!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Add Product',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit the form after confirmation
                }
            });
        }
    </script>

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
</x-layout.admin>
