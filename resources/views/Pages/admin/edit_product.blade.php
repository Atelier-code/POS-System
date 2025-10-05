<x-layout.admin>
    <div class="container mx-auto px-6 py-4">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Product</h1>
                    <p class="mt-2 text-gray-600">Update product information and settings</p>
                </div>
                <div class="flex items-center gap-3">
                    <button onclick="confirmDelete()" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete Product
                    </button>
                    <a href="{{ route('admin.manage.products') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-xl  border border-gray-100 overflow-hidden">
            <form action="{{ route('admin.update.product', $product->id) }}" method="POST" enctype="multipart/form-data" id="editForm">
                @method('PUT')
                @csrf

                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Image Upload Section -->
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">Product Image</label>
                                <div id="imagePreview" class="relative flex items-center justify-center w-full h-64 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300 overflow-hidden group hover:border-blue-400 transition-colors duration-200">
                                    @if ($product->image)
                                        <img src="{{ asset($product->image) }}" class="w-full h-full object-cover rounded-xl" alt="{{ $product->name }}" id="currentImage">
                                    @else
                                        <div class="text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-600" id="placeholderText">Click to upload an image</p>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-200 rounded-xl flex items-center justify-center opacity-0 group-hover:opacity-100">
                                        <span class="text-white font-medium">Change Image</span>
                                    </div>
                                </div>
                                <input type="file" id="imageUpload" class="hidden" name="image" onchange="previewImage(event)" accept="image/*">
                                <button type="button" for="imageUpload" onclick="document.getElementById('imageUpload').click()" class="mt-3 w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Choose New Image
                                </button>
                            </div>
                        </div>

                        <!-- Product Information Form -->
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Product Name</label>
                                <input type="text" id="name" name="name" value="{{ $product->name }}" placeholder="Enter product name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" required>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="cost_price" class="block text-sm font-semibold text-gray-700 mb-2">Cost Price (GH₵)</label>
                                    <input type="number" id="cost_price" name="cost_price" value="{{ $product->cost_price }}" step="0.01" min="0" placeholder="0.00" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" required>
                                </div>
                                <div>
                                    <label for="selling_price" class="block text-sm font-semibold text-gray-700 mb-2">Selling Price (GH₵)</label>
                                    <input type="number" id="selling_price" name="selling_price" value="{{ $product->selling_price }}" step="0.01" min="0" placeholder="0.00" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" required>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="quantity" class="block text-sm font-semibold text-gray-700 mb-2">Stock Quantity</label>
                                    <input type="number" id="quantity" name="quantity" value="{{ $product->quantity }}" min="0" step="1" placeholder="0" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" required>
                                </div>
                                <div>
                                    <label for="tax_rate" class="block text-sm font-semibold text-gray-700 mb-2">Tax Rate (%)</label>
                                    <input type="number" id="tax_rate" name="tax_rate" value="{{ $product->tax_rate }}" step="0.01" min="0" max="100" placeholder="0.00" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" required>
                                </div>
                            </div>

                            <div>
                                <label for="low_stock" class="block text-sm font-semibold text-gray-700 mb-2">Low Stock Alert</label>
                                <input type="number" id="low_stock" name="low_stock" value="{{ $product->low_stock }}" min="0" step="1" placeholder="0" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" required>
                                <p class="mt-1 text-sm text-gray-500">Set the minimum stock level to trigger low stock alerts</p>
                            </div>

                            <!-- Profit Preview - FIXED CALCULATION -->
                            @php
                                $profit = $product->selling_price - $product->cost_price;
                                // CORRECT: Profit Margin = (Profit / Selling Price) * 100
                                $margin = $product->selling_price > 0 ? ($profit / $product->selling_price) * 100 : 0;
                            @endphp
                            <div class="profit-preview bg-gradient-to-r from-blue-50 to-green-50 rounded-lg p-4">
                                <h4 class="text-sm font-semibold text-gray-700 mb-2">Profit Preview</h4>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Profit per Unit:</span>
                                    <span class="profit-amount font-semibold {{ $profit >= 0 ? 'text-green-600' : 'text-red-600' }}">GH₵{{ number_format($profit, 2) }}</span>
                                </div>
                                <div class="flex items-center justify-between mt-1">
                                    <span class="text-gray-600">Profit Margin:</span>
                                    <span class="margin-amount font-semibold {{ $margin >= 0 ? 'text-green-600' : 'text-red-600' }}">{{ number_format($margin, 2) }}%</span>
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
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Product
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

        function confirmDelete() {
            Swal.fire({
                title: 'Delete Product?',
                text: "This action cannot be undone! All product data will be permanently removed.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('admin.destroy.product', $product->id) }}";
                }
            });
        }

        // Add event listeners for real-time calculation
        document.addEventListener('DOMContentLoaded', function() {
            const costPriceInput = document.getElementById('cost_price');
            const sellingPriceInput = document.getElementById('selling_price');

            // Real-time profit calculation - FIXED FORMULA
            function calculateProfit() {
                const costPrice = parseFloat(costPriceInput.value) || 0;
                const sellingPrice = parseFloat(sellingPriceInput.value) || 0;
                const profit = sellingPrice - costPrice;

                // CORRECT FORMULA: Profit Margin = (Profit / Selling Price) * 100
                const margin = sellingPrice > 0 ? (profit / sellingPrice) * 100 : 0;

                // Update profit preview
                const profitSpan = document.querySelector('.profit-amount');
                const marginSpan = document.querySelector('.margin-amount');

                if (profitSpan) {
                    profitSpan.textContent = `GH₵${profit.toFixed(2)}`;
                    profitSpan.className = `profit-amount font-semibold ${profit >= 0 ? 'text-green-600' : 'text-red-600'}`;
                }

                if (marginSpan) {
                    marginSpan.textContent = `${margin.toFixed(2)}%`;
                    marginSpan.className = `margin-amount font-semibold ${margin >= 0 ? 'text-green-600' : 'text-red-600'}`;
                }
            }

            // Attach event listeners
            if (costPriceInput && sellingPriceInput) {
                costPriceInput.addEventListener('input', calculateProfit);
                sellingPriceInput.addEventListener('input', calculateProfit);
                costPriceInput.addEventListener('change', calculateProfit);
                sellingPriceInput.addEventListener('change', calculateProfit);
            }
        });

        function confirmSubmit() {
            Swal.fire({
                title: 'Update Product?',
                text: "Are you sure you want to save these changes?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, update it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('editForm').submit();
                }
            });
        }

        // Form submission handler
        document.getElementById('editForm').addEventListener('submit', function (event) {
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
