<div class="flex w-full gap-x-2">

    <div class="w-full p-6 bg-white  rounded-lg">
        <h1 class="text-3xl font-bold text-gray-900">Sale Summary</h1>

        <div class="flex w-full gap-x-10">
            <div class=" mt-3  h-full w-2/3 overflow-y-auto scrollcustom border border-gray-200 rounded-lg p-2 overflow-x-hidden">
                @if(count($cartItems) > 0)
                    @foreach($cartItems as $cartItem)
                        <div class="w-full rounded-lg border-2 border-gray-100 p-3 mb-2  relative ">
                            <button class="top-2 right-2 rounded-md absolute text-white bg-red-500 text-xs p-1" wire:click="removeProduct('{{$cartItem['id']}}')" >
                                Remove
                            </button>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <img src="{{asset($cartItem['image'])}}" class="size-[4rem] rounded-md">
                                    <p class="text-lg">{{$cartItem['name']}}</p>
                                </div>
                                GH₵{{ number_format($cartItem['selling_price'], 2) }}
                            </div>

                            <div class="flex items-center justify-between p-4 border border-gray-300 rounded-lg shadow-sm bg-white">
                                <!-- Quantity Controls -->
                                <div class="flex items-center gap-2">
                                    <input
                                        type="number"
                                        class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        wire:change="updateQuantity('{{$cartItem['id']}}',$event.target.value)"
                                        value="{{$cartItem['quantity']}}"
                                        aria-label="Update quantity"
                                        step="1"
                                        min="1"
                                    />

                                </div>

                                <!-- Price Display -->
                                <div class="text-xl font-bold text-gray-900 flex items-center flex-col-reverse">
                                    <span class="text-xs bg-green-500 text-white p-1 rounded-md">{{$cartItem['tax_rate']}}% tax</span>
                                    <p>GH₵{{ number_format($cartItem['total'], 2) }}</p>
                                </div>
                            </div>

                        </div>
                    @endforeach
                @else
                    <p class="mt-5 text-center font-semibold text-xl text-gray-600">
                        No items in Basket
                    </p>
                @endif
            </div>

            <div class="w-1/3 h-full">
                <div class="pt-4">
                    <p class="text-gray-700 font-semibold flex justify-between">
                        <span>Sub Total:</span>
                        <span class="text-gray-900">GH₵{{ number_format($sub_total, 2) }}</span>
                    </p>
                    <p class="text-gray-700 font-semibold flex justify-between mt-2">
                        <span>Total Tax:</span>
                        <span class="text-gray-900">GH₵{{ number_format($tax, 2) }}</span>
                    </p>
                    <p class="text-lg font-bold flex justify-between mt-3">
                        <span>Total:</span>
                        <span class="text-gray-900">GH₵{{ number_format($total, 2) }}</span>
                    </p>
                </div>

                <div class="mt-5">
                    <label for="payment-method" class="block text-gray-700 font-semibold mb-2">Payment Method</label>
                    <select wire:model="payment_option" id="payment-method" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option selected>Select Item</option>
                        <option value="card">Card</option>
                        <option value="cash">Cash</option>
                        <option value="mobile">Momo</option>
                    </select>
                </div>

                <div class="mt-6 flex gap-4">
                    <button class="bg-gray-300 text-gray-800 p-2 rounded-md w-1/2 hover:bg-gray-400 transition" onclick="confirmClear()">
                        Cancel
                    </button>
                    <button class="bg-black text-white p-2 rounded-md w-1/2" onclick="confirmSale()">
                        Confirm Purchase
                    </button>
                </div>
            </div>
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
                confirmButtonText: 'Yes, clear cart',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('clearCart');
                    selectEl.selectedIndex = 0
                }
            });
        }


        function confirmSale() {

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
                    Livewire.dispatch('confirmSale');
                    selectEl.selectedIndex = 0

                }
            });
        }
    </script>

</div>
