<x-layout.admin>
    <div class="container mx-auto h-screen px-6 py-8">
        <!-- Header Section -->
        <div class="flex items-center justify-between pb-4 mb-8 border-b border-gray-300">
            <h2 class="text-3xl font-bold text-gray-900">Product info</h2>

            <div class="flex items-center gap-3">
                <button  onclick="confirmDelete()" class="flex items-center space-x-2 px-4 py-2 bg-red-500 text-white rounded-lg shadow-sm hover:bg-red-600 transition duration-300">
                    <span>Delete </span>
                </button>
                <a href="{{ route('admin.manage.products', $product->id) }}" class="flex items-center space-x-2 px-4 py-2 bg-gray-500 text-white rounded-lg shadow-sm ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                    </svg>
                    <span>Cancel</span>
                </a>
            </div>
        </div>

        <!-- Form Section -->
        <div class="bg-white shadow-lg rounded-lg p-8">
            <form class="lg:flex lg:space-x-8 space-y-6 lg:space-y-0" action="{{ route('admin.update.product', $product->id) }}" method="POST" enctype="multipart/form-data" id="editForm">
                @method('PUT')
                @csrf

                <!-- Image Upload with Preview -->
                <div class="lg:w-1/2">
                    <label class="block text-gray-700 font-semibold mb-2">Product Image</label>
                    <div id="imagePreview" class="flex items-center justify-center w-full h-[15rem] bg-gray-100 rounded-lg border border-gray-300 overflow-hidden mb-4">
                        @if ($product->image)
                            <img src="{{ asset($product->image) }}" class="w-full h-full object-cover rounded-md" alt="{{ $product->name }}" id="currentImage">
                        @else
                            <span class="text-gray-400" id="placeholderText">No image selected</span>
                        @endif
                    </div>
                    <input type="file" id="imageUpload" class="hidden" name="image" onchange="previewImage(event)">
                    <label for="imageUpload" class="block w-32 text-center px-4 py-2 bg-black text-white font-semibold rounded-lg shadow-sm cursor-pointer ">
                        Choose File
                    </label>
                </div>

                <!-- Product Information Form -->
                <div class="lg:w-1/2 space-y-6">
                    <x-input id="name" label="Product Name" name="name" type="text" placeholder="Product Name" value="{{ $product->name }}" />
                    <x-input id="cost_price" label="Cost Price" name="cost_price" type="number" placeholder="0.00" value="{{ $product->cost_price }}" />
                    <x-input id="selling_price" label="Selling Price" name="selling_price" type="number" placeholder="0.00" value="{{ $product->selling_price }}" />
                    <x-input id="quantity" label="Quantity" name="quantity" type="number" placeholder="0" value="{{ $product->quantity }}" />
                    <x-input id="tax_rate" label="Tax Rate (%)" name="tax_rate" type="number" placeholder="0.00" value="{{ $product->tax_rate }}" />
                    <button type="submit" class="w-full py-3 bg-black text-white font-semibold rounded-lg shadow-md ">
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('imagePreview');
            const placeholderText = document.getElementById('placeholderText');
            const currentImage = document.getElementById('currentImage');

            preview.innerHTML = ''; // Clear existing content
            if (placeholderText) placeholderText.style.display = 'none';
            if (currentImage) currentImage.style.display = 'none';

            const file = event.target.files[0];
            if (file) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.className = "w-full h-full object-cover rounded-md";
                preview.appendChild(img);
            }
        }

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
                    window.location.href = "{{ route("admin.destroy.product", $product->id) }}"; // Redirect to the delete route
                }
            });
        }

        document.getElementById('editForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the form from submitting immediately
            confirmSubmit(); // Show the confirmation dialog
        });

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
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
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: true
                });
            });
        </script>
    @endif
</x-layout.admin>
