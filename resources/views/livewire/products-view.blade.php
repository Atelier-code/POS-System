<div class="container mx-auto p-3 w-full">

    <div class="w-96 flex border border-gray-800 rounded-md overflow-hidden bg-gray-800">
        <!-- Button for Low Stock -->
        <button wire:click="setViewType('all')" class="flex-1 py-2 px-4 text-sm text-gray-300 hover:bg-gray-700 focus:bg-gray-600">
            All Products
        </button>
        <button wire:click="setViewType('lowStock')" class="flex-1 py-2 px-4 text-sm text-gray-300 hover:bg-gray-700 focus:bg-gray-600">
            Low Stock
        </button>
        <!-- Button for Top Sellers -->
        <button wire:click="setViewType('top')" class="flex-1 py-2 px-4 text-sm text-gray-300 hover:bg-gray-700 focus:bg-gray-600">
            Week Hits
        </button>
        <!-- Button for Recently Added -->
        <button wire:click="setViewType('recentlyAdded')" class="flex-1 py-2 px-4 text-sm text-gray-300 hover:bg-gray-700 focus:bg-gray-600">
            Recently Added
        </button>
    </div>

    <table class="min-w-full bg-white rounded-md overflow-hidden mt-5">
        <thead class="bg-gray-800 text-white">
        <tr>
            <th class="py-3 px-4 text-left">Image</th>
            <th class="py-3 px-4 text-left">Name</th>
            <th class="py-3 px-4 text-left">Cost Price</th>
            <th class="py-3 px-4 text-left">Selling Price</th>
            <th class="py-3 px-4 text-left">Quantity</th>
            <th class="py-3 px-4 text-left">Tax Rate</th>
            <th class="py-3 px-4 text-left">Actions</th>
        </tr>
        </thead>
        <tbody class="text-gray-700">
        @if($products && $products->isNotEmpty())
            @foreach ($products as $product)
                <tr class="border-t border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-4">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-md">
                    </td>
                    <td class="py-3 px-4 text-xl">{{ $product->name }} @if($product->quantity <= $product->low_stock) <div class="text-red-500 text-sm">low stock alert</div> @else <div class="text-green-500 text-sm">Product in stock</div>  @endif</td>
                    <td class="py-3 px-4">GH₵{{ number_format($product->cost_price, 2) }}</td>
                    <td class="py-3 px-4">GH₵{{ number_format($product->selling_price, 2) }}</td>
                    <td class="py-3 px-4">{{ $product->quantity }}</td>
                    <td class="py-3 px-4">{{ $product->tax_rate }}%</td>
                    <td class="py-3 px-4">
                        <a href="{{route('admin.edit.product', $product->id)}}" class="p-2 bg-gray-800 w-full rounded-md text-white">
                            View
                        </a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-center py-4">Nothing to see here</td>
            </tr>
        @endif
        </tbody>
    </table>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
