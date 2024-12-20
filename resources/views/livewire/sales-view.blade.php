<div class="mx-auto px-6 w-full">

    <div class="w-full flex flex-wrap items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800 w-full md:w-auto">Employee Sales</h2>

        <!-- Filter Section -->
        <div class="flex flex-wrap space-x-4 items-center w-full md:w-auto mt-4 md:mt-0">
            <!-- Start Date -->
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <label for="startDate" class="block text-sm font-semibold text-gray-700">Start Date:</label>
                <input type="date" id="startDate" wire:model="startDate" class="p-2 border rounded-md w-full sm:w-auto" />
            </div>

            <!-- End Date -->
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <label for="endDate" class="block text-sm font-semibold text-gray-700">End Date:</label>
                <input type="date" id="endDate" wire:model="endDate" class="p-2 border rounded-md w-full sm:w-auto" />
            </div>

            <!-- Filter Button -->
            <button wire:click="filterSales" class="py-2 px-4 bg-black text-white rounded-md mt-4 sm:mt-0">Filter</button>

            <!-- Clear Filter Button -->
            <button wire:click="clearFilter" class="py-2 px-4 bg-gray-400 text-white rounded-md mt-4 sm:mt-0">Clear Filter</button>
        </div>
    </div>

    <!-- Sales Table -->
    <div class="bg-white rounded-md shadow overflow-x-auto">
        <table class="min-w-full border-separate" style="border-spacing: 0">
            <thead class="bg-gray-800">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-white">Created At</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-white">Total Sales</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-white">Payment Method</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-white">Action</th>
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

                    <td class="px-2 py-2 text-sm text-gray-500 rounded-md"><a href="{{route("admin.show.sale", $sale->id)}}">View Sale</a></td>
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
        {{ $sales->links() }}
    </div>
</div>
