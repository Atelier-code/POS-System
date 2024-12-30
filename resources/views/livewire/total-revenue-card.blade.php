<div class="bg-white rounded-md p-3 flex items-center space-x-6 relative overflow-x-auto scrollcustom" x-data="{show:false}">


    <div class="bg-orange-100 p-4 rounded-full">
        <svg  xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bank2 font-bold text-orange-500" viewBox="0 0 16 16">
            <path d="M8.277.084a.5.5 0 0 0-.554 0l-7.5 5A.5.5 0 0 0 .5 6h1.875v7H1.5a.5.5 0 0 0 0 1h13a.5.5 0 1 0 0-1h-.875V6H15.5a.5.5 0 0 0 .277-.916zM12.375 6v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zM8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2M.5 15a.5.5 0 0 0 0 1h15a.5.5 0 1 0 0-1z"/>
        </svg>
    </div>

    <div class="flex flex-col">
      <div class="text-md font-semibod text-slate-400">Revenue</div>
      <div class="text-2xl font-bold">
          GH₵{{number_format($revenue,2)}}
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
