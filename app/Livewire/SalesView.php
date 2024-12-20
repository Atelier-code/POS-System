<?php

namespace App\Livewire;

use App\Models\Sale;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class SalesView extends Component
{
    use WithPagination;

    public $startDate;
    public $endDate;

    // Initialize default dates (show all sales by default)
    public function mount()
    {
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
    }

    // Filter sales based on the selected date range
    public function filterSales()
    {
        $this->resetPage(); // Reset pagination when filtering
    }

    // Clear the date filters and show all sales
    public function clearFilter()
    {
        $this->startDate = null;
        $this->endDate = null;
        $this->resetPage(); // Reset pagination when clearing filters
    }

    // Render the view
    public function render()
    {
        // Fetch sales with default or filtered data and apply pagination
        $salesQuery = Sale::query()->orderBy('created_at', 'desc');

        // Apply the date filter if both start and end dates are set
        if ($this->startDate && $this->endDate) {
            $salesQuery->whereBetween('created_at', [$this->startDate, $this->endDate]);
        }

        // Paginate with 10 items per page
        $sales = $salesQuery->paginate(10);

        return view('livewire.sales-view', [
            'sales' => $sales
        ]);
    }
}
