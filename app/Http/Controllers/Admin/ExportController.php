<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DataPelayananPengaduanExport;
use App\Http\Controllers\Controller;

class ExportController extends Controller
{
    public function pelayananPengaduan()
    {
        $filename = 'history-chat-'.now('Asia/Jakarta')->format('Ymd-His').'.xlsx';

        return app('excel')->download(new DataPelayananPengaduanExport(), $filename);
    }
}