<div class="text-black px-4  mx-auto">


    <div class="bg-white rounded-xl shadow-md p-6 space-y-3 divide-y divide-gray-100">
        <h1 class="text-4xl font-extrabold text-center mb-10 text-violet-700">🏆 Leadership Board</h1>

        @foreach ($rankedUsers as $index => $user)
            @php
                $rank = $rankedUsers->firstItem() + $index;
            @endphp

            <div class="flex justify-between items-center py-3">
                <div class="flex items-center gap-4">
                    <div class="text-lg font-bold text-gray-500 w-6 text-right">{{ $rank }}</div>

                    {{-- Highlight top 3 with special avatar styles --}}
                    <div class="relative">
                        <img src="{{ asset($user->image) }}" alt="{{ $user->name }}"
                             class="w-12 h-12 rounded-full object-cover shadow-sm
                                @if($rank == 1 && $user->points > 0 ) border-4 border-yellow-400 @elseif($rank == 2 && $user->points > 0) border-4 border-blue-400 @elseif($rank == 3 && $user->points > 0) border-4 border-green-400 @endif">
                        @if($rank == 1)
                            <div class="absolute -top-2 -right-2 text-xl">👑</div>
                        @endif
                    </div>

                    <div>
                        <p class="font-medium text-gray-800">{{ $user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    </div>
                </div>

                <div class="font-bold text-gray-700 text-sm">{{ $user->points }} pts</div>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-8 text-center">
        {{ $rankedUsers->links() }}
    </div>
</div>
