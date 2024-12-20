<div>
    @if($rank == 1)
        <div class="bg-gradient-to-r from-yellow-100 via-yellow-50 to-white rounded-lg shadow-md p-6 flex items-center gap-4">
            <img
                class="w-24 h-24 rounded-full object-scale-down border-4 border-yellow-400 shadow-lg"
                src="{{asset("/images/first.png")}}"
                alt="Seller No.1">
            <div class="flex flex-col">
                <p class="text-xl font-bold text-gray-800">Employee No.1</p>
                <p class="text-gray-500 text-sm">Top-performing seller of the month</p>
            </div>
        </div>
    @elseif($rank == 2)
        <div class="bg-gradient-to-r from-gray-200 via-gray-100 to-white rounded-lg shadow-md p-6 flex items-center gap-4">
            <img
                class="w-24 h-24 rounded-full object-contain border-4 border-gray-400 shadow-lg"
                src="{{asset("/images/second.png")}}"
                alt="Seller No.2">
            <div class="flex flex-col">
                <p class="text-xl font-bold text-gray-800">Employee No.2</p>
                <p class="text-gray-500 text-sm">Outstanding performance</p>
            </div>
        </div>
    @elseif($rank == 3)
        <div class="bg-gradient-to-r from-yellow-50 via-orange-50 to-white rounded-lg shadow-md p-6 flex items-center gap-4">
            <img
                class="w-24 h-24 rounded-full object-contain border-4 border-orange-400 shadow-lg"
                src="{{asset("/images/third.png")}}"
                alt="Seller No.3">
            <div class="flex flex-col">
                <p class="text-xl font-bold text-gray-800">Employee No.3</p>
                <p class="text-gray-500 text-sm">Great effort this month</p>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-6 flex items-center gap-4">
            <img
                class="w-24 h-24 rounded-full object-contain border-4 border-gray-200 shadow-lg"
                src="{{asset("/images/all.png")}}"
                alt="User Rank">
            <div class="flex flex-col">
                <p class="text-lg font-bold text-gray-800">User Rank: {{ $rank }}</p>
                <p class="text-gray-500 text-sm">Good effort keep trying</p>
            </div>
        </div>
    @endif

</div>
