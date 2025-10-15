<div class="container mx-auto p-4 w-full">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <!-- Filter Buttons -->
            <div class="flex flex-wrap gap-2">
                <button
                    wire:click="setViewType('all')"
                    class="filter-button px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ $viewType === 'all' ? 'bg-gray-600 text-white shadow-lg' : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50' }}"
                >
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
            All Products
        </button>
                <button
                    wire:click="setViewType('lowStock')"
                    class="filter-button px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ $viewType === 'lowStock' ? 'bg-red-600 text-white shadow-lg' : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50' }}"
                >
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                    Low Stock
                </button>
                <button
                    wire:click="setViewType('top')"
                    class="filter-button px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ $viewType === 'top' ? 'bg-green-600 text-white shadow-lg' : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50' }}"
                >
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    Top Sellers
                </button>



            </div>

            <div class="flex items-center gap-x-4">
                <livewire:export-products-data/>
                <a href="{{route('admin.create.products')}}" class="flex items-center gap-2 bg-black text-white filter-button px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle font-bold" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                    </svg>
                    Add Product
                </a>
            </div>

        </div>


    </div>

    <!-- Results Info -->
    @if($products && $products->isNotEmpty())
        <div class="mb-4 flex items-center justify-between">
            <div class="text-sm text-gray-600">
                @if($search)
                    Showing {{ $products->count() }} results for "{{ $search }}"
                @else
                    Showing {{ $products->count() }} products
                @endif
                @if($viewType !== 'all')
                    in {{ ucfirst(str_replace('_', ' ', $viewType)) }}
                @endif
            </div>
        </div>
    @endif

    <!-- Products Grid -->
    @if($products && $products->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="product-card bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                    <!-- Product Image -->
                    <div class="relative h-48 bg-gray-100">
                        <img
                            src="{{ $product->image }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover"
                        >
                        <!-- Stock Status Badge -->
                        <div class="absolute top-3 right-3">
                            @if($product->quantity <= $product->low_stock)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    Low Stock
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    In Stock
                                </span>
                            @endif
                        </div>
                        <!-- Quantity Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $product->quantity }} units
                            </span>
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">{{ $product->name }}</h3>

                        <!-- Price Information -->
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Selling Price:</span>
                                <span class="text-lg font-bold text-gray-900">GH₵{{ number_format($product->selling_price, 2) }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Cost Price:</span>
                                <span class="text-sm text-gray-600">GH₵{{ number_format($product->cost_price, 2) }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Tax Rate:</span>
                                <span class="text-sm text-gray-600">{{ $product->tax_rate }}%</span>
                            </div>
                        </div>

                        <!-- Profit Margin -->
                        @php
                            $profit = $product->selling_price - $product->cost_price;
                            $margin = $product->cost_price > 0 ? ($profit / $product->cost_price) * 100 : 0;
                        @endphp
                        <div class="mb-4">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Profit Margin:</span>
                                <span class="font-medium {{ $margin >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ number_format($margin, 1) }}%
                                </span>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <a
                            href="{{route('admin.edit.product', $product->id)}}"
                            class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out"
                        >
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No products found</h3>
            <p class="text-gray-500 mb-6">Try adjusting your filters or search terms to find what you're looking for.</p>
            <button
                wire:click="setViewType('all')"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Reset Filters
            </button>
        </div>
        @endif

    <!-- Pagination -->
    @if($products && $products->hasPages())
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mt-8">
        {{ $products->links() }}
         </div>
    @endif
</div>
