<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class LaporanExport implements FromView, WithEvents, WithDrawings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('exports.stok', [
            'data' => $this->data
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Gabungkan sel untuk judul
                $sheet->getStyle('A1')->getAlignment()->setIndent(6); // Nilai bisa 1, 2, 3 dst.

                $sheet->mergeCells('A1:H1');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal('Left');

                $sheet->getStyle('A2')->getAlignment()->setIndent(6); // Nilai bisa 1, 2, 3 dst.

                $sheet->mergeCells('A2:H2');
                $sheet->getStyle('A2')->getAlignment()->setHorizontal('left');

                $sheet->getColumnDimension('A')->setWidth(4);
                $sheet->getColumnDimension('B')->setWidth(12);
                $sheet->getColumnDimension('C')->setWidth(12);
                $sheet->getColumnDimension('D')->setWidth(12);
                $sheet->getColumnDimension('E')->setWidth(15);
                $sheet->getColumnDimension('F')->setWidth(15);
                $sheet->getColumnDimension('G')->setWidth(15);
                $sheet->getColumnDimension('H')->setWidth(12);

                // ✅ Rata tengah header kolom (judul tabel)
                $sheet->getStyle('A4:H4')
                ->getAlignment()
                ->setHorizontal('center')
                ->setVertical('center');

                 // ✅ Rata tengah isi tabel (dari A5 ke bawah)
                $sheet->getStyle('A5:H' . $sheet->getHighestRow())
                ->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            }
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo');
        $drawing->setPath(public_path('logo.png'));
        $drawing->setHeight(45);
        $drawing->setCoordinates('A1'); // pindah ke A2 agar tidak menimpa A1
        $drawing->setOffsetX(0);
        $drawing->setOffsetY(0);

        return $drawing;
    }

}
