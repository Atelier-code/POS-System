<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class TotalEmployeeCard extends Component
{

    public function render()
    {
        return view('livewire.total-employee-card',[
            'users' => User::all()->count()
        ]);
    }
}
