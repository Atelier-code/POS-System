<div class="">
    <div class="max-w-6xl mx-auto flex gap-6">

        {{-- Vertical Podium (Left) --}}
        @if($topThree->isEmpty())
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 text-center">
                <p class="text-sm text-gray-500">No ranked users yet.</p>
            </div>
        @else
            <div class="w-64 flex-shrink-0">
                @if($topThree->count() > 0)
                <div class="space-y-4">
                    {{-- 1st Place --}}
                    <div class="flex flex-col items-center bg-gradient-to-br from-yellow-200 to-yellow-400 rounded-lg p-4">
                        <div class="relative mb-2">
                            <div class="w-16 h-16 rounded-full border-4 border-yellow-400 overflow-hidden shadow-lg bg-white">
                                <img src="{{ asset($topThree[0]->image) }}" alt="{{ $topThree[0]->name }}"
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="absolute -top-2 left-1/2 transform -translate-x-1/2 text-xl animate-bounce">👑</div>
                            <div class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-6 h-6 bg-yellow-400 rounded-full flex items-center justify-center text-gray-900 font-bold text-xs shadow-md">1</div>
                        </div>
                        <p class="font-bold text-gray-900 text-sm truncate">{{ $topThree[0]->name }}</p>
                        <div class="flex items-center gap-1 mt-1">
                            <i class="fas fa-gem text-yellow-700"></i>
                            <span class="font-bold text-gray-900">{{ number_format($topThree[0]->points) }}</span>
                        </div>
                        <p class="text-xs text-yellow-800">Points</p>
                    </div>
                    @endif

                    @if($topThree->count() > 1)
                    {{-- 2nd Place --}}
                    <div class="flex flex-col items-center bg-white rounded-lg p-4 border border-gray-200">
                        <div class="relative mb-2">
                            <div class="w-14 h-14 rounded-full border-4 border-gray-300 overflow-hidden shadow-md bg-white">
                                <img src="{{ asset($topThree[1]->image) }}" alt="{{ $topThree[1]->name }}"
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center text-white font-bold text-xs shadow-md">2</div>
                        </div>
                        <p class="font-semibold text-gray-800 text-sm truncate">{{ $topThree[1]->name }}</p>
                        <div class="flex items-center gap-1 mt-1">
                            <i class="fas fa-gem text-blue-500"></i>
                            <span class="font-bold text-gray-800">{{ number_format($topThree[1]->points) }}</span>
                        </div>
                        <p class="text-xs text-gray-500">Points</p>
                    </div>
                    @endif

                    @if($topThree->count() > 2)
                    {{-- 3rd Place --}}
                    <div class="flex flex-col items-center bg-white rounded-lg p-4  border border-gray-200">
                        <div class="relative mb-2">
                            <div class="w-14 h-14 rounded-full border-4 border-orange-400 overflow-hidden shadow-md bg-white">
                                <img src="{{ asset($topThree[2]->image) }}" alt="{{ $topThree[2]->name }}"
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-6 h-6 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold text-xs shadow-md">3</div>
                        </div>
                        <p class="font-semibold text-gray-800 text-sm truncate">{{ $topThree[2]->name }}</p>
                        <div class="flex items-center gap-1 mt-1">
                            <i class="fas fa-gem text-orange-500"></i>
                            <span class="font-bold text-gray-800">{{ number_format($topThree[2]->points) }}</span>
                        </div>
                        <p class="text-xs text-gray-500">Points</p>
                    </div>
                    @endif
                </div>
            </div>
        @endif

        {{-- Ranked Users List (Center) --}}
        <div class="flex-1 bg-white rounded-xl  p-6 border border-gray-200 ">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Rankings</h2>
            <div class="space-y-2 max-h-[80vh] scrollcustom overflow-y-scroll">
                @foreach ($rankedUsers as $index => $user)
                    @php
                        $rank = $rankedUsers->firstItem() + $index;
                    @endphp
                    <div class="flex items-center justify-between py-3 px-4 hover:bg-gray-50 rounded-lg transition-all duration-200 group">
                        <div class="flex items-center gap-3 flex-1">
                            <div class="text-base font-bold w-6 text-center group-hover:scale-110 transition-transform
                                @if($rank == 1) text-yellow-500
                                @elseif($rank == 2) text-gray-500
                                @elseif($rank == 3) text-orange-500
                                @else text-gray-400
                                @endif">
                                {{ $rank }}
                            </div>
                            <div class="relative">
                                <img src="{{ asset($user->image) }}" alt="{{ $user->name }}"
                                     class="w-10 h-10 rounded-full object-cover shadow-md
                                     @if($rank == 1) border-2 border-yellow-400
                                     @elseif($rank == 2) border-2 border-gray-400
                                     @elseif($rank == 3) border-2 border-orange-400
                                     @else border-2 border-gray-200
                                     @endif
                                     group-hover:border-purple-400 transition-all duration-200">
                                @if($rank == 1)
                                    <div class="absolute -top-1 -right-1 text-base">👑</div>
                                @elseif($rank == 2)
                                    <div class="absolute -top-1 -right-1 text-base">🥈</div>
                                @elseif($rank == 3)
                                    <div class="absolute -top-1 -right-1 text-base">🥉</div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800 text-sm group-hover:text-purple-600 transition-colors">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500"><i class="fas fa-envelope"></i> {{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="flex items-center gap-1 justify-end">
                                <i class="fas fa-gem text-blue-500"></i>
                                <span class="font-bold text-gray-800">{{ number_format($user->points) }}</span>
                            </div>
                            <p class="text-xs text-gray-500">points</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-3">{{ $rankedUsers->links() }}</div>
        </div>

        {{-- Current User Stats Card (Right) --}}
        @auth
            <div class="w-64 flex-shrink-0">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Your Stats</h2>
                <div class="bg-white rounded-lg p-4  border border-gray-200">
                    <div class="flex flex-col items-center">
                        <div class="relative mb-2">
                            <div class="w-14 h-14 rounded-full border-4 border-purple-400 overflow-hidden shadow-md bg-white">
                                <img src="{{ asset(auth()->user()->image) }}" alt="{{ auth()->user()->name }}"
                                     class="w-full h-full object-cover">
                            </div>
                        </div>
                        <p class="font-semibold text-gray-800 text-sm truncate">{{ auth()->user()->name }}</p>
                        <div class="flex items-center gap-1 mt-1">
                            <i class="fas fa-gem text-purple-500"></i>
                            <span class="font-bold text-gray-800">{{ number_format(auth()->user()->points) }}</span>
                        </div>
                        <p class="text-xs text-gray-500">Points</p>
                        <p class="text-sm font-semibold text-purple-600 mt-2">Rank: {{ $userRank ? '#' . number_format($userRank) : '-' }}</p>
                        <p class="text-xs text-gray-500">of {{ number_format($total) }} users</p>
                    </div>
                </div>
            </div>
        @endauth

    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush
