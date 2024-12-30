<div class="w-full space-y-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Sale ID Card -->
        <div class="bg-white  rounded-lg p-2 flex items-center space-x-4 ">
            <div class="bg-orange-100 p-4 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-crosshair2 text-orange-500" viewBox="0 0 16 16">
                    <path d="M8 0a.5.5 0 0 1 .5.5v.518A7 7 0 0 1 14.982 7.5h.518a.5.5 0 0 1 0 1h-.518A7 7 0 0 1 8.5 14.982v.518a.5.5 0 0 1-1 0v-.518A7 7 0 0 1 1.018 8.5H.5a.5.5 0 0 1 0-1h.518A7 7 0 0 1 7.5 1.018V.5A.5.5 0 0 1 8 0m-.5 2.02A6 6 0 0 0 2.02 7.5h1.005A5 5 0 0 1 7.5 3.025zm1 1.005A5 5 0 0 1 12.975 7.5h1.005A6 6 0 0 0 8.5 2.02zM12.975 8.5A5 5 0 0 1 8.5 12.975v1.005a6 6 0 0 0 5.48-5.48zM7.5 12.975A5 5 0 0 1 3.025 8.5H2.02a6 6 0 0 0 5.48 5.48zM10 8a2 2 0 1 0-4 0 2 2 0 0 0 4 0"/>
                </svg>
            </div>
            <div class="flex-grow">
                <h2 class="text-sm font-medium text-gray-500">Sale ID</h2>
                <p class="text-lg font-bold text-gray-800 mt-2">{{ $sale->id }}</p>
            </div>
        </div>



        <!-- Total Card -->
        <div class="bg-white  rounded-lg p-2 flex items-center space-x-4">
            <div class="bg-purple-100 p-4 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cash-coin text-purple-500" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
                    <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
                    <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
                    <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
                </svg>
            </div>
            <div class="flex-grow">
                <h2 class="text-sm font-medium text-gray-500">Total Revenue</h2>
                <p class="text-lg font-bold text-gray-800 mt-2">GH₵{{number_format( $sale->total , 2)}}</p>
            </div>
        </div>

        <!-- Date Card -->
        <div class="bg-white  rounded-lg p-4 flex items-center space-x-4">
            <div class="bg-blue-100 p-4 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-calendar4-week text-blue-500 " viewBox="0 0 16 16">
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v1h14V3a1 1 0 0 0-1-1zm13 3H1v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
                    <path d="M11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-2 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </div>
            <div class="flex-grow">
                <h2 class="text-sm font-medium text-gray-500">Date</h2>
                <p class="text-lg font-bold text-gray-800 mt-2">{{ \Carbon\Carbon::parse($sale->created_at)->format('D M d Y') }}</p>
            </div>
        </div>


        <div class="bg-white  rounded-lg p-2 flex items-center space-x-4">
            <div class="h-16 w-16">
                <img src="{{asset($sale->user->image)}}" alt="" class="w-full h-full object-cover  rounded-full">
            </div>
            <div class="flex-grow">
                <h2 class="text-sm font-medium text-gray-500">Employee</h2>
                <p class="text-lg font-bold text-gray-800 mt-2">{{ $sale->user->name }}</p>
            </div>
        </div>
    </div>


    <table class="w-full bg-white p-4 rounded-md shadow-md">
        <thead>
        <tr class="bg-gray-800 text-white">
            <th class="text-left px-6 py-3">Product</th>
            <th class="text-center px-2 py-3">Quantity</th>
            <th class="text-right px-6 py-3">Subtotal (GH₵)</th>
            <th class="text-right px-6 py-3">Tax (GH₵)</th>
            <th class="text-right px-6 py-3">Total (GH₵)</th>
            <th class="text-center px-2 py-3">Return Quantity</th>
            <th class="text-center px-6 py-3">Reason</th>
            <th class="text-center px-6 py-3">Action</th>
        </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
        @foreach ($sale->saleItem as $item)
            <tr class="hover:bg-gray-100">
                <!-- Product Column -->
                <td class="px-6 py-3 flex items-center gap-x-2">
                    <img src="{{ asset($item->product->image )}}" class="w-20 h-20 rounded-md object-cover">
                    <div>
                        <p class="font-semibold text-sm">{{ $item->product->name }}</p>
                        <p class="text-xs text-gray-500">Price at Purchase: GH₵{{ number_format($item->price_at_purchase, 2) }}</p>
                    </div>
                </td>

                <!-- Quantity Column -->
                <td class="text-center px-6 py-3">{{ $item->quantity }}</td>

                <!-- Subtotal Column -->
                <td class="text-right px-6 py-3">
                    GH₵{{ number_format($item->quantity * $item->price_at_purchase, 2) }}
                </td>

                <!-- Tax Column -->
                <td class="text-right px-6 py-3">
                    GH₵{{ number_format( ($item->quantity * $item->price_at_purchase) * $item->product->tax_rate / 100 , 2) }} ({{$item->product->tax_rate}}%)
                </td>

                <td class="text-right px-6 py-3">
                    GH₵{{ number_format(( ($item->quantity * $item->price_at_purchase) * $item->product->tax_rate / 100) + ($item->quantity * $item->price_at_purchase)  , 2) }}
                </td>

                <!-- Return Quantity Column -->
                <td class="text-center px-6 py-3">
                    <input type="number" class="w-20 border border-gray-300 rounded-md px-2 py-1 text-center" placeholder="0" min="0"  wire:model="returnQuantity">
                </td>

                <!-- Reason Column -->
                <td class="text-center px-6 py-3">
                    <select class="w-32 border border-gray-300 rounded-md px-2 py-1" wire:model="reason">
                        <option selected>Select value</option>
                        <option value="defective">Defective</option>
                        <option value="wrong_size">Wrong Size</option>
                        <option value="changed_mind">Changed Mind</option>
                        <option value="other">Other</option>
                    </select>
                </td>

                <td class="text-right px-6 py-3">
                    <button wire:click="addToReturn('{{$item->id}}')" class="p-2 text-white rounded-md bg-gray-800">
                        Add
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="w-full flex items-center justify-between p-4 bg-white rounded-md shadow-md">
        <!-- Total Refund Amount Section -->
        <div>
            <p class="text-sm text-gray-600">Total Refund Amount</p>
            <p class="text-lg font-semibold text-gray-800">GH₵{{number_format($totalReturnAmt,2)}}</p>
        </div>

       <div class="flex items-center gap-x-10">
           <button onclick="confirmClear()" class="flex items-center bg-gray-400 cursor-pointer rounded-md p-2 text-white">
               <span>Cancel</span>
           </button>

           <button onclick="confirmReturn()" class="flex items-center bg-gray-800 cursor-pointer rounded-md p-2 text-white">
               <span>Proceed</span>
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right ml-2" viewBox="0 0 16 16">
                   <path d="M12.354 7.646a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L11.293 8H3.5a.5.5 0 0 1 0-1h7.793l-2.646-2.646a.5.5 0 1 1 .708-.708l3 3z"/>
               </svg>
           </button>
       </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const selectEl = document.querySelector('select')
        function confirmClear() {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Continue',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('clearReturn');
                    selectEl.selectedIndex = 0
                }
            });
        }


        function confirmReturn() {

            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('confirmReturn');
                    selectEl.selectedIndex = 0

                }
            });
        }
    </script>




</div>
