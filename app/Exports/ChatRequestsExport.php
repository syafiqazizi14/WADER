<?php

namespace App\Exports;

use App\Models\ChatRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ChatRequestsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithTitle, WithCustomStartCell, WithEvents
{
    public function __construct(private ?string $category = null)
    {
    }

    public function collection()
    {
        return ChatRequest::query()
            ->when($this->category, function ($query) {
                $query->where('request_category', $this->category);
            })
            ->latest('submitted_at')
            ->get()
            ->map(function (ChatRequest $item) {
                $detailOnly = collect($item->service_answers)
                    ->values()
                    ->filter(fn ($value) => ! is_null($value) && $value !== '')
                    ->implode('; ');

                return [
                    'Waktu' => optional($item->submitted_at)?->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
                    'ID' => $item->id,
                    'Nama' => $item->requester_name,
                    'Email' => $item->email,
                    'HP' => $item->phone,
                    'Jenis Kelamin' => $item->gender,
                    'Umur' => $item->age,
                    'Instansi' => $item->institution,
                    'Alamat' => $item->address,
                    'Layanan' => $item->service_type,
                    'Detail Layanan' => $detailOnly ?: '-',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Waktu',
            'ID',
            'Nama',
            'Email',
            'HP',
            'Jenis Kelamin',
            'Umur',
            'Instansi',
            'Alamat',
            'Layanan',
            'Detail Layanan',
        ];
    }

    public function startCell(): string
    {
        return 'A3';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastRow = max(3, $sheet->getHighestRow());
                $endColumn = Coordinate::stringFromColumnIndex(count($this->headings()));
                $tableRange = 'A3:'.$endColumn.$lastRow;
                $title = match ($this->category) {
                    'pelayanan' => 'History Chat Layanan',
                    'pengaduan' => 'History Chat Pengaduan',
                    default => 'History Chat',
                };

                $sheet->mergeCells('A1:'.$endColumn.'1');
                $sheet->setCellValue('A1', $title);
                $sheet->setCellValue('A2', 'Diekspor pada '.now('Asia/Jakarta')->format('d M Y H:i:s').' WIB');

                $sheet->getStyle('A1:'.$endColumn.'1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                        'color' => ['argb' => 'FF0F172A'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $sheet->getStyle('A2:'.$endColumn.'2')->applyFromArray([
                    'font' => [
                        'size' => 10,
                        'color' => ['argb' => 'FF475569'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_LEFT,
                    ],
                ]);

                $sheet->getStyle('A3:'.$endColumn.'3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['argb' => 'FFFFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FF1D4ED8'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $sheet->getStyle($tableRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FFD1D5DB'],
                        ],
                    ],
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_TOP,
                    ],
                ]);

                $sheet->setAutoFilter('A3:'.$endColumn.'3');
                $sheet->freezePane('A4');
            },
        ];
    }

    public function title(): string
    {
        return match ($this->category) {
            'pelayanan' => 'Layanan',
            'pengaduan' => 'Pengaduan',
            default => 'Semua Chat',
        };
    }
}
