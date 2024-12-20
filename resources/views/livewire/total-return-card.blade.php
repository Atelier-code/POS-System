<div class="bg-white rounded-md p-3 flex items-center space-x-6 relative" x-data="{show:false}">


    <div class="bg-green-100 p-4 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-return-right text-green-500" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5"/>
        </svg>
    </div>

    <div class="flex flex-col">
        <div class="text-md font-semibod text-slate-400">Returned Products</div>
        <div class="text-2xl font-bold">
            {{$returns}}
        </div>
    </div>

    <button class="absolute top-2 right-3" @click="show = !show">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
        </svg>
    </button>


    <div class="absolute divide-y rounded-md shadow w-[5rem] bg-white top-5 right-3 flex flex-col z-[99]" x-cloak="show" x-show="show" @click.away="show= false" >
        <button class="hover:bg-gray-100 p-2" @click="show= false" wire:click="day"> Day </button>
        <button class="hover:bg-gray-100 p-2" @click="show= false" wire:click="month"> Month </button>
        <button class="hover:bg-gray-100 p-2" @click="show= false" wire:click="year"> Year </button>
    </div>

</div>
