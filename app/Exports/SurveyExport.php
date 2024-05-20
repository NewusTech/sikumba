<?php

namespace App\Exports;

use App\Models\Survey;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SurveyExport implements FromView, WithHeadings, WithStyles
{
    use Exportable;

    protected $search;
    protected $dateawal;
    protected $dateakhir;
    protected $rating;

    public function __construct($search, $dateawal, $dateakhir, $rating)
    {
        $this->search = $search;
        $this->dateawal = $dateawal;
        $this->dateakhir = $dateakhir;
        $this->rating = $rating;
    }

    public function view(): View
    {
        $survey = Survey::query();

        if ($this->search) {
            $survey->where('name', 'like', "%{$this->search}%");
        }

        if ($this->dateawal) {
            $survey->where('created_at', '>=', "{$this->dateawal}");
        }

        if ($this->dateakhir) {
            $survey->where('created_at', '<=', "{$this->dateakhir}");
        }

        if ($this->rating) {
            $survey->where('rating', $this->rating);
        }

        $survey = $survey->orderBy('created_at', 'desc')->get();

        return view('exports.survey', [
            'survey' => $survey
        ]);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Telepon',
            'Email',
            'Alamat',
            'Rating',
            'Comment',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Mendapatkan baris terakhir (jumlah data + baris header)
        $lastRow = $sheet->getHighestRow();

        // Mendapatkan kolom terakhir (jumlah kolom)
        $lastColumn = $sheet->getHighestColumn();

        // Merge cell untuk judul
        $sheet->mergeCells('A1:F1');
        $sheet->mergeCells('G1:Z1');
        // Isi judul
        $sheet->setCellValue('A1', 'SURVEY KEPUASAN PELANGGAN');
        $sheet->setCellValue('H1', ' ');
        // Mengatur alignment untuk judul
        $sheet->getStyle('A1')->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getStyle('A1')->getFont()->setSize(16); // Sesuaikan ukuran font di sini
        $sheet->getRowDimension(1)->setRowHeight(25);

        $headerRowDimension1 = $sheet->getRowDimension(1); // Baris pertama
        $headerRowDimension1->setRowHeight(40);

        // Menambahkan border ke seluruh sel
        $range = 'A2:' . $lastColumn . $lastRow;
        $sheet->getStyle($range)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // Mengatur alignment untuk header tabel
        $headerRange = 'A2:' . $lastColumn . '2'; // Asumsi header berada di baris pertama
        $sheet->getStyle($headerRange)->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'DDDDDD'], // Warna abu-abu
            ],
        ]);

        // Meninggikan sedikit tinggi kolom header
        $headerRowDimension = $sheet->getRowDimension(2); // Baris pertama
        $headerRowDimension->setRowHeight(25); // Menetapkan tinggi baris menjadi 25 (sesuaikan dengan kebutuhan)

        // Mengatur alignment untuk tubuh tabel
        $bodyRange = 'A3:' . $lastColumn . $lastRow; // Asumsi tubuh tabel dimulai dari baris kedua
        $sheet->getStyle($bodyRange)->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->getColumnDimension('N')->setAutoSize(true);
    }
}
