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
        $days = collect();
        $now = Carbon::now();

        // Pre-fill last 7 days with zero totals
        for ($i = 6; $i >= 0; $i--) {
            $date = $now->copy()->subDays($i);
            $label = $date->format('D'); // e.g. Mon, Tue
            $days->put($label, 0);
        }

        $salesQuery = Sale::whereBetween('created_at', [
            Carbon::now()->subDays(6)->startOfDay(),
            Carbon::now()->endOfDay()
        ])
            ->when($this->userId, fn($query) => $query->where('user_id', $this->userId));

        $sales = $salesQuery->get();

        foreach ($sales as $sale) {
            $label = Carbon::parse($sale->created_at)->format('D');
            $days[$label] += $sale->total;
        }

        $this->monthlySales = $days->map(fn($total, $day) => [
            'month' => $day,
            'total' => $total
        ])->values()->toArray();
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
