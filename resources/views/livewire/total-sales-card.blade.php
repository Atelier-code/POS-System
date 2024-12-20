<div class="bg-white rounded-md p-3 flex items-center space-x-6 relative" x-data="{show:false}">

    <div class="bg-purple-100 p-4 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-box2 font-bold text-purple-500" viewBox="0 0 16 16">
            <path d="M2.95.4a1 1 0 0 1 .8-.4h8.5a1 1 0 0 1 .8.4l2.85 3.8a.5.5 0 0 1 .1.3V15a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4.5a.5.5 0 0 1 .1-.3zM7.5 1H3.75L1.5 4h6zm1 0v3h6l-2.25-3zM15 5H1v10h14z"/>
        </svg>
    </div>

    <div class="flex flex-col">
        <div class="text-sm sm:text-md font-semibold text-slate-400">Total Sales</div>
        <div class="text-xl sm:text-2xl font-bold">
            {{$sale}}
        </div>
    </div>

    <button class="absolute top-2 right-3 sm:top-3 sm:right-4" @click="show = !show">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
        </svg>
    </button>

    <div class="absolute divide-y rounded-md shadow w-[5rem] bg-white top-5 right-3 flex flex-col z-[99]" x-cloak="show" x-show="show" @click.away="show= false">
        <button class="hover:bg-gray-100 p-2 text-sm sm:text-base" @click="show= false" wire:click="day"> Day </button>
        <button class="hover:bg-gray-100 p-2 text-sm sm:text-base" @click="show= false" wire:click="month"> Month </button>
        <button class="hover:bg-gray-100 p-2 text-sm sm:text-base" @click="show= false" wire:click="year"> Year </button>
    </div>

</div>
