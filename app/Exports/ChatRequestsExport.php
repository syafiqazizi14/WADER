<?php

namespace App\Exports;

use App\Models\ChatRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ChatRequestsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function __construct(private ?string $category = null)
    {
    }

    public function collection()
    {
        return ChatRequest::query()
            ->when($this->category, function ($query) {
                $query->where('service_type', $this->category);
            })
            ->latest('submitted_at')
            ->get()
            ->map(function (ChatRequest $item) {
                return [
                    'ID' => $item->id,
                    'Nama' => $item->requester_name,
                    'Email' => $item->email,
                    'HP' => $item->phone,
                    'Jenis Kelamin' => $item->gender,
                    'Umur' => $item->age,
                    'Instansi' => $item->institution,
                    'Alamat' => $item->address,
                    'Layanan' => $item->service_type,
                    'Detail Layanan' => $item->service_answers_text,
                    'Status' => $item->status,
                    'Waktu Submit' => optional($item->submitted_at)->format('Y-m-d H:i:s'),
                ];
            });
    }

    public function headings(): array
    {
        return [
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
            'Status',
            'Waktu Submit',
        ];
    }
}
