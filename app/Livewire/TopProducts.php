<?php

namespace App\Livewire;

use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;

class TopProducts extends Component
{
    public $top;

    public function mount()
    {
        $this->getWeeklyTopProducts();
    }

    public function getWeeklyTopProducts()
    {
        // Fetch top products by total quantity sold in the current week
        $this->top = Product::select('products.*')
            ->join('sale_items', 'products.id', '=', 'sale_items.product_id')
            ->join('sales', 'sales.id', '=', 'sale_items.sale_id')
            ->whereBetween('sale_items.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->selectRaw('SUM(sale_items.quantity) as total_sales_quantity')
            ->groupBy('products.id')
            ->orderByDesc('total_sales_quantity')
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.top-products', [
            'products' => $this->top
        ]);
    }
}
