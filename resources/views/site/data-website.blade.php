<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Website - WADER</title>
    <meta name="description" content="Halaman Data Website WADER">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Anton&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('site.partials.topbar-transparent')
    <style>
        .page-data-website .layout-header {
            background: transparent !important;
            backdrop-filter: none !important;
            border: none !important;
            box-shadow: none !important;
        }
        .page-data-website .layout-header.is-scrolled {
            background: #ffffff !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08) !important;
        }
    </style>
</head>
<body class="site-shell page-data-website">
    @php
        $logoHeader = asset('asset/logo bps.png');
        $bookPoster = asset('asset/cover2.png');
        $publicationCover = asset('asset/cover.png');
        $showcaseBg = asset('asset/bg3.jpg');
        $bottomLandscape = asset('asset/bg-bawah.png');
        $iconWeb = asset('asset/www.png');
        $iconEmail = asset('asset/email.png');
        $iconWhatsApp = asset('asset/whatapp.png');
        $iconInstagram = asset('asset/instagram.png');
        $iconFacebook = asset('asset/facebook.png');
        $iconX = asset('asset/x.png');
        $iconYouTube = asset('asset/yt.png');
    @endphp

    <header class="layout-header">
        <div class="layout-header-inner">
            <a href="{{ route('site.home') }}" class="brand-lockup active">
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
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="layout-search-icon" aria-hidden="true">
                        <path d="M21 21L16.7 16.7M18 11C18 14.866 14.866 18 11 18C7.13401 18 4 14.866 4 11C4 7.13401 7.13401 4 11 4C14.866 4 18 7.13401 18 11Z" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </nav>
        </div>
    </header>

    <main class="data-website-page">
        <section class="data-website-hero">
            <div class="data-website-hero-inner">
                <h1>DATA WEBSITE</h1>
            </div>
        </section>

        <section class="data-website-showcase" style="background-image: url('{{ $showcaseBg }}');">
            <div class="data-website-card-grid">
                <a href="https://mojokertokab.bps.go.id/id/site/pilihdata.html" class="data-website-card data-website-card-link" target="_blank" rel="noopener noreferrer">
                    <div class="data-website-card-image-wrap">
                        <img src="{{ $bookPoster }}" alt="Tabel Dinamis" class="data-website-card-image" loading="lazy">
                    </div>
                    <h2>TABEL DINAMIS</h2>
                    <p>(dari Website Resmi BPS Kabupaten Mojokerto)</p>
                </a>

                <a href="https://mojokertokab.bps.go.id/id/publication" class="data-website-card data-website-card-publikasi data-website-card-link" target="_blank" rel="noopener noreferrer">
                    <div class="data-website-card-image-wrap">
                        <img src="{{ $publicationCover }}" alt="Publikasi BPS Kabupaten Mojokerto" class="data-website-card-image data-website-card-cover" loading="lazy">
                    </div>
                    <h2>PUBLIKASI BPS KABUPATEN MOJOKERTO</h2>
                    <p>(dari Website Resmi BPS Kabupaten Mojokerto)</p>
                </a>
            </div>
        </section>

        <footer class="data-website-footer">
            <div class="data-website-footer-inner">
                <h2 class="data-website-footer-text">Jangan Lewatkan Informasi Terbaru Kami</h2>
                <div class="data-website-footer-socials">
                    <a href="#" class="footer-social-link" aria-label="Website">
                        <img src="{{ $iconWeb }}" alt="Website" class="footer-social-icon" loading="lazy">
                    </a>
                    <a href="#" class="footer-social-link" aria-label="Email">
                        <img src="{{ $iconEmail }}" alt="Email" class="footer-social-icon" loading="lazy">
                    </a>
                    <a href="#" class="footer-social-link" aria-label="WhatsApp">
                        <img src="{{ $iconWhatsApp }}" alt="WhatsApp" class="footer-social-icon" loading="lazy">
                    </a>
                    <a href="#" class="footer-social-link" aria-label="Instagram">
                        <img src="{{ $iconInstagram }}" alt="Instagram" class="footer-social-icon" loading="lazy">
                    </a>
                    <a href="#" class="footer-social-link" aria-label="Facebook">
                        <img src="{{ $iconFacebook }}" alt="Facebook" class="footer-social-icon" loading="lazy">
                    </a>
                    <a href="#" class="footer-social-link" aria-label="X">
                        <img src="{{ $iconX }}" alt="X" class="footer-social-icon" loading="lazy">
                    </a>
                    <a href="#" class="footer-social-link" aria-label="YouTube">
                        <img src="{{ $iconYouTube }}" alt="YouTube" class="footer-social-icon" loading="lazy">
                    </a>
                </div>
            </div>
        </footer>
    </main>

    <style>
        body.page-data-website {
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: #ffffff;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body.page-data-website > main {
            flex: 1 0 auto;
        }

        .data-website-page {
            display: flex;
            flex-direction: column;
        }

        .data-website-hero {
            background: #ffffff;
            padding: clamp(48px, 6vw, 72px) 16px clamp(36px, 5vw, 60px);
            text-align: center;
        }

        .data-website-hero-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0;
            flex-wrap: nowrap;
        }

        .data-website-hero h1 {
            margin: 0;
            font-family: 'Anton', sans-serif;
            letter-spacing: 0.05em;
            font-size: clamp(42px, 6vw, 84px);
            line-height: 0.95;
            color: #3d7de8;
        }

        .data-website-showcase {
            background: linear-gradient(135deg, #4a8c6f 0%, #2d8c7a 100%);
            background-position: center center;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            padding: clamp(18px, 2.2vw, 30px) 16px clamp(40px, 6vw, 84px);
            min-height: 72vh;
            position: relative;
            overflow: hidden;
        }

        .data-website-card-grid {
            max-width: 980px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(2, minmax(250px, 1fr));
            gap: clamp(42px, 6vw, 86px);
            align-items: center;
            justify-items: center;
            justify-content: center;
        }

        .data-website-card {
            text-align: center;
            color: #ffffff;
            width: 100%;
            max-width: 320px;
            margin-top: 50px;
            transition: transform 220ms ease;
        }

        .data-website-card-link {
            display: block;
            text-decoration: none;
            color: inherit;
        }

        .data-website-card-publikasi {
            margin-top: 50px;
        }

        .data-website-card-image-wrap {
            width: clamp(210px, 22vw, 255px);
            aspect-ratio: 3 / 4;
            margin: 0 auto clamp(14px, 2vw, 22px);
            padding: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.34);
            box-shadow: 0 14px 28px rgba(6, 53, 46, 0.28);
        }

        .data-website-card-image {
            display: block;
            width: 100%;
            height: 100%;
            border-radius: 12px;
            object-fit: contain;
            background: #ffffff;
        }

        .data-website-card:hover,
        .data-website-card:focus-within,
        .data-website-card:active {
            transform: scale(1.02);
        }

        .data-website-card:hover .data-website-card-image,
        .data-website-card:focus-within .data-website-card-image,
        .data-website-card:active .data-website-card-image {
            transform: scale(1.05);
        }

        @media (hover: none) {
            .data-website-card:active {
                transform: translateY(-6px);
            }

            .data-website-card:active .data-website-card-image-wrap {
                transform: scale(1.015);
            }

            .data-website-card:active .data-website-card-image {
                transform: scale(1.05);
            }
        }

        .data-website-card h2 {
            margin: 12px 0 8px;
            font-size: clamp(14px, 1.5vw, 22px);
            line-height: 1.08;
            font-weight: 800;
            text-transform: uppercase;
            color: #ffffff;
        }

        .data-website-card p {
            margin: 0;
            font-size: clamp(10px, 0.9vw, 12px);
            line-height: 1.4;
            font-style: italic;
            color: rgba(255, 255, 255, 0.95);
        }

        .data-website-footer {
            background: #4f6f35;
            padding: clamp(10px, 1.4vw, 16px) 16px;
        }

        .data-website-footer-inner {
            max-width: 1020px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: clamp(14px, 2.2vw, 28px);
            flex-wrap: nowrap;
        }

        .data-website-footer-text {
            margin: 0;
            font-family: 'Brush Script MT', 'Segoe Script', cursive;
            font-size: clamp(24px, 2.7vw, 38px);
            font-weight: 400;
            color: #ffffff;
            line-height: 1.2;
            letter-spacing: 0.02em;
            flex: 1;
            min-width: 250px;
        }

        .data-website-footer-socials {
            display: flex;
            gap: clamp(10px, 1.5vw, 16px);
            align-items: center;
            justify-content: center;
            flex-wrap: nowrap;
        }

        .footer-social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            text-decoration: none;
            transition: transform 220ms ease;
            will-change: transform;
        }

        .footer-social-link:hover,
        .footer-social-link:focus {
            transform: translateY(-2px) scale(1.04);
        }

        .footer-social-icon {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: contain;
        }

        @media (max-width: 900px) {
            .data-website-footer-inner {
                flex-direction: column;
                text-align: center;
            }

            .data-website-footer-text {
                width: 100%;
            }
        }

        @media (max-width: 900px) {
            .data-website-card-grid {
                grid-template-columns: 1fr;
                gap: 60px;
            }

            .data-website-card {
                max-width: 290px;
            }

            .data-website-card-image-wrap {
                width: min(255px, 72vw);
            }

            .data-website-card-publikasi {
                margin-top: 50px;
            }
        }

        @media (max-width: 640px) {
            .data-website-hero {
                padding-top: 36px;
            }

            .data-website-hero-inner {
                gap: 10px;
            }

            .data-website-showcase {
                padding-left: 12px;
                padding-right: 12px;
            }
        }
    </style>
</body>
</html>
