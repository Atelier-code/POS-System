<x-layout.admin>
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                <p class="mt-2 text-gray-600">Product Details & Analytics</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{route('admin.edit.product', $product->id)}}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Product
                </a>
                <a href="{{ route('admin.manage.products') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Products
                </a>
            </div>
        </div>
    </div>

    <!-- Product Details Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Product Information Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                <!-- Product Image -->
                <div class="relative h-64 bg-gray-100">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    <!-- Stock Status Badge -->
                    <div class="absolute top-4 right-4">
                        @if($product->quantity <= $product->low_stock)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                Low Stock
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                In Stock
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Product Details -->
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $product->name }}</h2>
                    
                    <!-- Price Information -->
                    <div class="space-y-4 mb-6">
                        <div class="flex items-center justify-between py-3 px-4 bg-gray-50 rounded-lg">
                            <span class="text-gray-600 font-medium">Selling Price</span>
                            <span class="text-2xl font-bold text-gray-900">GH₵{{ number_format($product->selling_price, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-4">
                            <span class="text-gray-600">Cost Price</span>
                            <span class="text-lg font-semibold text-gray-700">GH₵{{ number_format($product->cost_price, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-4">
                            <span class="text-gray-600">Tax Rate</span>
                            <span class="text-lg font-semibold text-gray-700">{{ $product->tax_rate }}%</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-4">
                            <span class="text-gray-600">Stock Quantity</span>
                            <span class="text-lg font-semibold text-gray-700">{{ $product->quantity }} units</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-4">
                            <span class="text-gray-600">Low Stock Alert</span>
                            <span class="text-lg font-semibold text-gray-700">{{ $product->low_stock }} units</span>
                        </div>
                    </div>

                    <!-- Profit Information -->
                    @php
                        $profit = $product->selling_price - $product->cost_price;
                        $margin = $product->cost_price > 0 ? ($profit / $product->cost_price) * 100 : 0;
                    @endphp
                    <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-lg p-4 mb-6">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium">Profit Margin</span>
                            <span class="text-xl font-bold {{ $margin >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ number_format($margin, 1) }}%
                            </span>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <span class="text-gray-600">Profit per Unit</span>
                            <span class="text-lg font-semibold {{ $profit >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                GH₵{{ number_format($profit, 2) }}
                            </span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-3">
                        <a href="{{route('admin.edit.product', $product->id)}}" class="w-full inline-flex items-center justify-center px-4 py-3 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Product
                        </a>
                        <a href="{{ route('admin.manage.products') }}" class="w-full inline-flex items-center justify-center px-4 py-3 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Products
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics Section -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Product Performance Analytics
                    </h3>
                    <p class="text-gray-600 mt-1">Sales data and performance metrics for this product</p>
                </div>
                <div class="p-6">
                    <livewire:product-performance :product="$product"/>
                </div>
            </div>
        </div>
    </div>
</x-layout.admin>
