<?php

namespace App\Livewire;

use App\Models\Returns;
use Carbon\Carbon;
use Livewire\Component;

class TotalReturnCard extends Component
{
    public $userId = null; // Optional user ID for filtering
    public $no_returns = 0;

    /**
     * Mount the component with optional user filtering.
     *
     * @param int|null $userId
     */
    public function mount($id = null)
    {
        $this->userId = $id;
        $this->day(); // Default to today's returns count
    }

    /**
     * Get today's returns count.
     */
    public function day()
    {
        $this->no_returns = Returns::whereDate('created_at', Carbon::today())
            ->when($this->userId, fn($query) => $query->where('user_id', $this->userId))
            ->count();
    }

    /**
     * Get this month's returns count.
     */
    public function month()
    {
        $this->no_returns = Returns::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->when($this->userId, fn($query) => $query->where('user_id', $this->userId))
            ->count();
    }

    /**
     * Get this year's returns count.
     */
    public function year()
    {
        $this->no_returns = Returns::whereYear('created_at', Carbon::now()->year)
            ->when($this->userId, fn($query) => $query->where('user_id', $this->userId))
            ->count();
    }

    /**
     * Render the Livewire view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.total-return-card', [
            'returns' => $this->no_returns,
        ]);
    }
}
