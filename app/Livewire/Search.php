<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class Search extends Component
{

    public $search, $products, $users;
    public function render()
    {


        if(auth()->user()->role =='admin'){
            $this->users = User::where('name', 'like', '%' . $this->search . '%')->take(5)->get();
        }
        $this->products = Product::where('name', 'like', '%' . $this->search . '%')->take(5)->get();
        return view('livewire.search',[
            'products' => $this->products,
            'users' => $this->users,
        ]);
    }
}
