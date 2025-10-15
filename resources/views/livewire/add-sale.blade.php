<div class="flex w-full gap-x-2">

    <div class="w-full p-6 bg-white  rounded-lg">
        <h1 class="text-3xl font-bold text-gray-900">Sale Summary</h1>
        <div class="flex w-full gap-x-10">
            <div class=" mt-3  h-full w-2/3 overflow-y-auto scrollcustom border border-gray-200 rounded-lg p-2 overflow-x-hidden">
                @if(count($cartItems) > 0)
                    @foreach($cartItems as $cartItem)
                        <div class="w-full rounded-xl border border-gray-200 bg-white p-4 mb-4 shadow-sm relative hover:shadow-md transition" wire:key="{{ $cartItem['id'] }}">
                            <!-- Remove Button -->
                            <button
                                class="absolute top-3 right-3 text-xs bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded-md shadow-sm transition"
                                wire:click="removeProduct('{{ $cartItem['id'] }}')"
                            >
                                ✕ Remove
                            </button>

                            <!-- Product Info -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-4">
                                    <img
                                        src="{{ asset($cartItem['image']) }}"
                                        alt="{{ $cartItem['name'] }}"
                                        class="w-16 h-16 rounded-lg border border-gray-200 object-cover"
                                    >
                                    <div>
                                        <p class="text-lg font-semibold text-gray-800">{{ $cartItem['name'] }}</p>
                                        <p class="text-sm text-gray-500">GH₵{{ number_format($cartItem['selling_price'], 2) }} each</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Quantity & Total -->
                            <div class="flex items-center justify-between border border-gray-200 rounded-lg p-3 bg-gray-50">
                                <!-- Quantity Controls -->
                                <div class="flex items-center gap-2">
                                    <label for="quantity_{{ $cartItem['id'] }}" class="text-sm text-gray-600">Quantity:</label>
                                    <input
                                        id="quantity_{{ $cartItem['id'] }}"
                                        type="number"
                                        class="w-20 text-center p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:bg-gray-100"
                                        wire:change="updateQuantity('{{ $cartItem['id'] }}', $event.target.value)"
                                        value="{{ $cartItem['quantity'] }}"
                                        min="1"
                                        step="1"
                                    />
                                </div>

                                <!-- Price + Tax -->
                                <div class="flex flex-col items-end">
            <span class="text-xs bg-green-500 text-white px-2 py-0.5 rounded-full mb-1">
                {{ $cartItem['tax_rate'] }}% tax
            </span>
                                    <p class="text-xl font-bold text-gray-800">
                                        GH₵{{ number_format($cartItem['total'], 2) }}
                                    </p>
                                </div>
                            </div>
                        </div>

                    @endforeach
                @else
                    <div class="flex flex-col items-center justify-center h-full py-10 text-gray-600">
                        <i class="fa-solid fa-basket-shopping text-[10rem] text-gray-400 mb-4"></i>
                        <h2 class="text-2xl font-semibold">Your Basket is Empty</h2>
                        <p class="text-sm text-gray-500 mt-1">Scan or add products to start a new sale</p>
                    </div>

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


@script
<script>

    let barcode = '';
    let lastTime = 0;
    document.addEventListener('keydown', e => {
        const now = Date.now();

        if (now - lastTime > 50) barcode = '';
        lastTime = now;
        if (e.key === 'Enter') {
            if (barcode.length >= 6 && !barcode.includes(' ')) {
                $wire.addProduct(barcode.trim())
            }
            barcode = '';
        } else barcode += e.key;
    });
</script>
@endscript

