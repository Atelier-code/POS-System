<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TopEmployees extends Component
{
    public $top;

    public function mount()
    {
        $this->getTopEmployees();
    }

    public function getTopEmployees()
    {
        // Get the current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Fetch top employees based on total revenue generated in the current month
        $this->top = User::select('users.id', 'users.name', 'users.role')
            ->join('sales', 'users.id', '=', 'sales.user_id')
            ->whereMonth('sales.created_at', $currentMonth)
            ->whereYear('sales.created_at', $currentYear)
            ->selectRaw('SUM(sales.total) as total_revenue, COUNT(sales.id) as total_sales')
            ->groupBy('users.id', 'users.name', 'users.role')
            ->orderByDesc('total_revenue')
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.top-employees', [
            'employees' => $this->top
        ]);
    }
}
