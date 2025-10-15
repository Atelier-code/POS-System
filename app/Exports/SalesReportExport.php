<?php

namespace App\Exports;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;

class SalesReportExport implements FromView, ShouldAutoSize
{
    private $data;
    private $totalSale;
    private $totalTax;
    private $sub_total;
    private $dateRange;

    public function __construct($startDate, $endDate)
    {
        $this->data = [];
        $this->totalSale = 0;
        $this->totalTax = 0;
        $this->sub_total = 0;

        $start = Carbon::parse($startDate)->startOfDay();
        $end = Carbon::parse($endDate)->endOfDay();
        $this->dateRange = "Sales Report from " . $start->format('F j, Y') . " to " . $end->format('F j, Y');

        $sales = Sale::with('saleItem.product')
            ->whereBetween('created_at', [$start, $end])
            ->get();

        $aggregated = [];

        foreach ($sales as $sale) {
            $this->totalSale += $sale->total;
            $this->totalTax += $sale->vat;
            $this->sub_total += $sale->sub_total;

            foreach ($sale->saleItem as $item) {
                $product = $item->product;
                $productName = $product->name ?? 'Unknown Product';
                $taxRate = $product->tax_rate ?? 0;
                $subTotal = $item->quantity * $item->price_at_purchase;
                $taxAmount = $subTotal * $taxRate / 100;
                $total = $subTotal + $taxAmount;

                // Aggregate by product name
                if (!isset($aggregated[$productName])) {
                    $aggregated[$productName] = [
                        'name' => $productName,
                        'quantity' => 0,
                        'price' => $item->price_at_purchase,
                        'sub_total' => 0,
                        'tax_rate' => $taxRate,
                        'tax' => 0,
                        'total' => 0,
                    ];
                }

                $aggregated[$productName]['quantity'] += $item->quantity;
                $aggregated[$productName]['sub_total'] += $subTotal;
                $aggregated[$productName]['tax'] += $taxAmount;
                $aggregated[$productName]['total'] += $total;
            }
        }

        $this->data = array_values($aggregated);
    }

    public function view(): View
    {
        return view('exports.dailySalesReport', [
            'data' => $this->data,
            'totalSale' => $this->totalSale,
            'totalTax' => $this->totalTax,
            'sub_total' => $this->sub_total,
            'date' => $this->dateRange,
        ]);
    }
}
