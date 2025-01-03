<div class="flex w-full gap-x-2">
    <!-- Left Column: Product Listing -->
    <div class="w-full md:w-2/3 max-h-screen bg-white rounded-md">
        <div class="sticky top-0 bg-white z-10 flex items-center gap-4 mb-3 p-3 rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
            <input class="w-80 focus:outline-none" placeholder="Type to search ..." wire:model.live="search">
        </div>
        <div class="grid grid-cols-3 gap-3 overflow-y-auto p-2 scrollcustom">
            @if(count($products) > 0)
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg overflow-hidden relative group">
                        <!-- Product Image -->
                        <img src="{{ asset($product->image) }}" alt="{{$product->name}}"
                             class="h-40 w-full object-cover transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute top-0 left-0 bg-black/50 h-full w-full"></div>

                        <!-- Overlay Effect -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        <!-- Product Details -->
                        <div class="absolute inset-0 p-4 flex flex-col justify-end z-10">
                            <!-- Product Name -->
                            <p class="text-white font-semibold text-lg truncate">
                                {{$product->name}}
                            </p>

                            <!-- Product Price -->
                            <p class="text-white text-lg font-bold mt-1">
                                GH₵{{ number_format($product->selling_price, 2) }}
                            </p>

                            <!-- Add to Basket Button -->
                            <button wire:click="addProduct('{{ $product->id }}')"
                                    class="bg-white text-black text-sm font-medium p-2 rounded-md mt-3 opacity-0 group-hover:opacity-100 transform scale-90 group-hover:scale-100 transition-all duration-300">
                                Add to Basket
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center text-xl font-semibold w-full text-gray-800">
                    No Items Available
                </div>
            @endif
        </div>
    </div>

    <!-- Right Column: Basket Summary -->
    <div class="w-full md:w-1/3 p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-gray-900">Sale Summary</h1>

        <div class="mt-5 max-w-[25rem] w-full h-[300px] overflow-y-auto scrollcustom border border-gray-200 rounded-lg p-2 overflow-x-hidden">
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
                                <button class="bg-gray-200 text-gray-700 rounded-full w-8 h-8 flex items-center justify-center hover:bg-gray-300 transition" wire:click="decrementProduct('{{$cartItem['id']}}')">
                                    -
                                </button>
                                <p class="text-lg font-semibold text-gray-800">{{$cartItem['quantity']}}</p>
                                <button class="bg-gray-200 text-gray-700 rounded-full w-8 h-8 flex items-center justify-center hover:bg-gray-300 transition" wire:click="incrementProduct('{{$cartItem['id']}}')" >
                                    +
                                </button>
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

        <div class="mt-5 border-t border-gray-200 pt-4">
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
