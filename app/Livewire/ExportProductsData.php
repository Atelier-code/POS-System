<?php

namespace App\Livewire;

use App\Exports\productData;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;


class ExportProductsData extends Component
{

    public function downloadData()
    {


        return Excel::download(new ProductData(), 'Mighty_Jesus_POS_ProductStock_' . Carbon::today()->format('Y-m-d') . '.xlsx');
    }

    public function render()
    {
        return view('livewire.export-products-data');
    }
}
