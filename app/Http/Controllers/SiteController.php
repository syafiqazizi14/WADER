<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\ServiceLink;
use App\Models\Setting;
use App\Models\StatistikMojokertoItem;
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
        ]);
    }

    public function show(string $slug)
    {
        // Halaman khusus untuk statistik-mojokerto
        if ($slug === 'statistik-mojokerto') {
            return view('site.statistik-mojokerto', [
                'items' => StatistikMojokertoItem::query()
                    ->where('is_active', true)
                    ->latest()
                    ->limit(12)
                    ->get(),
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

        return view('site.page', [
            'page' => $page,
            'serviceLinks' => ServiceLink::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get(),
            'settings' => Setting::query()->pluck('value', 'key'),
        ]);
    }
}
