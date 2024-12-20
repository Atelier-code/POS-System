<x-layout.admin>
    <div class="min-h-screen flex">
        <!-- Sidebar Section -->
        <aside class="w-1/4 bg-gray-100 p-2">
{{--            <h1 class="text-2xl font-bold mb-6">Sale Details</h1>--}}
            <div class="space-y-4">
                <!-- Card 1 -->
                <div class="bg-white rounded-lg p-4 flex items-center shadow-sm">
                    <div class="flex-grow">
                        <h2 class="text-sm font-medium text-gray-500">Sale ID</h2>
                        <p class="text-xl font-bold text-gray-800 mt-2">{{ $sale->id }}</p>
                    </div>

                </div>
                <!-- Card 2 -->
                <div class="bg-white rounded-lg p-4 flex items-center shadow-sm">
                    <div class="flex-grow">
                        <h2 class="text-sm font-medium text-gray-500">VAT</h2>
                        <p class="text-2xl font-bold text-gray-800 mt-2">GH₵{{ number_format($sale->vat, 2) }}</p>
                    </div>

                </div>
                <!-- Card 3 -->
                <div class="bg-white rounded-lg p-4 flex items-center shadow-sm">
                    <div class="flex-grow">
                        <h2 class="text-sm font-medium text-gray-500">Sub Total</h2>
                        <p class="text-2xl font-bold text-gray-800 mt-2">GH₵{{ number_format($sale->sub_total, 2) }}</p>
                    </div>

                </div>
                <!-- Card 4 -->
                <div class="bg-white rounded-lg p-4 flex items-center shadow-sm">
                    <div class="flex-grow">
                        <h2 class="text-sm font-medium text-gray-500">Total</h2>
                        <p class="text-2xl font-bold text-gray-800 mt-2">GH₵{{ number_format($sale->total, 2) }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow bg-white p-6">
            <h2 class="text-2xl font-semibold mb-4">Sale Items</h2>
            <table class="w-full border-collapse overflow-hidden">
                <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="text-left px-6 py-3">Product</th>
                    <th class="text-center px-6 py-3">Quantity</th>
                    <th class="text-right px-6 py-3">Price at Purchase (GH₵)</th>
                    <th class="text-right px-6 py-3">Subtotal (GH₵)</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($sale->saleItem as $item)
                    <tr class="{{ $loop->odd ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100">
                        <td class="px-6 py-3">{{ $item->product->name }}</td>
                        <td class="text-center px-6 py-3">{{ $item->quantity }}</td>
                        <td class="text-right px-6 py-3">{{ number_format($item->price_at_purchase, 2) }}</td>
                        <td class="text-right px-6 py-3">
                            {{ number_format($item->quantity * $item->price_at_purchase, 2) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr class="bg-gray-100 font-semibold">
                    <td colspan="3" class="text-right px-6 py-3">Total:</td>
                    <td class="text-right px-6 py-3">GH₵{{ number_format($sale->total, 2) }}</td>
                </tr>
                </tfoot>
            </table>
        </main>
    </div>
</x-layout.admin>
