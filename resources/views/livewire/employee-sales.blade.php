<div class=" mx-auto p-6  w-full">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Employee Sales</h2>

    <div class="bg-white rounded-md shadow overflow-x-auto">
        <table class="min-w-full border-separate" style="border-spacing: 0">
            <thead class="bg-gray-800">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-white">Created At</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-white">Total Sales</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-white">Payment Method</th>
                @if(auth()->user()->role =="admin") <th class="px-6 py-3 text-left text-sm font-semibold text-white">Action</th>@endif
            </tr>
            </thead>
            <tbody class="bg-white">
            @forelse($sales as $sale)
                <tr class="border-b last:border-0">
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $sale->created_at->format('M d, Y h:i A') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">GH₵{{ number_format($sale->total, 2) }}</td>
                    <td class="px-6 py-4 text-sm">
                        @if($sale->payment_method === 'cash')
                            <span class="bg-green-600 p-2 rounded-md text-white">Cash</span>
                        @elseif($sale->payment_method === 'card')
                            <span class="bg-blue-600 p-2 rounded-md text-white">Card</span>
                        @else
                            <span class="bg-yellow-600 p-2 rounded-md text-white">Mobile</span>
                        @endif
                    </td>
                    <td>@if(auth()->user()->role =="admin")<a href="{{route("admin.show.sale", $sale ->id)}}" class="text-gray-500">View</a> @endif</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">No sales records found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Controls -->
    <div class="mt-6">
        {{ $sales->links('pagination::tailwind') }}
    </div>
</div>
