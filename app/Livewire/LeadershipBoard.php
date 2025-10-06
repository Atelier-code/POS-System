<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class LeadershipBoard extends Component
{
    use WithPagination;

    public $timeframe = 'daily'; // 'daily' or 'monthly'

    public function setTimeframe($timeframe)
    {
        $this->timeframe = $timeframe;
        $this->resetPage();
    }

    public function render()
    {
        // Simple: just rank by points
        $rankedUsers = User::orderBy('points', 'desc')->paginate(12);

        // Get top 3 for podium
        $topThree = User::orderBy('points', 'desc')->take(3)->get();

        // Get total users
        $totalUsers = User::count();

        // Get current user's rank
        $userRank = null;
        if (auth()->check()) {
            $userRank = User::where('points', '>', auth()->user()->points)->count() + 1;
        }

        return view('livewire.leadership-board', [
            'rankedUsers' => $rankedUsers,
            'topThree' => $topThree,
            'totalUsers' => $totalUsers,
            'userRank' => $userRank,
        ]);
    }
}
