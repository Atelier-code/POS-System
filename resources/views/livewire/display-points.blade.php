<div class="bg-white rounded-md p-3 flex items-center space-x-6 relative" x-data="{show:false}">


    <div class="bg-yellow-100 p-4 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-star-fill text-yellow-500" viewBox="0 0 16 16">
            <path d="M3.612 15.443c-.396.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.32-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.63.282.95l-3.522 3.356.83 4.73c.078.443-.35.79-.746.592L8 13.187l-4.389 2.256z"/>
        </svg>
    </div>


    <div class="flex flex-col">
        <div class="text-md font-semibod text-slate-400">Points Earned</div>
        <div class="text-2xl font-bold">
            {{$points}}
        </div>
    </div>

</div>
