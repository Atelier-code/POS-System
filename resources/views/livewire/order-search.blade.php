<form class="flex items-center space-x-2  bg-white p-1 border border-gray-300 rounded-md" wire:submit.prevent="search">
    <input
        type="text"
        id="searchInput"
        placeholder="Enter Order ID"
        class=" rounded-md focus:outline-none  w-72"
        wire:model="orderID"
    >
    <button
        class="bg-black text-white p-2 rounded-md focus:outline-none  flex items-center justify-center space-x-2"
        wire:loading.attr="disabled"
    >
        <span >Search</span>

    </button>
</form>
