<?php

namespace App\Http\Controllers;

use App\Models\Setting;

class SiteComplaintController extends Controller
{
    public function show()
    {
        return view('site.chat', [
            'settings' => Setting::query()->pluck('value', 'key'),
            'requestCategory' => 'pengaduan',
            'pageTitle' => 'Pengaduan',
            'pageDescription' => 'Saluran pengaduan berbasis chat untuk menyampaikan laporan kepada BPS Kabupaten Mojokerto.',
            'headingTitle' => 'Pengaduan',
            'headingDescription' => 'Silakan isi data singkat lalu sampaikan pengaduan Anda. Laporan akan masuk ke histori chat admin.',
        ]);
    }
}
