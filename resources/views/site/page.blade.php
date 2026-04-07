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
        $logoHeader = asset('asset/Wader.png');
        $menuSignImage = asset('asset/menu.png');
        $menuIcon1 = asset('asset/jenis layanan.png');
        $menuIcon2 = asset('asset/pengaduan.png');
        $menuIcon3 = asset('asset/pss.png');
        $menuIcon4 = asset('asset/stimo.png');
        $iconWebsite = asset('asset/web.png');
        $logoZonaIntegritas = asset('asset/logo-WBK.png');
        $supportLogo1 = asset('asset/logo bps.png');
        $supportLogo2 = asset('asset/pss.png');
        $supportLogo3 = asset('asset/pojok statistik.png');
        $supportLogo4 = asset('asset/RB-removebg-preview.png');
        $familyBanner = asset('asset/keluarga-bps.png');
        $iconWeb = asset('asset/www.png');
        $iconEmail = asset('asset/email.png');
        $iconWhatsapp = asset('asset/whatapp.png');
        $iconInstagram = asset('asset/instagram.png');
        $iconFacebook = asset('asset/facebook.png');
        $iconX = asset('asset/x.png');
        $iconYoutube = asset('asset/yt.png');

        $rawWhatsapp = (string) ($settings['contact_whatsapp'] ?? '');
        $whatsappDigits = preg_replace('/\D+/', '', $rawWhatsapp);
        if ($whatsappDigits && str_starts_with($whatsappDigits, '0')) {
            $whatsappDigits = '62'.substr($whatsappDigits, 1);
        }
        $whatsappLink = $whatsappDigits
            ? 'https://api.whatsapp.com/send/?phone='.$whatsappDigits.'&text&type=phone_number&app_absent=0'
            : '#';

        $menuCards = [

            ['label' => 'Jenis Layanan', 'url' => route('site.chat'), 'icon' => $menuIcon1, 'external' => false],
            ['label' => 'Pengaduan', 'url' => route('site.complaints'), 'icon' => $menuIcon2, 'external' => false],
            ['label' => 'Pembinaan Statistik Sektoral', 'url' => route('site.pss'), 'icon' => $menuIcon3, 'external' => false],
            ['label' => 'Statistik Mojokerto', 'url' => route('site.page', 'statistik-mojokerto'), 'icon' => $menuIcon4, 'external' => false],

        ];
    @endphp

    <header class="layout-header">
        <div class="layout-header-inner">
            <a href="{{ route('site.home') }}" class="brand-lockup">
                <img src="{{ $logoHeader }}" alt="BPS Kabupaten Mojokerto" class="brand-logo-header">
            </a>

            <nav class="layout-nav">
                <a href="{{ route('site.page', 'beranda') }}" class="layout-nav-link {{ $page->slug === 'beranda' ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('site.pst-center') }}" class="layout-nav-link {{ $page->slug === 'pst-center' ? 'active' : '' }}">PST Center</a>
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

        <section class="flex justify-center mt-10">
            <img src="{{ asset('asset/menu.png') }}" 
                 class="w-[34px] h-auto rounded-2xl">
        </section>

        <section class="service-blue-zone reveal-card" style="--delay: 140ms;">
            <span class="sparkle sparkle-left">✦</span>
            <span class="sparkle sparkle-left-sm">✦</span>
            <span class="sparkle sparkle-right">✦</span>
            <span class="sparkle sparkle-right-sm">✦</span>
            <div class="service-grid-reference">
                @foreach ($menuCards as $card)
                    <a href="{{ $card['url'] }}" @if($card['external']) target="_blank" rel="noopener noreferrer" @endif class="service-ref-card">
                        <span class="service-ref-icon-wrap">
                            <img src="{{ $card['icon'] }}" alt="{{ $card['label'] }}" class="service-ref-icon">
                        </span>
                        <span class="service-ref-label">{{ $card['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </section>

        <div class="h-8"></div>
        <section class="max-w-7xl mx-auto px-4 mt-10">
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- CARD 1 -->
        <div class="bg-orange-500 rounded-2xl overflow-hidden h-[350px] shadow-lg">
            <img src="{{ asset('asset/poster1.png') }}" class="w-full h-full object-cover">
        </div>

        <!-- CARD 2 -->
        <div class="bg-orange-500 rounded-2xl overflow-hidden h-[350px] shadow-lg">
            <img src="{{ asset('asset/poster2.jpeg') }}" class="w-full h-full object-cover">
        </div>

        <!-- CARD 3 -->
        <div class="bg-orange-500 rounded-2xl overflow-hidden h-[350px] shadow-lg">
            <img src="{{ asset('asset/poster3.jpeg') }}" class="w-full h-full object-cover">
        </div>

    </div>

        </section>

        <section class="support-banner-wrap" style="margin-top: 1.25rem;">
            <div class="support-banner-top" style="background: #8dc64f; padding: 1.45rem 1rem;">
                <div class="support-banner-top-inner" style="max-width: 1220px; margin: 0 auto; display: flex; justify-content: space-around; align-items: center; gap: 4.3rem; flex-wrap: wrap;">
                    <div class="support-head-item" style="display: flex; align-items: center; justify-content: center; gap: 1rem;">
                        <img src="{{ $iconWebsite }}" alt="Data Website" class="support-head-icon" style="width: clamp(255px, 32vw, 500px); height: auto; object-fit: contain;">
                    </div>
                    <div class="support-head-item" style="display: flex; align-items: center; justify-content: center; gap: 1rem;">
                        <img src="{{ $logoZonaIntegritas }}" alt="Zona Integritas" class="support-head-icon support-head-icon-badge" style="width: clamp(245px, 31vw, 485px); height: auto; object-fit: contain; transform: translateY(8px);">
                    </div>
                </div>
            </div>

            <div class="support-banner-bottom" style="background: #f39a34; padding: 1.1rem 1rem;">
                <div class="support-banner-bottom-inner" style="max-width: 1280px; margin: 0 auto; display: flex; justify-content: center; align-items: center; gap: 1.4rem; flex-wrap: wrap;">
                    <p class="support-by-text" style="margin: 0; color: #ffffff; font-family: 'Brush Script MT', 'Segoe Script', cursive; font-style: normal; font-size: clamp(2.1rem, 2.35vw, 2.6rem); font-weight: 400; line-height: 1;">Supported by :</p>
                    <div class="support-logo-row" style="display: flex; align-items: center; justify-content: center; gap: 0.85rem; flex-wrap: wrap;">
                        <img src="{{ $supportLogo1 }}" alt="BPS" class="support-logo-item" style="width: 62px; height: 62px; border-radius: 999px; object-fit: contain; background: #ffffff; padding: 0.24rem;">
                        <img src="{{ $supportLogo2 }}" alt="PSS" class="support-logo-item" style="width: 62px; height: 62px; border-radius: 999px; object-fit: contain; background: #ffffff; padding: 0.24rem;">
                        <img src="{{ $supportLogo3 }}" alt="Pojok Statistik" class="support-logo-item" style="width: 62px; height: 62px; border-radius: 999px; object-fit: contain; background: #ffffff; padding: 0.24rem;">
                        <img src="{{ $supportLogo4 }}" alt="Reformasi Birokrasi" class="support-logo-item" style="width: 62px; height: 62px; border-radius: 999px; object-fit: contain; background: #ffffff; padding: 0.24rem;">
                    </div>
                </div>
            </div>
        </section>

        <section style="background: #466633; padding: 1.2rem 0 0;">
            <div style="max-width: 1280px; margin: 0 auto; padding: 0 1rem;">
                <div style="background: #466633;">
                    <img src="{{ $familyBanner }}" alt="Keluarga BPS Kabupaten Mojokerto" style="display: block; width: 93%; height: auto; object-fit: cover; margin: 0 auto;">
                </div>
            </div>

            <div style="margin-top: 1rem;">
                <div style="max-width: 1280px; margin: 0 auto; padding: 0.9rem 1rem 1rem; display: flex; justify-content: space-between; align-items: center; gap: 1rem; flex-wrap: wrap;">
                    <p style="margin: 0; color: #ffffff; font-family: 'Brush Script MT', 'Segoe Script', cursive; font-size: clamp(1.9rem, 2.8vw, 3rem); font-weight: 400;">Jangan Lewatkan Informasi Terbaru Kami</p>

                    <div style="display: flex; align-items: center; gap: 0.7rem; flex-wrap: wrap;">
                        <a href="{{ $settings['instansi_link'] ?? '#' }}" target="_blank" rel="noopener noreferrer" style="display: inline-flex; width: 52px; height: 52px; border-radius: 999px; background: rgba(255, 255, 255, 0.08); align-items: center; justify-content: center; text-decoration: none;">
                            <img src="{{ $iconWeb }}" alt="Website" style="width: 42px; height: 42px; object-fit: contain;">
                        </a>
                        <a href="mailto:{{ $settings['contact_email'] ?? '' }}" style="display: inline-flex; width: 52px; height: 52px; border-radius: 999px; background: rgba(255, 255, 255, 0.08); align-items: center; justify-content: center; text-decoration: none;">
                            <img src="{{ $iconEmail }}" alt="Email" style="width: 42px; height: 42px; object-fit: contain;">
                        </a>
                        <a href="{{ $whatsappLink }}" target="_blank" rel="noopener noreferrer" style="display: inline-flex; width: 52px; height: 52px; border-radius: 999px; background: rgba(255, 255, 255, 0.08); align-items: center; justify-content: center; text-decoration: none;">
                            <img src="{{ $iconWhatsapp }}" alt="WhatsApp" style="width: 42px; height: 42px; object-fit: contain;">
                        </a>
                        <a href="{{ $settings['contact_instagram'] ?? '#' }}" target="_blank" rel="noopener noreferrer" style="display: inline-flex; width: 52px; height: 52px; border-radius: 999px; background: rgba(255, 255, 255, 0.08); align-items: center; justify-content: center; text-decoration: none;">
                            <img src="{{ $iconInstagram }}" alt="Instagram" style="width: 42px; height: 42px; object-fit: contain;">
                        </a>
                        <a href="{{ $settings['contact_facebook'] ?? '#' }}" target="_blank" rel="noopener noreferrer" style="display: inline-flex; width: 52px; height: 52px; border-radius: 999px; background: rgba(255, 255, 255, 0.08); align-items: center; justify-content: center; text-decoration: none;">
                            <img src="{{ $iconFacebook }}" alt="Facebook" style="width: 42px; height: 42px; object-fit: contain;">
                        </a>
                        <a href="https://x.com/bpsmojokerto" target="_blank" rel="noopener noreferrer" style="display: inline-flex; width: 52px; height: 52px; border-radius: 999px; background: rgba(255, 255, 255, 0.08); align-items: center; justify-content: center; text-decoration: none;">

                            <img src="{{ $iconX }}" alt="X" style="width: 42px; height: 42px; object-fit: contain;">
                        </a>
                        <a href="#" style="display: inline-flex; width: 52px; height: 52px; border-radius: 999px; background: rgba(255, 255, 255, 0.08); align-items: center; justify-content: center; text-decoration: none;">
                            <img src="{{ $iconYoutube }}" alt="YouTube" style="width: 42px; height: 42px; object-fit: contain;">
                        </a>
                    </div>
                </div>
            </div>
        </section>


    </main>
</body>
</html>