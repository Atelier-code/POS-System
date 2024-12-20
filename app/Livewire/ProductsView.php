<?php

namespace App\Livewire;

use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsView extends Component
{
    use WithPagination;

    public $perPage = 10; // Define the number of items per page.
    public $viewType = 'all'; // Default view is low stock.

    public function mount()
    {
        // Optionally, initialize or prepare any data needed before rendering.
    }

    public function render()
    {
        // Logic to load products based on the view type
        switch ($this->viewType) {
            case 'lowStock':
                $products = $this->lowStock();
                break;
            case 'top':
                $products = $this->top();
                break;
            case 'recentlyAdded':
                $products = $this->recentlyAdded();
                break;
            case 'all':
                $products = Product::paginate($this->perPage);
                break;
            default:
                $products = $this->all();
        }

        // Return the view with the products data
        return view('livewire.products-view', [
            'products' => $products
        ]);
    }

    public function lowStock()
    {
        return Product::where('quantity', '<', 15)->paginate($this->perPage);
    }

    public function top()
    {
        return Product::select('products.*')
            ->join('sale_items', 'products.id', '=', 'sale_items.product_id')
            ->join('sales', 'sales.id', '=', 'sale_items.sale_id')
            ->whereBetween('sale_items.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->selectRaw('SUM(sale_items.quantity) as total_sales_quantity')
            ->groupBy('products.id')
            ->orderByDesc('total_sales_quantity')
            ->paginate($this->perPage);
    }

    public function recentlyAdded()
    {
        return Product::orderBy('created_at', 'desc')->paginate($this->perPage);
    }

    // Optionally, use this method to change the view type.
    public function setViewType($type)
    {
        $this->viewType = $type;
        // The render method will be automatically called when the component is updated.
    }
}
