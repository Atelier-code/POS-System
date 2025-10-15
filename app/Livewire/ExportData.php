<?php

namespace App\Livewire;

use App\Exports\ReturnsReportExport;
use App\Exports\SalesReportExport;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;

class ExportData extends Component
{
    public $startDate;
    public $endDate;
    public $exportSales = false;
    public $exportReturns = false;

    public function exportData()
    {
        if (!$this->startDate || !$this->endDate) {
            $this->dispatch('alert', type: 'error', title: 'Please select valid start date and end date');
            return;
        }

        if (!$this->exportSales && !$this->exportReturns) {
            $this->dispatch('alert', type: 'error', title: 'Select item you wish to export');
            return;
        }

        $date = Carbon::today()->format('Y-m-d');


        if ($this->exportSales && !$this->exportReturns) {
            return Excel::download(
                new SalesReportExport($this->startDate, $this->endDate),
                "Mighty_Jesus_POS_SalesReport_{$date}.xlsx"
            );
        }

        if ($this->exportReturns && !$this->exportSales) {
            return Excel::download(
                new ReturnsReportExport($this->startDate, $this->endDate),
                "Mighty_Jesus_POS_ReturnsReport_{$date}.xlsx"
            );
        }


        $salesExcel = Excel::raw(new SalesReportExport($this->startDate, $this->endDate), \Maatwebsite\Excel\Excel::XLSX);
        $returnsExcel = Excel::raw(new ReturnsReportExport($this->startDate, $this->endDate), \Maatwebsite\Excel\Excel::XLSX);


        $zip = new \ZipArchive();
        $tmpFile = tempnam(sys_get_temp_dir(), 'reports_zip_');
        $zip->open($tmpFile, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        $zip->addFromString("Sales_Report_{$date}.xlsx", $salesExcel);
        $zip->addFromString("Returns_Report_{$date}.xlsx", $returnsExcel);
        $zip->close();


        return response()->streamDownload(function () use ($tmpFile) {
            readfile($tmpFile);
            unlink($tmpFile);
        }, "Mighty_Jesus_POS_Reports_{$date}.zip");
    }

    public function render()
    {
        return view('livewire.export-data');
    }
}
