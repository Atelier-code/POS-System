<?php

namespace App\Livewire;

use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsView extends Component
{
    use WithPagination;

    public $perPage = 12; // Define the number of items per page.
    public $viewType = 'all'; // Default view is all products.
    public $search = ''; // Search term for filtering products.

    public function mount()
    {
        // Optionally, initialize or prepare any data needed before rendering.
    }

    public function render()
    {
        // Start with base query
        $query = Product::query();

        // Apply search filter if search term exists
        if (!empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // Logic to load products based on the view type
        switch ($this->viewType) {
            case 'lowStock':
                $products = $query->whereColumn('quantity', '<=', 'low_stock')->paginate($this->perPage);
                break;
            case 'top':
                $products = $this->getTopProducts($query);
                break;
            case 'recentlyAdded':
                $products = $query->orderBy('created_at', 'desc')->paginate($this->perPage);
                break;
            case 'all':
            default:
                $products = $query->orderBy('created_at', 'desc')->paginate($this->perPage);
                break;
        }

        // Return the view with the products data
        return view('livewire.products-view', [
            'products' => $products
        ]);
    }

    private function getTopProducts($baseQuery)
    {
        // If search is active, we need to handle the join differently
        if (!empty($this->search)) {
            // For search with top products, we'll show products that match search and have sales
            return Product::select('products.*')
                ->join('sale_items', 'products.id', '=', 'sale_items.product_id')
                ->join('sales', 'sales.id', '=', 'sale_items.sale_id')
                ->whereBetween('sale_items.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->where('products.name', 'like', '%' . $this->search . '%')
                ->selectRaw('SUM(sale_items.quantity) as total_sales_quantity')
                ->groupBy('products.id')
                ->orderByDesc('total_sales_quantity')
                ->paginate($this->perPage);
        } else {
            // Original top products logic
            return Product::select('products.*')
                ->join('sale_items', 'products.id', '=', 'sale_items.product_id')
                ->join('sales', 'sales.id', '=', 'sale_items.sale_id')
                ->whereBetween('sale_items.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->selectRaw('SUM(sale_items.quantity) as total_sales_quantity')
                ->groupBy('products.id')
                ->orderByDesc('total_sales_quantity')
                ->paginate($this->perPage);
        }
    }

    // Method to change the view type.
    public function setViewType($type)
    {
        $this->viewType = $type;
        $this->resetPage(); // Reset pagination when changing view type
        // The render method will be automatically called when the component is updated.
    }

    // Method to clear search
    public function clearSearch()
    {
        $this->search = '';
        $this->resetPage();
    }

    // Method to update per page
    public function updatedPerPage()
    {
        $this->resetPage();
    }

    // Method to update search
    public function updatedSearch()
    {
        $this->resetPage();
    }
}
