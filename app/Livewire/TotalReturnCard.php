<?php

namespace App\Livewire;

use App\Models\Returns;
use Carbon\Carbon;
use Livewire\Component;

class TotalReturnCard extends Component
{
    public $userId = null; // Optional user ID for filtering
    public $no_returns = 0;

    public function mount($id = null)
    {
        $this->userId = $id;
        $this->day(); // Default to today's returns count
    }

    // Today's returns
    public function day()
    {
        $this->no_returns = Returns::whereDate('created_at', Carbon::today())
            ->when($this->userId, fn($query) => $query->where('user_id', $this->userId))
            ->count();
    }

    // This week's returns
    public function week()
    {
        $this->no_returns = Returns::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ])
            ->when($this->userId, fn($query) => $query->where('user_id', $this->userId))
            ->count();
    }

    // This month's returns
    public function month()
    {
        $this->no_returns = Returns::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->when($this->userId, fn($query) => $query->where('user_id', $this->userId))
            ->count();
    }

    public function render()
    {
        return view('livewire.total-return-card', [
            'returns' => $this->no_returns,
        ]);
    }
}
