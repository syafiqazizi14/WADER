<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DataPelayananPengaduanExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Pelayanan' => new ChatRequestsExport('pelayanan'),
            'Pengaduan' => new ChatRequestsExport('pengaduan'),
        ];
    }
}
