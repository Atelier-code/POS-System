<div class="bg-white rounded-md p-3 flex items-center space-x-6 relative" x-data="{show:false}">

    <div class="bg-blue-100 p-4 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-people-fill text-blue-500" viewBox="0 0 16 16">
            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
        </svg>
    </div>

    <div class="flex flex-col">
        <div class="text-sm sm:text-md font-semibold text-slate-400">Employees</div>
        <div class="text-xl sm:text-2xl font-bold">
            {{$users}}
        </div>
    </div>

    <button class="absolute top-2 right-3 sm:top-3 sm:right-4" @click="show = !show">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
        </svg>
    </button>

    <div class="absolute divide-y rounded-md shadow w-[5rem] bg-white top-5 right-3 flex flex-col" x-cloak="show" x-show="show" @click.away="show= false">
        <a href="{{route('admin.manage.users')}}" class="hover:bg-gray-100 p-2 text-sm sm:text-base" @click="show= false">View All</a>
    </div>

</div>
