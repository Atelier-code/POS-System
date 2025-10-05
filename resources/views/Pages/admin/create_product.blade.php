<x-layout.admin>
    <div class="container mx-auto px-6 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Add New Product</h1>
                    <p class="mt-2 text-gray-600">Create a new product and add it to your inventory</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{route('admin.manage.products')}}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <form id="productForm" action="{{route('admin.store.products')}}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Image Upload Section -->
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">Product Image</label>
                                <div id="imagePreview" class="relative flex items-center justify-center w-full h-64 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300 overflow-hidden group hover:border-blue-400 transition-colors duration-200">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-600" id="placeholderText">Click to upload an image</p>
                                        <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 10MB</p>
                                    </div>
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-200 rounded-xl flex items-center justify-center opacity-0 group-hover:opacity-100">
                                        <span class="text-white font-medium">Upload Image</span>
                                    </div>
                                </div>
                                <input type="file" id="imageUpload" class="hidden" name="image" onchange="previewImage(event)" accept="image/*">
                                <button type="button" onclick="document.getElementById('imageUpload').click()" class="mt-3 w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Choose Image
                                </button>
                            </div>
                        </div>

                        <!-- Product Information Form -->
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Product Name *</label>
                                <input type="text" id="name" name="name" placeholder="Enter product name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" required>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="cost_price" class="block text-sm font-semibold text-gray-700 mb-2">Cost Price (GH₵) *</label>
                                    <input type="number" id="cost_price" name="cost_price" step="0.01" placeholder="0.00" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" required>
                                </div>
                                <div>
                                    <label for="selling_price" class="block text-sm font-semibold text-gray-700 mb-2">Selling Price (GH₵) *</label>
                                    <input type="number" id="selling_price" name="selling_price" step="0.01" placeholder="0.00" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" required>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="quantity" class="block text-sm font-semibold text-gray-700 mb-2">Stock Quantity *</label>
                                    <input type="number" id="quantity" name="quantity" placeholder="0" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" required>
                                </div>
                                <div>
                                    <label for="tax_rate" class="block text-sm font-semibold text-gray-700 mb-2">Tax Rate (%) *</label>
                                    <input type="number" id="tax_rate" name="tax_rate" step="0.01" placeholder="0.00" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" required>
                                </div>
                            </div>

                            <div>
                                <label for="low_stock" class="block text-sm font-semibold text-gray-700 mb-2">Low Stock Alert *</label>
                                <input type="number" id="low_stock" name="low_stock" placeholder="0" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" required>
                                <p class="mt-1 text-sm text-gray-500">Set the minimum stock level to trigger low stock alerts</p>
                            </div>

                            <!-- Profit Preview -->
                            <div class="profit-preview bg-gradient-to-r from-blue-50 to-green-50 rounded-lg p-4">
                                <h4 class="text-sm font-semibold text-gray-700 mb-2">Profit Preview</h4>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Profit per Unit:</span>
                                    <span class="profit-amount font-semibold text-gray-600">GH₵0.00</span>
                                </div>
                                <div class="flex items-center justify-between mt-1">
                                    <span class="text-gray-600">Margin:</span>
                                    <span class="margin-amount font-semibold text-gray-600">0.0%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="bg-gray-50 px-8 py-6 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-3">
                        <a href="{{ route('admin.manage.products') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Create Product
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('imagePreview');
            const file = event.target.files[0];
            
            if (file) {
                // Clear existing content
                preview.innerHTML = '';
                
                // Create new image element
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.className = "w-full h-full object-cover rounded-xl";
                preview.appendChild(img);
            }
        }

        // Real-time profit calculation
        function calculateProfit() {
            const costPrice = parseFloat(document.getElementById('cost_price').value) || 0;
            const sellingPrice = parseFloat(document.getElementById('selling_price').value) || 0;
            const profit = sellingPrice - costPrice;
            const margin = costPrice > 0 ? (profit / costPrice) * 100 : 0;
            
            // Update profit preview
            const profitSpan = document.querySelector('.profit-amount');
            const marginSpan = document.querySelector('.margin-amount');
            
            if (profitSpan) {
                profitSpan.textContent = `GH₵${profit.toFixed(2)}`;
                profitSpan.className = `profit-amount font-semibold ${profit >= 0 ? 'text-green-600' : 'text-red-600'}`;
            }
            
            if (marginSpan) {
                marginSpan.textContent = `${margin.toFixed(1)}%`;
                marginSpan.className = `margin-amount font-semibold ${margin >= 0 ? 'text-green-600' : 'text-red-600'}`;
            }
        }

        // Add event listeners for real-time calculation
        document.addEventListener('DOMContentLoaded', function() {
            const costPriceInput = document.getElementById('cost_price');
            const sellingPriceInput = document.getElementById('selling_price');
            
            if (costPriceInput && sellingPriceInput) {
                costPriceInput.addEventListener('input', calculateProfit);
                sellingPriceInput.addEventListener('input', calculateProfit);
            }
        });

        function confirmSubmit() {
            Swal.fire({
                title: 'Create Product?',
                text: "Are you sure you want to create this product?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#059669',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, create it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('productForm').submit();
                }
            });
        }

        // Form submission handler
        document.getElementById('productForm').addEventListener('submit', function (event) {
            event.preventDefault();
            confirmSubmit();
        });
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
