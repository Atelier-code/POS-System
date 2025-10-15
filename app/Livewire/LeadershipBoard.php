<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class LeadershipBoard extends Component
{
    use WithPagination;

    public $timeframe = 'daily';

    public function setTimeframe($timeframe)
    {
        $this->timeframe = $timeframe;
        $this->resetPage();
    }

    public function render()
    {
        // Rank users with points > 0
        $rankedUsers = User::where('points', '>', 0)
            ->orderBy('points', 'desc')
            ->paginate(12);

        // Get top 3 for podium with points > 0
        $topThree = User::where('points', '>', 0)
            ->orderBy('points', 'desc')
            ->take(3)
            ->get();

        // Get total users with points > 0
        $totalUsers = User::where('points', '>', 0)->count();

        // Get current user's rank (null if points = 0)
        $userRank = null;
        if (auth()->check() && auth()->user()->points > 0) {
            $userRank = User::where('points', '>', auth()->user()->points)->count() + 1;
        }

        return view('livewire.leadership-board', [
            'rankedUsers' => $rankedUsers,
            'topThree' => $topThree,
            'totalUsers' => $totalUsers,
            'userRank' => $userRank,
            'total' => User::all()->count(),
        ]);
    }
}
