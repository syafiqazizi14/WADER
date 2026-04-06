<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSS - WADER</title>
    <meta name="description" content="Halaman Pembinaan Statistik Sektoral WADER Kabupaten Mojokerto.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="site-shell page-pss">
    @php
        $logoHeader = asset('asset/logo bps.png');
        $bgTop = asset('asset/bg atas.png');
        $bgBottom = asset('asset/bg bawah.png');
        $titleImage = asset('asset/tulisan-PSS.png');
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

        $pssMenus = [
            [
                'title' => 'Materi PSS',
                'image' => asset('asset/materi-PSS.png'),
                'url' => '#',
            ],
            [
                'title' => 'Daftar LO BPS',
                'image' => asset('asset/daftar LO PSS.png'),
                'url' => '#',
            ],
            [
                'title' => 'Jadwal Safari PSS',
                'image' => asset('asset/jadwal-safari-pss.png'),
                'url' => '#',
            ],
        ];
    @endphp

    <header class="layout-header">
        <div class="layout-header-inner">
            <a href="{{ route('site.home') }}" class="brand-lockup">
                <img src="{{ $logoHeader }}" alt="BPS Kabupaten Mojokerto" class="brand-logo-header">
            </a>

            <nav class="layout-nav">
                <a href="{{ route('site.page', 'beranda') }}" class="layout-nav-link">Beranda</a>
                <a href="{{ route('site.pst-center') }}" class="layout-nav-link">PST Center</a>
                <a href="{{ route('site.page', 'stimo-2-0') }}" class="layout-nav-link">STIMO 2.0</a>
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

    <main class="pss-main-wrap">
        <section class="pss-hero" style="background-image: url('{{ $bgTop }}');">
            <div class="pss-title-wrap reveal-card" style="--delay: 0ms;">
                <img src="{{ $titleImage }}" alt="Pembinaan Statistik Sektoral" class="pss-title-image">
            </div>
        </section>

        <section class="pss-menu-zone" style="background-image: url('{{ $bgBottom }}');">
            <div class="pss-menu-grid">
                @foreach ($pssMenus as $menu)
                    <a href="{{ $menu['url'] }}" class="pss-menu-card reveal-card" style="--delay: {{ ($loop->index + 1) * 100 }}ms;" aria-label="{{ $menu['title'] }}">
                        <img src="{{ $menu['image'] }}" alt="{{ $menu['title'] }}" class="pss-menu-image">
                    </a>
                @endforeach
            </div>
        </section>

        <section class="pss-bottom-strip">
            <div class="pss-bottom-inner">
                <p class="pss-bottom-title">Jangan Lewatkan Informasi Terbaru Kami</p>

                <div class="pss-social-row">
                    <a href="{{ $settings['instansi_link'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="pss-social-link" aria-label="Website">
                        <img src="{{ $iconWeb }}" alt="Website" class="pss-social-icon">
                    </a>
                    <a href="mailto:{{ $settings['contact_email'] ?? '' }}" class="pss-social-link" aria-label="Email">
                        <img src="{{ $iconEmail }}" alt="Email" class="pss-social-icon">
                    </a>
                    <a href="{{ $whatsappLink }}" target="_blank" rel="noopener noreferrer" class="pss-social-link" aria-label="WhatsApp">
                        <img src="{{ $iconWhatsapp }}" alt="WhatsApp" class="pss-social-icon">
                    </a>
                    <a href="{{ $settings['contact_instagram'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="pss-social-link" aria-label="Instagram">
                        <img src="{{ $iconInstagram }}" alt="Instagram" class="pss-social-icon">
                    </a>
                    <a href="{{ $settings['contact_facebook'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="pss-social-link" aria-label="Facebook">
                        <img src="{{ $iconFacebook }}" alt="Facebook" class="pss-social-icon">
                    </a>
                    <a href="https://x.com/bpsmojokerto" target="_blank" rel="noopener noreferrer" class="pss-social-link" aria-label="X">
                        <img src="{{ $iconX }}" alt="X" class="pss-social-icon">
                    </a>
                    <a href="#" class="pss-social-link" aria-label="YouTube">
                        <img src="{{ $iconYoutube }}" alt="YouTube" class="pss-social-icon">
                    </a>
                </div>
            </div>
        </section>
    </main>

    <style>
        .pss-main-wrap {
            background: #d4dce8;
        }

        .pss-hero {
            min-height: clamp(220px, 28vw, 330px);
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #d4dce8;
            background-repeat: no-repeat;
            background-position: center bottom;
            background-size: 100% auto;
        }

        .pss-title-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .pss-title-image {
            width: min(75vw, 560px);
            height: auto;
            object-fit: contain;
        }

        .pss-menu-zone {
            min-height: calc(100vh - 285px);
            background-color: #d4dce8;
            background-repeat: no-repeat;
            background-position: center top;
            background-size: 100% auto;
            margin-top: -1px;
            padding: clamp(2rem, 4.5vw, 3.4rem) 1rem clamp(2.8rem, 7vw, 5.2rem);
        }

        .pss-menu-grid {
            max-width: 1220px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: clamp(1.1rem, 2.8vw, 2.4rem);
            align-items: end;
            justify-items: center;
        }

        .pss-menu-card {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: transform 180ms ease;
        }

        .pss-menu-card:hover {
            transform: translateY(-5px);
        }

        .pss-menu-image {
            width: min(30vw, 360px);
            min-width: 230px;
            height: auto;
            object-fit: contain;
        }

        .pss-bottom-strip {
            background: #48642e;
            padding: 1.35rem 1rem 1.4rem;
            border-top: 1px solid rgba(255, 255, 255, 0.14);
        }

        .pss-bottom-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .pss-bottom-title {
            margin: 0;
            color: #ffffff;
            font-family: 'Brush Script MT', 'Segoe Script', cursive;
            font-size: clamp(2rem, 2.8vw, 3.1rem);
            font-weight: 400;
            line-height: 1;
        }

        .pss-social-row {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            flex-wrap: wrap;
        }

        .pss-social-link {
            display: inline-flex;
            width: 54px;
            height: 54px;
            border-radius: 999px;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            background: rgba(255, 255, 255, 0.04);
        }

        .pss-social-icon {
            width: 46px;
            height: 46px;
            object-fit: contain;
        }

        @media (max-width: 980px) {
            .pss-menu-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .pss-bottom-inner {
                justify-content: center;
            }

            .pss-bottom-title {
                text-align: center;
            }
        }

        @media (max-width: 720px) {
            .pss-menu-grid {
                grid-template-columns: 1fr;
            }

            .pss-menu-image {
                width: min(86vw, 350px);
                min-width: 0;
            }
        }
    </style>
</body>
</html>