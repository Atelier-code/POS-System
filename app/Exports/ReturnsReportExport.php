<?php

namespace App\Exports;

use App\Models\Returns;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;

class ReturnsReportExport implements FromView, ShouldAutoSize
{
    private $data;
    private $totalReturnedValue;
    private $totalQuantity;
    private $dateRange;

    public function __construct($startDate, $endDate)
    {
        $this->data = [];
        $this->totalReturnedValue = 0;
        $this->totalQuantity = 0;

        $start = Carbon::parse($startDate)->startOfDay();
        $end = Carbon::parse($endDate)->endOfDay();
        $this->dateRange = "Returns Report from " . $start->format('F j, Y') . " to " . $end->format('F j, Y');

        $returns = Returns::with('product')
            ->whereBetween('created_at', [$start, $end])
            ->get();

        $aggregated = [];

        foreach ($returns as $return) {
            $product = $return->product;
            $productName = $product->name ?? 'Unknown Product';
            $reason = $return->reason;
            $totalValue = $return->quantity * $return->price_at_purchase;

            if (!isset($aggregated[$productName])) {
                $aggregated[$productName] = [
                    'name' => $productName,
                    'total_quantity' => 0,
                    'total_value' => 0,
                    'reasons' => [
                        'defective' => 0,
                        'wrong_size' => 0,
                        'changed_mind' => 0,
                        'other' => 0,
                    ],
                ];
            }

            $aggregated[$productName]['total_quantity'] += $return->quantity;
            $aggregated[$productName]['total_value'] += $totalValue;
            $aggregated[$productName]['reasons'][$reason] += $return->quantity;

            $this->totalReturnedValue += $totalValue;
            $this->totalQuantity += $return->quantity;
        }

        $this->data = array_values($aggregated);
    }

    public function view(): View
    {
        return view('exports.returnsReport', [
            'data' => $this->data,
            'totalReturnedValue' => $this->totalReturnedValue,
            'totalQuantity' => $this->totalQuantity,
            'date' => $this->dateRange,
        ]);
    }
}
