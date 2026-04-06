<?php

namespace App\Exports;

use App\Models\Complaint;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ComplaintsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Complaint::query()
            ->latest('created_at')
            ->get()
            ->map(function (Complaint $item) {
                return [
                    'ID' => $item->id,
                    'Nama Lengkap' => $item->nama_lengkap,
                    'Email' => $item->email,
                    'Nomor Telp' => $item->nomor_telp,
                    'Nomor Identitas' => $item->nomor_identitas,
                    'Nama Instansi' => $item->nama_instansi,
                    'Isi Pengaduan' => $item->pengaduan,
                    'Status' => $this->statusLabel($item->status),
                    'Waktu Diterima' => $item->created_at->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Lengkap',
            'Email',
            'Nomor Telp',
            'Nomor Identitas',
            'Nama Instansi',
            'Isi Pengaduan',
            'Status',
            'Waktu Diterima',
        ];
    }

    private function statusLabel($status)
    {
        return match($status) {
            'pending' => 'Belum Diproses',
            'processed' => 'Sedang Diproses',
            'closed' => 'Selesai',
            default => $status,
        };
    }
}
