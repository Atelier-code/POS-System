<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class ProductData implements FromCollection, WithHeadings, WithStyles, WithEvents
{
    public function collection()
    {
        return Product::select(
            'name',
            'cost_price',
            'selling_price',
            'quantity',
            'tax_rate'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Cost Price',
            'Selling Price',
            'Quantity',
            'Tax Rate'
        ];
    }

    /**
     * Apply bold style to header row
     */
    public function styles(Worksheet $sheet)
    {
        // Bold header row
        return [
            1 => ['font' => ['bold' => true]], // This is the heading row
        ];
    }

    /**
     * Add title row and additional styling
     */
    public function registerEvents(): array
    {
        $date = Carbon::now()->format('F j, Y');
        return [
            AfterSheet::class => function (AfterSheet $event) use ($date) {
                $sheet = $event->sheet->getDelegate();

                // Insert title row at the top
                $sheet->insertNewRowBefore(1, 1);
                $sheet->setCellValue('A1', "Product Stock as at $date");

                // Merge cells across the table width for the title
                $sheet->mergeCells('A1:G1');

                // Style title
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

                // Style heading row
                $sheet->getStyle('A2:G2')->getFont()->setBold(true);
                $sheet->getStyle('A2:G2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFFF00'); // Yellow background
            },
        ];
    }
}
