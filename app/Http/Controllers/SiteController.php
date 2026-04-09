<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageSection;
use App\Models\Setting;
use Illuminate\Database\QueryException;

class SiteController extends Controller
{
    public function home()
    {
        return $this->show('beranda');
    }

    public function chat()
    {
        return view('site.chat', [
            'settings' => Setting::query()->pluck('value', 'key'),
            'requestCategory' => 'pelayanan',
            'pageTitle' => 'Jenis Pelayanan',
            'pageDescription' => 'Layanan chatbot interaktif untuk memilih jenis pelayanan WADER.',
            'headingTitle' => 'Jenis Pelayanan',
            'headingDescription' => 'Silakan isi data singkat lalu pilih jenis pelayanan. Chat ini akan langsung diteruskan ke petugas BPS Kabupaten Mojokerto.',
        ]);
    }

    public function pss()
    {
        return view('site.pss', [
            'settings' => Setting::query()->pluck('value', 'key'),
        ]);
    }

    public function show(string $slug)
    {
        if ($slug === 'statistik-mojokerto') {
            $items = PageSection::query()
                ->whereHas('page', function ($query) {
                    $query->where('slug', 'statistik-mojokerto');
                })
                ->where('is_active', true)
                ->whereNotNull('media_id')
                ->with(['media', 'thumbnailMedia'])
                ->orderBy('sort_order')
                ->limit(12)
                ->get()
                ->filter(function (PageSection $section) {
                    return $section->media && str_starts_with((string) $section->media->mime_type, 'image/');
                })
                ->map(function (PageSection $section) {
                    $media = $section->media;
                    $thumbnailMedia = $section->thumbnailMedia;
                    $mainImageUrl = $media ? asset('storage/'.$media->file_path) : '';
                    $thumbnailImageUrl = ($thumbnailMedia && str_starts_with((string) $thumbnailMedia->mime_type, 'image/'))
                        ? asset('storage/'.$thumbnailMedia->file_path)
                        : $mainImageUrl;

                    return (object) [
                        'title' => $section->title
                            ?: ($media?->alt_text ?: pathinfo((string) $media?->file_name, PATHINFO_FILENAME)),
                        'spotlight_text' => $section->spotlight_text ?: 'Lihat statistik lengkap',
                        'thumbnail_url' => $thumbnailImageUrl,
                        'main_image_url' => $mainImageUrl,
                    ];
                })
                ->values();

            return view('site.statistik-mojokerto', [
                'items' => $items,
                'settings' => Setting::query()->pluck('value', 'key'),
            ]);
        }

        // Halaman khusus PST Center
        if ($slug === 'pst-center') {
            return view('site.pst-center', [
                'settings' => Setting::query()->pluck('value', 'key'),
            ]);
        }

        try {
            $page = Page::query()
                ->where('slug', $slug)
                ->where('is_published', true)
                ->with(['sections' => function ($query) {
                    $query->where('is_active', true)->orderBy('sort_order');
                }, 'sections.media'])
                ->first();
        } catch (QueryException) {
            return view('welcome');
        }

        if (! $page) {
            return view('welcome');
        }

        if ($slug === 'backend') {
            return view('site.backend', [
                'page' => $page,
                'settings' => Setting::query()->pluck('value', 'key'),
            ]);
        }

        return view('site.page', [
            'page' => $page,
            'settings' => Setting::query()->pluck('value', 'key'),
        ]);
    }
}
