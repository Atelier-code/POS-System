<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\SaleItem;
use Carbon\Carbon;
use Livewire\Component;

class ProductPerformance extends Component
{
    public $product;

    public function mount($product = null)
    {
        // Get product from route parameter if not passed directly
        if (!$product && request()->route('product')) {
            $this->product = Product::find(request()->route('product'));
        } else {
            $this->product = $product;
        }
    }

    public function render()
    {
        if (!$this->product) {
            return view('livewire.product-performance', [
                'salesData' => [],
                'weeklySales' => [],
                'monthlySales' => [],
                'totalRevenue' => 0,
                'totalQuantitySold' => 0
            ]);
        }

        // Get sales data for the last 7 days
        $weeklySales = SaleItem::where('product_id', $this->product->id)
            ->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
            ->selectRaw('DATE(created_at) as date, SUM(quantity) as total_quantity, SUM(total_price) as total_revenue')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Get monthly sales for the last 12 months
        $monthlySales = SaleItem::where('product_id', $this->product->id)
            ->whereBetween('created_at', [Carbon::now()->subMonths(12), Carbon::now()])
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(quantity) as total_quantity, SUM(total_price) as total_revenue')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Calculate total revenue and quantity sold
        $totalRevenue = SaleItem::where('product_id', $this->product->id)->sum('total_price');
        $totalQuantitySold = SaleItem::where('product_id', $this->product->id)->sum('quantity');

        return view('livewire.product-performance', [
            'weeklySales' => $weeklySales,
            'monthlySales' => $monthlySales,
            'totalRevenue' => $totalRevenue,
            'totalQuantitySold' => $totalQuantitySold
        ]);
    }
}
