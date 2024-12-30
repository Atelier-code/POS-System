<div class="p-2 h-full bg-white w-full lg:w-[25%] rounded-md max-lg:mt-2">
    <h3 class="font-semibold text-xl text-slate-500">This Week's Hits</h3>
    @foreach($products as $index => $item)
        @if($index === 0)
            <div class="relative w-full">
                <img src="{{ $item->image }}" alt="{{ $item->name }}" class="w-full object-cover h-[10rem]">
                <div class="absolute top-0 left-0 bg-gradient-to-b from-white to-black/30 w-full h-full overflow-hidden">
                    <div class="bottom-3 absolute ml-2 flex items-center space-x-2">
                        <span class="ring-1 ring-white text-white p-1 px-3 rounded-md  max-h-[2rem]">{{$index+1}}</span>
                        <div class="flex flex-col ">
                            <p class="text-lg overflow-ellipsis font-semibold text-white">{{$item->name}}</p>

                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-award-fill" viewBox="0 0 16 16">
                                    <path d="m8 0 1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864z"/>
                                    <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1z"/>
                                </svg>
                                <span class="text-white ml-2 font-semibold">{{ $item->total_sales_quantity }} sold</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="flex space-x-3 py-2 px-2">
                <span class="ring-1 ring-black text-black p-1 px-3 rounded-md max-h-[2rem]">{{$index+1}}</span>
                <div class="flex flex-col ">
                    <p class="text-lg overflow-ellipsis font-semibold text-black">{{$item->name}}</p>

                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                            <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                        </svg>

                        <span class="text-gray-500 ml-2">{{ $item->total_sales_quantity }} sold</span>
                    </div>

                </div>
            </div>
        @endif
    @endforeach
</div>
