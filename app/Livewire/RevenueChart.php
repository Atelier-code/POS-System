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
    public $viewType = 'day';

    public function mount($id = null)
    {
        $this->userId = $id;
        $this->getSalesData();
    }

    public function getSalesData()
    {
        if ($this->viewType === 'month') {
            $this->getLast12MonthsSales();
        } else {
            $this->getLast7DaysSales();
        }


        $this->dispatch('chartUpdated', ['sales' => $this->monthlySales]);
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
            ->when($this->userId, fn($query) => $query->where('user_id', $this->userId));

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

        $this->monthlySales = collect(array_reverse($months))->map(fn($total, $month) => ['month' => $month, 'total' => $total])->values()->toArray();
    }

    public function getLast7DaysSales()
    {
        $currentDay = Carbon::now();
        $days = [];

        for ($i = 0; $i < 7; $i++) {
            $dayName = $currentDay->format('D');
            $days[$dayName] = 0;
            $currentDay->subDay();
        }

        $salesQuery = Sale::whereBetween('created_at', [Carbon::now()->subDays(7)->startOfDay(), Carbon::now()->endOfDay()])
            ->when($this->userId, fn($query) => $query->where('user_id', $this->userId));

        if (DB::getDriverName() == 'pgsql') {
            $sales = $salesQuery->selectRaw('TO_CHAR(created_at, \'Dy\') as day, SUM(total) as total')
                ->groupBy('day')
                ->orderByRaw("MIN(created_at) ASC")
                ->get();
        } else {
            $sales = $salesQuery->selectRaw('strftime("%w", created_at) as day, SUM(total) as total')
                ->groupBy('day')
                ->orderByRaw("MIN(created_at) ASC")
                ->get();
        }


        foreach ($sales as $sale) {

            $dayName = Carbon::createFromFormat('w', $sale->day)->format('D');
            $days[$dayName] = $sale->total;
        }

        // Reverse so the order is from the oldest day to the newest
        $this->monthlySales = collect(array_reverse($days))
            ->map(fn($total, $day) => ['month' => $day, 'total' => $total])
            ->values()
            ->toArray();
    }


    public function toggleView()
    {
        $this->viewType = $this->viewType === 'month' ? 'day' : 'month';
        $this->reset('monthlySales'); // Reset data so Livewire detects the change
        $this->getSalesData();
        $this->dispatch('salesDataUpdated', $this->monthlySales);
    }


    public function render()
    {
        return view('livewire.revenue-chart', [
            'monthlySales' => $this->monthlySales,
        ]);
    }
}
