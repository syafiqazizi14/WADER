<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembinaan Statistik Sektoral - WADER</title>
    <meta name="description" content="Halaman Pembinaan Statistik Sektoral WADER Kabupaten Mojokerto.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('asset/iconwader.png') }}">
    <link rel="shortcut icon" href="{{ asset('asset/iconwader.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('asset/iconwader.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('site.partials.topbar-transparent')
</head>
<body class="site-shell page-pss">
    @php
        $logoHeader = asset('asset/logo bps.png');
        $bgTop = asset('asset/bg-atas.png');
        $bgBottom = asset('asset/bg-bawah.png');
        $pssTitleGraphic = asset('asset/tulisan-PSS.png');

        $menuCards = [
            [
                'label' => 'Materi PSS',
                'image' => asset('asset/materi-PSS.png'),
                'url' => 'https://drive.google.com/drive/folders/1az8mdEwijiyoF2eWal3yT5jbwMC4wfK4',
            ],
            [
                'label' => 'Daftar LO BPS',
                'image' => asset('asset/daftar-LO-PSS.png'),
                'url' => 'https://drive.bps.go.id/s/5FtR8ASNrHyydFZ',
            ],
            [
                'label' => 'Jadwal Safari PSS',
                'image' => asset('asset/jadwal-safari-pss.png'),
                'url' => 'https://drive.google.com/file/d/1csrdLMOqkmWcF9klLDG9DTf4dIkzOrr6/view',
            ],
        ];
    @endphp

    <header class="layout-header">
        <div class="layout-header-inner">
            <a href="{{ route('site.home') }}" class="brand-lockup {{ request()->route()->getName() === 'site.page' && request()->route('slug') === 'statistik-mojokerto' ? 'active' : '' }}">
                <img src="{{ $logoHeader }}" alt="BPS Kabupaten Mojokerto" class="brand-logo-header">
            </a>

            <nav class="layout-nav">
                <a href="{{ route('site.page', 'beranda') }}" class="layout-nav-link">Beranda</a>
                <a href="{{ route('site.pst-center') }}" class="layout-nav-link">PST Center</a>
                <a href="{{ route('site.page', 'statistik-mojokerto') }}" class="layout-nav-link">STIMO 2.0</a>
                <a href="{{ route('site.page', 'backend') }}" class="layout-nav-link">Backend</a>
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

    <main class="pss-main">
        <img src="{{ $bgTop }}" alt="Latar atas PSS" class="pss-bg-top">
        <img src="{{ $bgBottom }}" alt="Latar bawah PSS" class="pss-bg-bottom">

        <section class="pss-stage">
            <article class="pss-card reveal-card" style="--delay: 0ms;">
                <img src="{{ $pssTitleGraphic }}" alt="Pembinaan Statistik Sektoral" class="pss-title-graphic">
                <div class="pss-menu-grid">
                    @foreach ($menuCards as $card)
                        <a href="{{ $card['url'] }}" class="pss-menu-link" aria-label="{{ $card['label'] }}" @if(strpos($card['url'], 'http') === 0) target="_blank" rel="noopener noreferrer" @endif>
                            <img src="{{ $card['image'] }}" alt="{{ $card['label'] }}" class="pss-menu-image">
                        </a>
                    @endforeach
                </div>
            </article>
        </section>
    </main>

    <section class="pss-footer-strip">
        <div class="pss-footer-inner">
            <p class="pss-footer-tagline">Jangan Lewatkan Informasi Terbaru Kami</p>
            <div class="pss-footer-icons">
                @php
                    $website = $settings['instansi_link'] ?? '#';
                    $email = $settings['contact_email'] ?? '#';
                    $whatsapp = $settings['contact_whatsapp'] ?? '';
                    $instagram = $settings['contact_instagram'] ?? '#';
                    $facebook = $settings['contact_facebook'] ?? '#';
                    $twitter = $settings['twitter'] ?? '#';
                    $youtube = $settings['youtube'] ?? '#';

                    // Format WhatsApp number
                    $rawWhatsapp = (string) $whatsapp;
                    $whatsappDigits = preg_replace('/\D+/', '', $rawWhatsapp);
                    if ($whatsappDigits && str_starts_with($whatsappDigits, '0')) {
                        $whatsappDigits = '62'.substr($whatsappDigits, 1);
                    }
                    $whatsappLink = $whatsappDigits
                        ? 'https://api.whatsapp.com/send/?phone='.$whatsappDigits.'&text&type=phone_number&app_absent=0'
                        : '#';
                @endphp

                <a href="{{ $website }}" target="_blank" rel="noopener" class="pss-footer-icon-btn" aria-label="Website" title="Website">
                    <img src="{{ asset('asset/www.png') }}" alt="Website" class="pss-footer-icon-img">
                </a>
                <a href="mailto:{{ str_replace('mailto:', '', $email) }}" class="pss-footer-icon-btn" aria-label="Email" title="Email">
                    <img src="{{ asset('asset/email.png') }}" alt="Email" class="pss-footer-icon-img">
                </a>
                <a href="{{ $whatsappLink }}" target="_blank" rel="noopener" class="pss-footer-icon-btn" aria-label="WhatsApp" title="WhatsApp">
                    <img src="{{ asset('asset/whatapp.png') }}" alt="WhatsApp" class="pss-footer-icon-img">
                </a>
                <a href="{{ $instagram }}" target="_blank" rel="noopener" class="pss-footer-icon-btn" aria-label="Instagram" title="Instagram">
                    <img src="{{ asset('asset/instagram.png') }}" alt="Instagram" class="pss-footer-icon-img">
                </a>
                <a href="{{ $facebook }}" target="_blank" rel="noopener" class="pss-footer-icon-btn" aria-label="Facebook" title="Facebook">
                    <img src="{{ asset('asset/facebook.png') }}" alt="Facebook" class="pss-footer-icon-img">
                </a>
                <a href="https://x.com/bpsmojokerto" target="_blank" rel="noopener" class="pss-footer-icon-btn" aria-label="X (Twitter)" title="X (Twitter)">
                    <img src="{{ asset('asset/x.png') }}" alt="X" class="pss-footer-icon-img">
                </a>
                <a href="{{ $youtube }}" target="_blank" rel="noopener" class="pss-footer-icon-btn" aria-label="YouTube" title="YouTube">
                    <img src="{{ asset('asset/yt.png') }}" alt="YouTube" class="pss-footer-icon-img">
                </a>
            </div>
        </div>
    </section>

    <style>
        .pss-main {
            min-height: calc(100vh - 82px);
            background: #cfd5df;
            padding: 20px 16px 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .pss-bg-top,
        .pss-bg-bottom {
            position: absolute;
            left: 0;
            width: 100%;
            pointer-events: none;
            user-select: none;
        }

        .pss-bg-top {
            top: 0;
            z-index: 1;
            background-position: center bottom;
            background-size: 100% auto;
            background-repeat: no-repeat;
        }

        .pss-bg-bottom {
            bottom: 0;
            z-index: 1;
            background-position: center top;
            background-size: 100% auto;
            background-repeat: no-repeat;
            margin-top: -1px;
        }

        .pss-stage {
            width: 100%;
            max-width: 1180px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
            transform: translateY(-44px);
        }

        .pss-card {
            width: 100%;
            background: transparent;
            padding: 0;
            text-align: center;
            color: #ffffff;
        }

        .pss-title-graphic {
            width: min(100%, 900px);
            height: auto;
            display: block;
            margin: 0 auto 12px;
        }

        .pss-menu-grid {
            margin-top: clamp(8px, 2vh, 20px);
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: clamp(12px, 1.7vw, 24px);
            justify-items: center;
            align-items: center;
        }

        .pss-menu-link {
            display: inline-flex;
            text-decoration: none;
            border-radius: 999px;
            transition: transform 220ms ease;
            animation: pssFloat 4.2s ease-in-out infinite;
            will-change: transform;
        }

        .pss-menu-link:nth-child(2) {
            animation-delay: 280ms;
        }

        .pss-menu-link:nth-child(3) {
            animation-delay: 520ms;
        }

        .pss-menu-link:hover {
            transform: translateY(-7px) scale(1.03);
        }

        .pss-menu-image {
            width: min(100%, 300px);
            max-height: 300px;
            object-fit: contain;
        }

        @keyframes pssFloat {
            0%,
            100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-8px);
            }
        }

        /* Footer Styles */
        .pss-footer-strip {
            background: linear-gradient(135deg, #48642e 0%, #3d5225 100%);
            padding: 28px 16px;
            position: relative;
            opacity: 0;
            animation: slideUpReveal 0.8s ease-out 0.3s forwards;
        }

        .pss-footer-inner {
            max-width: 1180px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .pss-footer-tagline {
            font-family: 'Brush Script MT', 'Segoe Script', cursive;
            color: white;
            font-size: clamp(20px, 4.5vw, 28px);
            font-weight: 400;
            margin: 0;
            flex: 0 0 auto;
            font-style: normal;
            letter-spacing: 0.5px;
        }

        .pss-footer-icons {
            display: flex;
            gap: clamp(10px, 2vw, 16px);
            flex-wrap: wrap;
            justify-content: center;
            flex: 0 0 auto;
        }

        .pss-footer-icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: clamp(40px, 7vw, 52px);
            height: clamp(40px, 7vw, 52px);
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            transition: all 300ms ease;
            color: white;
            text-decoration: none;
            border: 2px solid transparent;
            padding: 0;
        }

        .pss-footer-icon-img {
            width: 65%;
            height: 65%;
            display: block;
            object-fit: contain;
        }

        .pss-footer-icon-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-4px) scale(1.1);
        }

        @keyframes slideUpReveal {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 1024px) {
            .pss-stage {
                transform: translateY(-32px);
            }

            .pss-menu-grid {
                margin-top: 8px;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .pss-menu-image {
                width: min(100%, 265px);
                max-height: 265px;
            }
        }

        @media (max-width: 768px) {
            .pss-footer-inner {
                flex-direction: column;
                text-align: center;
            }

            .pss-footer-tagline {
                width: 100%;
                order: 1;
            }

            .pss-footer-icons {
                width: 100%;
                order: 2;
                justify-content: center;
            }
        }

        @media (max-width: 740px) {
            .pss-main {
                min-height: calc(100vh - 72px);
                padding: 14px 10px 24px;
            }

            .pss-stage {
                transform: translateY(-18px);
            }

            .pss-title-graphic {
                width: min(95%, 520px);
                margin-bottom: 6px;
            }

            .pss-menu-grid {
                margin-top: 2px;
                grid-template-columns: 1fr;
                gap: 8px;
            }

            .pss-menu-image {
                width: min(68vw, 240px);
                max-height: 240px;
            }
        }
    </style>
</body>
</html>

