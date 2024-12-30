<?php


namespace App\Exports;

use App\Models\Sale;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DailySales implements FromView, ShouldAutoSize
{
    private $data;
    private $totalSale;
    private $totalTax;
    private $sub_total;
    private $date;

    public function __construct($type)
    {
        // Initialize properties
        $this->data = [];
        $this->totalSale = 0;
        $this->totalTax = 0;
        $this->sub_total = 0;

        switch ($type) {
            case 'd':
                // Daily sales query
                $sales = Sale::with('saleItem.product')
                    ->whereDate('created_at', Carbon::today())
                    ->get();
                $this->date = "Daily Sales Report for " . Carbon::today()->format('F j, Y');
                break;  // Add break to avoid falling through to next case

            case 'm':
                // Monthly sales query
                $sales = Sale::with('saleItem.product')
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->get();
                $this->date = "Monthly Sales Report for" . Carbon::today()->format('F Y');
                break;  // Add break to avoid falling through to next case

            default:
                // Default to daily sales query
                $sales = Sale::with('saleItem.product')
                    ->whereDate('created_at', Carbon::today())
                    ->get();
                $this->date = "Daily Sales Report for " . Carbon::today()->format('F j, Y');
                break;
        }

        // Populate data and calculate totals
        foreach ($sales as $sale) {
            $this->totalSale += $sale->total;
            $this->totalTax += $sale->vat;
            $this->sub_total += $sale->sub_total;

            foreach ($sale->saleItem as $item) {
                $this->data[] = [
                    'id' => $item->id,
                    'name' => $item->product->name ?? 'Unknown Product',
                    'quantity' => $item->quantity,
                    'price' => $item->price_at_purchase,
                    'sub_total' => $item->quantity * $item->price_at_purchase,
                    "tax_rate" => $item->product->tax_rate,
                    'tax' => ($item->quantity * $item->price_at_purchase) * ($item->product->tax_rate ?? 0) / 100,
                    'total' => ($item->quantity * $item->price_at_purchase) + (($item->quantity * $item->price_at_purchase) * ($item->product->tax_rate ?? 0) / 100),
                ];
            }
        }
    }

    public function view(): View
    {
        return view('exports.dailySalesReport', [
            'data' => $this->data,
            'totalSale' => $this->totalSale,
            'totalTax' => $this->totalTax,
            'date' => $this->date,
            'sub_total' => $this->sub_total,
        ]);
    }
}
