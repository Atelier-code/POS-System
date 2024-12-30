<?php


namespace App\Livewire;

use App\Models\Sale;
use Livewire\Component;
use function PHPUnit\Framework\isNull;

class OrderSearch extends Component
{
    public $orderID;

    public function search()
    {

        if (strlen($this->orderID) < 1) {
            $this->dispatch(
                'alert',
                type:'error',
                title:'Order ID is empty'
            );

            return false;
        }


        $order = Sale::find($this->orderID);



        if (!$order) {
            $this->dispatch(
                'alert',
                type:'error',
                title:'Order ID not found'
            );

            return false;
        }


        return $this->redirect(route("cashier.return", $this->orderID));
    }

    public function render()
    {
        return view('livewire.order-search');
    }
}
