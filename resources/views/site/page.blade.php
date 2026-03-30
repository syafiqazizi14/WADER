<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->title }} - WADER</title>
    <meta name="description" content="{{ $page->meta_description }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="site-shell page-{{ $page->slug }}">
    @php
        $logoMain = asset('asset/Wader.png');
        $logoHeader = asset('asset/logo bps.png');
        $menuSignImage = asset('asset/menu.png');
        $menuIcon1 = asset('asset/jenis layanan.png');
        $menuIcon2 = asset('asset/pengaduan.png');
        $menuIcon3 = asset('asset/pss.png');
        $menuIcon4 = asset('asset/stimo.png');

        $menuCards = [
            ['label' => 'Jenis Layanan', 'url' => route('site.page', 'pst-center'), 'icon' => $menuIcon1],
            ['label' => 'Pengaduan', 'url' => 'https://tripetto.app/run/P0HWPTK3JJ', 'icon' => $menuIcon2],
            ['label' => 'Pembinaan Statistik Sektoral', 'url' => route('site.page', 'pst-center'), 'icon' => $menuIcon3],
            ['label' => 'Statistik Mojokerto', 'url' => route('site.page', 'stimo-2-0'), 'icon' => $menuIcon4],
        ];
    @endphp

    <header class="layout-header">
        <div class="layout-header-inner">
            <a href="{{ route('site.home') }}" class="brand-lockup">
                <img src="{{ $logoHeader }}" alt="BPS Kabupaten Mojokerto" class="brand-logo-header">
            </a>

            <nav class="layout-nav">
                <a href="{{ route('site.page', 'beranda') }}" class="layout-nav-link {{ $page->slug === 'beranda' ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('site.page', 'pst-center') }}" class="layout-nav-link {{ $page->slug === 'pst-center' ? 'active' : '' }}">PST Center</a>
                <a href="{{ route('site.page', 'stimo-2-0') }}" class="layout-nav-link {{ $page->slug === 'stimo-2-0' ? 'active' : '' }}">STIMO 2.0</a>
                <a href="{{ route('site.page', 'backend') }}" class="layout-nav-link {{ $page->slug === 'backend' ? 'active' : '' }}">Backend</a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="layout-nav-link">Admin</a>
                @else
                    <a href="{{ route('login') }}" class="layout-nav-link">Login</a>
                @endauth
                <a href="#" class="layout-search-btn" aria-label="Cari">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="layout-search-icon">
                        <path d="M21 21L16.7 16.7M18 11C18 14.866 14.866 18 11 18C7.13401 18 4 14.866 4 11C4 7.13401 7.13401 4 11 4C14.866 4 18 7.13401 18 11Z" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero-layout-stage">
            <div class="corner-band corner-band-top-right"></div>
            <div class="corner-band corner-band-bottom-left"></div>

            <div class="hero-layout-center reveal-card" style="--delay: 0ms;">
                <img src="{{ $logoMain }}" alt="WADER" class="hero-main-logo">
                <p class="hero-subtitle">WARUNG DATA KABUPATEN MOJOKERTO</p>
            </div>
        </section>

        <section class="service-blue-zone reveal-card" style="--delay: 140ms;">
            <span class="sparkle sparkle-left">✦</span>
            <span class="sparkle sparkle-left-sm">✦</span>
            <span class="sparkle sparkle-right">✦</span>
            <span class="sparkle sparkle-right-sm">✦</span>
            <div class="service-grid-reference">
                @foreach ($menuCards as $card)
                    <a href="{{ $card['url'] }}" target="_blank" class="service-ref-card">
                        <span class="service-ref-icon-wrap">
                            <img src="{{ $card['icon'] }}" alt="{{ $card['label'] }}" class="service-ref-icon">
                        </span>
                        <span class="service-ref-label">{{ $card['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="content-followup-wrap">
            <div class="content-followup-head">
                <h1 class="content-followup-title">{{ $page->title }}</h1>
                @if ($page->meta_description)
                    <p class="content-followup-meta">{{ $page->meta_description }}</p>
                @endif
            </div>

            @forelse ($page->sections as $section)
                <article class="content-followup-card reveal-card" style="--delay: {{ ($loop->index + 2) * 70 }}ms;">
                    <div class="content-followup-body">
                        <p class="content-tag">{{ strtoupper($section->type) }}</p>
                        @if ($section->title)
                            <h2 class="content-title">{{ $section->title }}</h2>
                        @endif
                        @if ($section->content)
                            <div class="content-text">{!! nl2br(e($section->content)) !!}</div>
                        @endif
                        @if ($section->button_label && $section->button_url)
                            <a href="{{ $section->button_url }}" target="_blank" class="content-cta">{{ $section->button_label }}</a>
                        @endif
                    </div>
                    @if ($section->media && str_starts_with((string) $section->media->mime_type, 'image/'))
                        <div class="content-media-shell">
                            <img src="{{ asset('storage/'.$section->media->file_path) }}" alt="{{ $section->media->alt_text }}" class="content-media-img">
                        </div>
                    @endif
                </article>
            @empty
                <article class="content-followup-card reveal-card" style="--delay: 210ms;">
                    <p class="content-empty">Belum ada section aktif untuk halaman ini. Silakan tambahkan dari panel admin.</p>
                </article>
            @endforelse
        </section>
    </main>

    <footer class="site-footer-wrap">
        <div class="site-footer-inner">
            <p class="site-footer-title">WADER 3516</p>
            <p class="site-footer-meta">Email: {{ $settings['contact_email'] ?? '-' }}</p>
            <div class="site-footer-links">
                @if (!empty($settings['contact_whatsapp']))<a href="{{ $settings['contact_whatsapp'] }}" target="_blank" class="footer-link-chip">WhatsApp</a>@endif
                @if (!empty($settings['contact_instagram']))<a href="{{ $settings['contact_instagram'] }}" target="_blank" class="footer-link-chip">Instagram</a>@endif
                @if (!empty($settings['contact_facebook']))<a href="{{ $settings['contact_facebook'] }}" target="_blank" class="footer-link-chip">Facebook</a>@endif
                @if (!empty($settings['instansi_link']))<a href="{{ $settings['instansi_link'] }}" target="_blank" class="footer-link-chip">Website Instansi</a>@endif
            </div>
        </div>
    </footer>
</body>
</html>
