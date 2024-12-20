<?php

namespace App\Livewire;

use App\Models\Sale;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class RevenueChart extends Component
{
    public $userId = null;
    public $monthlySales = [];

    public function mount($id = null)
    {
        $this->userId = $id;
        $this->getLast12MonthsSales();
    }

    public function getLast12MonthsSales()
    {
        $currentMonth = Carbon::now()->startOfMonth();
        $months = [];

        for ($i = 0; $i < 12; $i++) {
            $monthName = $currentMonth->format('Y-m');
            $months[$monthName] = 0;
            $currentMonth->subMonth();
        }

        $salesQuery = Sale::whereBetween('created_at', [Carbon::now()->subMonths(12)->startOfMonth(), Carbon::now()->endOfMonth()])
            ->when($this->userId, function ($query) {
                return $query->where('user_id', $this->userId);
            });

        // Adjust the query depending on the database connection type
        if (DB::getDriverName() == 'pgsql') {
            $sales = $salesQuery->selectRaw('TO_CHAR(created_at, \'YYYY-MM\') as month, SUM(total) as total')
                ->groupBy('month')
                ->orderBy('month', 'ASC')
                ->get();
        } else {
            $sales = $salesQuery->selectRaw('strftime("%Y-%m", created_at) as month, SUM(total) as total')
                ->groupBy('month')
                ->orderBy('month', 'ASC')
                ->get();
        }

        foreach ($sales as $sale) {
            $months[$sale->month] = $sale->total;
        }

        $this->monthlySales = collect(array_reverse($months))->map(function ($total, $month) {
            return [
                'month' => $month,
                'total' => $total,
            ];
        })->values()->toArray();
    }

    public function render()
    {
        return view('livewire.revenue-chart');
    }
}
