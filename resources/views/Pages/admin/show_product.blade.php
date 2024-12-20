<x-layout.admin>
    <!-- Header Section -->
    <div class="flex items-center justify-between pb-4 border-b border-gray-300">
        <h2 class="text-2xl font-semibold text-gray-800">View Product</h2>
        <a href="{{ route('admin.manage.products') }}" class="flex items-center space-x-2 px-5 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
            </svg>
            <span class="text-lg">Back</span>
        </a>
    </div>

    <!-- Product Details Section -->
    <div class="w-full flex items-start space-x-6 mt-6">
        <!-- Product Image and Info -->
        <div class="w-1/3 bg-white rounded-md p-1">
            <img src="{{$product->image}}" class="w-full h-64 object-cover rounded-md shadow-md">
            <div class="mt-4 space-y-2">
                <h3 class="text-xl font-semibold text-gray-800">{{$product->name}}</h3>
                <p class="text-lg text-gray-600 ">Price: <span class="font-medium text-gray-900">{{$product->selling_price}}</span></p>
                <p class="text-sm text-gray-500">Cost Price: {{$product->cost_price}}</p>
                <p class="text-sm text-gray-500 ">Tax Rate: {{$product->tax_rate}}%</p>
                <p class="text-sm text-gray-500 ">{{$product->quantity}} left in stock</p>
            </div>
            <!-- Edit Button -->
            <a href="{{route('admin.edit.product', $product->id)}}" class="mt-4 inline-block px-4 py-2 bg-gray-800 text-white rounded-md ">
                Edit Product
            </a>
        </div>

        <!-- Additional Info Section -->
        <div class="w-2/3 bg-white rounded-md p-5">
            <livewire:product-performance/>
        </div>
    </div>
</x-layout.admin>
