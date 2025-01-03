<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class AddSale extends Component
{
    public $search, $sub_total, $total, $tax , $payment_option ;
    public $cartItems = [];



    public function addProduct($id)
    {
        $product = Product::find($id);

        if (!$product) {
            $this->dispatch(
                'alert',
                type: 'error',
                title:'Product not available'

            );
        } else {
            // Check if the product already exists in the cart
            foreach ($this->cartItems as &$item) {
                if ($item['id'] == $product->id) {
                    $item['quantity']++;
                    $item['total'] = round($item['quantity'] * $product->selling_price, 2);
                    $item['tax'] = round($item['total'] * ($item['tax_rate'] / 100), 2);
                    $this->updateTotals(); // Update totals after quantity change
                    return;
                }
            }

            $this->cartItems[] = [
                'id' => $product->id,
                'name' => $product->name,
                'selling_price' => $product->selling_price,
                'quantity' => 1,
                'total' => round($product->selling_price, 2),
                'image' => $product->image,
                'tax' => round(($product->tax_rate / 100) * $product->selling_price, 2),
                'tax_rate' => $product->tax_rate,
            ];

            $this->updateTotals(); // Update totals after adding a product
        }
    }

    public function removeProduct($id)
    {
        $this->cartItems = array_filter($this->cartItems, function ($item) use ($id) {
            return $item['id'] != $id;
        });


        $this->updateTotals();
    }

    public function decrementProduct($id)
    {
        foreach ($this->cartItems as &$item) {
            if ($item['id'] == $id) {
                if ($item['quantity'] > 1) {
                    $item['quantity']--;
                    $item['total'] = round($item['quantity'] * $item['selling_price'], 2);
                    $item['tax'] = round($item['total'] * ($item['tax_rate'] / 100), 2);

                    $this->updateTotals(); // Update totals after decrement
                } else {
                    $this->removeProduct($id);
                }

                return;
            }
        }
    }

    public function incrementProduct($id)
    {
        foreach ($this->cartItems as &$item) {
            if ($item['id'] == $id) {
                $item['quantity']++;
                $item['total'] = round($item['quantity'] * $item['selling_price'], 2);
                $item['tax'] = round($item['total'] * ($item['tax_rate'] / 100), 2);
                $this->updateTotals();
                return;
            }
        }
    }

    public function updateTotals()
    {
        // Reset totals
        $this->sub_total = 0;
        $this->tax = 0;

        // Recalculate the totals with precision
        foreach ($this->cartItems as $item) {
            $this->tax += $item['tax'];
            $this->sub_total += $item['total'];
        }

        // Calculate the final total with precision
        $this->total = round($this->sub_total + $this->tax, 2);
    }


    protected $listeners = ['clearCart' => 'clearCart', 'confirmSale' => 'confirmSale'];

    public function clearCart()
    {
        $this->cartItems = [];
        $this->updateTotals();

        $this->dispatch('alert',
            type:'success',
            title:'Basket cleared successfully'
        );
    }

    public function  confirmSale()
    {

        if($this->total <= 0){
            $this->dispatch(
                'alert',
                type:'error',
                title:'Basket is empty'
            );

            return false;
        }

        if($this->payment_option  == null){
            $this->dispatch(
                'alert',
                type:'error',
                title:'Select payment method'
            );

            return false;
        }
        $sale = Sale::create([
            'user_id' => Auth::id(),
            'total' => $this->total,
            'sub_total' => $this->sub_total,
            'vat' => $this->tax,
            'payment_method' => $this->payment_option,
        ]);

        foreach ($this->cartItems as $item) {
            $saleItem = SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price_at_purchase'=>$item['selling_price'],
            ]);
        }

        $pdf = PDF::loadView("exports.receipt", [
            "items" => $this->cartItems,
            "sale_id"=>$sale->id,
            "total"=>$this->total,
            "sub_total"=>$this->sub_total,
            "tax"=>$this->tax,
            "payment_option"=>$this->payment_option,
        ])
            ->setPaper('a4')
            ->setOption([
                'dpi' => 300, // Higher DPI for better clarity
                'defaultFont' => 'sans-serif', // Clean and readable font
                'margin-top' => 10, // Top margin for receipt header
                'margin-right' => 10, // Right margin
                'margin-bottom' => 10, // Bottom margin for footer or totals
                'margin-left' => 10, // Left margin
                'enable_html5_parser' => true, // Ensures modern HTML rendering
            ]);
        $alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O'];


        foreach ($sale->saleItem as $saleItem) {
            $product = $saleItem->product;
            if ($product) {
                $product->quantity -= $saleItem->quantity;
                $product->save();
            }
        }




        $this->clearCart();
        $this->payment_option = null;
        $this->dispatch('alert',
            type:'success',
            title:'Your sale has been created successfully'
        );

        $randomString = implode('', array_rand(array_flip($alphabet), 3));

        $pdfFilename = Carbon::now()->format('Y-m-d_H-i-s') . "_receipt_" . $randomString . ".pdf";

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $pdfFilename);

    }



    public function render()
    {
        $products = [];
        $this->updateTotals(); // Update totals on render

        if (strlen($this->search) < 2) {
            $products = Product::all();
        } else {
            $products = Product::where('name', 'like', '%' . $this->search . '%')->take(5)->get();
        }

        return view('livewire.add-sale', [
            "products" => $products
        ]);
    }
}
