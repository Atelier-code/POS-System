<div class="ml-5 lg:flex items-center space-x-5 hidden" x-data="{ show:true}" @click.away="show = false">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
    </svg>
    <input class="w-80 focus:outline-none" placeholder="Type to search ..." wire:model.live="search" @focus="show = true">


    @if(strlen($search) > 1)

        <div class="w-[60%] absolute top-[5rem]  bg-white shadow-2xl rounded-md p-3 flex items-center" x-bind:class="!show ?'hidden' :''" >
            @if(auth()->user()->role =="admin")
                @if($users->count() > 0)
                    <div class="w-1/2">
                        <h4 class="text-slate-500 font-semibold text-xl p-2">Employees</h4>

                        <div class="p-2">

                            @foreach($users as $user)
                                <a href="{{route('admin.show.user', $user->id)}}" class="rounded-md hover:bg-gray-100 flex items-center p-2">
                                    <img class="h-10 w-10 object-cover rounded-full" src="{{ asset($user->image) }}"/>
                                    <div class="ml-2">
                                        <span class="font-xl">
                                            {{$user->name}}
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif


            @if($products->count() > 0)
                <div class="w-1/2">
                    <h4 class="text-slate-500 font-semibold text-xl p-2">Products</h4>

                    <div class="p-2 space-y-2">

                        @foreach($products as $item)
                            <a href="{{route(  auth()->user()->role == "admin" ? "admin.edit.product" : "cashier.dashboard", $item->id)}}" class="rounded-md hover:bg-gray-100 flex items-center p-2">
                                <img class="h-10 w-10 object-cover rounded-full" src="{{$item->image}}"/>
                                <div class="ml-2">
                                    <span class="font-xl">
                                        {{$item->name}}
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif


            @if($products->count() <= 0 && $users->count() <= 0)
                <p class="p-4 font-semibold text-2xl  text-slate-600">No results for "{{$search}}"</p>
            @endif

        </div>

    @endif
</div>
