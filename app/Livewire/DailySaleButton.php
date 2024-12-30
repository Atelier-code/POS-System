<?php

namespace App\Livewire;

use App\Exports\DailySales;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class DailySaleButton extends Component
{




    public function downloadExcel($type)
    {


        return Excel::download(new DailySales($type), 'Mighty_Jesus_POS_SalesReport_' . Carbon::today()->format('Y-m-d') . '.xlsx');
    }
    public function render()
    {
        return view('livewire.daily-sale-button');
    }
}
