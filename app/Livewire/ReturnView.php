<?php

namespace App\Livewire;

use App\Models\Returns;
use App\Models\Sale;
use App\Models\SaleItem;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layout.cashier')]
class ReturnView extends Component
{
    public $sale;
    public $returnItems = [];
    public $reason = "", $totalReturnAmt = 0, $returnQuantity;

    public function mount($sale)
    {
        $this->sale = Sale::find($sale);
    }

    public function updateRefundAmount()
    {
        $this->totalReturnAmt = 0;
        foreach ($this->returnItems as $returnItem) {
            $amount = $returnItem['price_at_purchase'] * $returnItem['quantity'];
            $taxAmount = $amount * ($returnItem['tax_rate'] / 100);
            $this->totalReturnAmt += $amount + $taxAmount;
        }
    }

    public function addToReturn($id)
    {
        if ($this->returnQuantity == 0) {
              $this->dispatch(
                  'alert',
                  type:'error',
                  title:'Return quantity cannot be zero. Please enter a valid amount.'
              );
            return false;
        }

        $saleItem = SaleItem::find($id);

        if ($this->returnQuantity > $saleItem->quantity) {
            $this->dispatch(
                'alert',
                type:'error',
                title:'Return quantity cannot exceed the purchased quantity.'
            );
            return false;
        }

        if (strlen(trim($this->reason)) <= 0) {
            $this->dispatch(
                'alert',
                type:'error',
                title:'Please specify a reason for the return.'
            );
            return false;
        }

        foreach ($this->returnItems as &$item) {
            if ($item['id'] == $saleItem->id) {
                $item['quantity'] = $this->returnQuantity;
                $this->updateRefundAmount();

                $this->dispatch(
                    'alert',
                    type:'error',
                    title:'Item successfully added to the return receipt!'
                );
                $this->resetReturnFields();
                return;
            }
        }

        $this->returnItems[] = [
            'id' => $saleItem->id,
            'quantity' => $this->returnQuantity,
            'reason' => $this->reason,
            'product_id' => $saleItem->product->id,
            'price_at_purchase' => $saleItem->price_at_purchase,
            'tax_rate' => $saleItem->product->tax_rate,
        ];

        $this->updateRefundAmount();
        $this->dispatch(
            'alert',
            type:'success',
            title:'Item successfully added to the return receipt!'
        );
        $this->resetReturnFields();
    }

    private function resetReturnFields()
    {
        $this->returnQuantity = 0;
        $this->reason = "";
    }


    protected $listeners = ['clearReturn' => 'clearReturn', 'confirmReturn' => 'confirmReturn'];
    public function confirmReturn()
    {

       if ($this->totalReturnAmt == 0){
           $this->dispatch(
               'alert',
               type:'error',
               title:'Refund Amount must be more than zero'
           );

           return false;
       }
        foreach ($this->returnItems as $returnItem) {
            $return = Returns::create([
                'sale_id' => $this->sale->id,
                'quantity' => $returnItem['quantity'],
                'reason' => $returnItem['reason'],
                'price_at_purchase' => $returnItem['price_at_purchase'],
                'product_id' => $returnItem['product_id'],
            ]);
        }


        $this->dispatch(
            'alert',
            type:'success',
            title:'Return receipt has been saved successfully.!'
        );


        sleep(10);
        $this->redirect(route("cashier.dashboard"));


    }


    public function clearReturn()
    {
        return redirect(route('cashier.dashboard'));
    }

    public function render()
    {
        return view('livewire.return-view', [
            'sale' => $this->sale
        ]);
    }
}
