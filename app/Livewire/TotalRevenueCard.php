<?php

namespace App\Livewire;

use App\Models\Sale;
use Carbon\Carbon;
use Livewire\Component;

class TotalRevenueCard extends Component
{
    public $userId = null; // Optional user ID for filtering
    public $revenue = 0;

    public function mount($id = null)
    {
        $this->userId = $id;
        $this->day(); // Default to today's revenue
    }

    // Today
    public function day()
    {
        $this->revenue = Sale::whereDate('created_at', Carbon::today())
            ->when($this->userId, fn($query) => $query->where('user_id', $this->userId))
            ->sum('total');
    }

    // This Week
    public function week()
    {
        $this->revenue = Sale::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ])
            ->when($this->userId, fn($query) => $query->where('user_id', $this->userId))
            ->sum('total');
    }

    // This Month
    public function month()
    {
        $this->revenue = Sale::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->when($this->userId, fn($query) => $query->where('user_id', $this->userId))
            ->sum('total');
    }

    public function render()
    {
        return view('livewire.total-revenue-card', [
            'revenue' => $this->revenue,
        ]);
    }
}
