<?php

namespace App\Livewire;

use App\Models\Sale;
use Carbon\Carbon;
use Livewire\Component;

class TotalSalesCard extends Component
{
    public $userId = null; // Renamed for clarity
    public $salesCount = 0;

    public function mount($id = null)
    {
        $this->userId = $id;
        $this->day(); // Default to today's sales count
    }

    public function day()
    {
        $this->salesCount = Sale::whereDate('created_at', Carbon::today())
            ->when($this->userId, function ($query) {
                return $query->where('user_id', $this->userId);
            })
            ->count();
    }

    public function month()
    {
        $this->salesCount = Sale::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->when($this->userId, function ($query) {
                return $query->where('user_id', $this->userId);
            })
            ->count();
    }

    public function year()
    {
        $this->salesCount = Sale::whereYear('created_at', Carbon::now()->year)
            ->when($this->userId, function ($query) {
                return $query->where('user_id', $this->userId);
            })
            ->count();
    }

    public function render()
    {
        return view('livewire.total-sales-card', [
            'sale' => $this->salesCount,
        ]);
    }
}
