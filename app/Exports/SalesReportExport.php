<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SalesReportExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithTitle
{
    protected $startDate;
    protected $endDate;
    protected $user;

    public function __construct($startDate, $endDate, $user = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->user = $user;
    }

    public function title(): string
    {
        return 'Sales Report';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Project::with(['lead'])
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->latest();

        // Filter by user role
        if ($this->user && $this->user->isSales()) {
            $query->where('user_id', $this->user->id);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Date',
            'Project Name',
            'Customer',
            'Status',
            'Total Value (Rp)',
        ];
    }

    public function map($project): array
    {
        static $rowNumber = 0;
        $rowNumber++;

        return [
            $rowNumber,
            $project->created_at->format('d-m-Y'),
            $project->name,
            $project->lead->name ?? '-',
            ucfirst(str_replace('_', ' ', $project->status)),
            $project->total_amount,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 15,
            'C' => 30,
            'D' => 25,
            'E' => 18,
            'F' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4F46E5']
                ],
                'alignment' => ['horizontal' => 'center'],
            ],
            'F' => ['alignment' => ['horizontal' => 'right']],
            'A' => ['alignment' => ['horizontal' => 'center']],
            'E' => ['alignment' => ['horizontal' => 'center']],
        ];
    }
}
