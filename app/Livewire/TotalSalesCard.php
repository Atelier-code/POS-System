<?php

namespace App\Livewire;

use App\Models\Sale;
use Carbon\Carbon;
use Livewire\Component;

class TotalSalesCard extends Component
{
    public $userId = null;
    public $salesCount = 0;

    public function mount($id = null)
    {
        $this->userId = $id;
        $this->day(); // Default to today's sales count
    }

    // Today
    public function day()
    {
        $this->salesCount = Sale::whereDate('created_at', Carbon::today())
            ->when($this->userId, fn($query) => $query->where('user_id', $this->userId))
            ->count();
    }

    // This Week
    public function week()
    {
        $this->salesCount = Sale::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ])
            ->when($this->userId, fn($query) => $query->where('user_id', $this->userId))
            ->count();
    }

    // This Month
    public function month()
    {
        $this->salesCount = Sale::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->when($this->userId, fn($query) => $query->where('user_id', $this->userId))
            ->count();
    }

    public function render()
    {
        return view('livewire.total-sales-card', [
            'sale' => $this->salesCount,
        ]);
    }
}
