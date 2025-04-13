<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class LeadershipBoard extends Component
{
    use WithPagination;

    public function render()
    {
        $rankedUsers = User::orderBy('points', 'desc')->paginate(15);

        return view('livewire.leadership-board', [
            'rankedUsers' => $rankedUsers,
        ]);
    }
}
