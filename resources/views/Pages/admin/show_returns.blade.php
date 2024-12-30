<x-layout.admin>
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-semibold text-gray-800">
            Returned Orders
        </h2>

        <div>
            <h2 class="text-sm font-medium text-gray-500">Total Returns Cost</h2>
            <p class="text-lg font-bold text-gray-800 mt-2">GH₵{{number_format( $total , 2)}}</p>
        </div>
    </div>

    <table class="min-w-full table-auto mt-4 bg-white">
        <thead class="bg-gray-800 text-white">
        <tr>
            <th class="px-4 py-2  text-left">Date</th>
            <th class="px-4 py-2  text-left">Product</th>
            <th class="px-4 py-2 text-left">Quantity</th>
            <th class="px-4 py-2  text-left">Price at Purchase</th>
            <th class="px-4 py-2 text-left">Total</th>

            <th class="px-4 py-2  text-left">Reason</th>
        </tr>
        </thead>
        <tbody class="divide-y-2 ">
        @forelse($returns as $return)
            <tr class="hover:bg-gray-100 ">
                <td class="p-6">{{ $return->created_at->format('M, d, Y') }}</td>
                <td class="p-6 ">{{ $return->product->name }}</td>
                <td class="px-4 ">{{ $return->quantity }}</td>
                <td class="px-4 ">{{ number_format($return->price_at_purchase, 2) }}</td>
                <td class="px-4 ">
                    {{ number_format(($return->quantity * $return->price_at_purchase * (100 + $return->product->tax_rate) / 100), 2) }}
                    ({{ $return->product->tax_rate }}% tax)
                </td>

                <td class="px-4 py-2  capitalize">{{ $return->reason }}</td>

            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center px-4 py-2 border border-gray-300">
                    No returned orders found.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $returns->links() }}
    </div>
</x-layout.admin>
