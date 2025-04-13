<?php

namespace App\Livewire;

use Livewire\Component;

class DisplayPoints extends Component
{
    public function render()
    {
        return view('livewire.display-points', [
            'points' => auth()->user()->points
        ]);
    }
}
