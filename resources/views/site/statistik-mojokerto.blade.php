<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Mojokerto - WADER</title>
    <meta name="description" content="Statistik Mojokerto">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="site-shell page-statistik-mojokerto">
    @php
        $logoMain = asset('asset/stimo.png');
        $heroBg = asset('asset/beranda2.png');
        $logoHeader = asset('asset/logo bps.png');
        $items = $items ?? collect();
        $settings = $settings ?? [];
    @endphp

    <header class="layout-header">
        <div class="layout-header-inner">
            <a href="{{ route('site.home') }}" class="brand-lockup">
                <img src="{{ $logoHeader }}" alt="BPS Kabupaten Mojokerto" class="brand-logo-header">
            </a>

            <nav class="layout-nav">
                <a href="{{ route('site.page', 'beranda') }}" class="layout-nav-link">Beranda</a>
                <a href="{{ route('site.page', 'pst-center') }}" class="layout-nav-link">PST Center</a>
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

    <main>
        <!-- Hero Section -->
        <section class="hero-layout-stage statistik-hero-custom" style="background-image: url('{{ $heroBg }}');">
            <div class="hero-layout-center reveal-card" style="--delay: 0ms;">
                <img src="{{ $logoMain }}" alt="Statistik Mojokerto" class="hero-main-logo">
            </div>
        </section>

        <!-- Statistics Grid -->
        <section class="statistik-cards-section">
            <div class="statistik-cards-grid">
                @forelse ($items as $item)
                    <div class="stat-card">
                        <div class="stat-card-inner">
                            @php
                                $imageSrc = $item->image_base64 && $item->image_mime_type
                                    ? 'data:'.$item->image_mime_type.';base64,'.$item->image_base64
                                    : asset($item->image_path);
                            @endphp
                            <img src="{{ $imageSrc }}" alt="{{ $item->title }}" class="stat-card-image">
                        </div>
                        <h3 class="stat-card-label">{{ $item->title }}</h3>
                    </div>
                @empty
                    <div class="stat-card">
                        <div class="stat-card-inner">
                            <img src="{{ asset('asset/beranda.jpg') }}" alt="Belum ada data" class="stat-card-image">
                        </div>
                        <h3 class="stat-card-label">Belum ada data statistik aktif</h3>
                    </div>
                @endforelse
            </div>
        </section>

    </main>

    <footer class="statistik-info-strip">
        <div class="statistik-info-inner">
            <p class="statistik-info-title">Jangan Lewatkan Informasi Terbaru Kami</p>
            <div class="statistik-social-row">
                <a href="{{ $settings['instansi_link'] ?? '#' }}" target="_blank" class="social-dot social-web" aria-label="Website">W</a>
                <a href="mailto:{{ $settings['contact_email'] ?? '' }}" class="social-dot social-mail" aria-label="Email">M</a>
                <a href="{{ $settings['contact_whatsapp'] ?? '#' }}" target="_blank" class="social-dot social-wa" aria-label="WhatsApp">WA</a>
                <a href="{{ $settings['contact_instagram'] ?? '#' }}" target="_blank" class="social-dot social-ig" aria-label="Instagram">IG</a>
                <a href="{{ $settings['contact_facebook'] ?? '#' }}" target="_blank" class="social-dot social-fb" aria-label="Facebook">f</a>
                <a href="#" class="social-dot social-x" aria-label="X">X</a>
                <a href="#" class="social-dot social-yt" aria-label="YouTube">YT</a>
            </div>
        </div>
    </footer>

    <style>
        html,
        body {
            min-height: 100%;
        }

        body.page-statistik-mojokerto {
            margin: 0;
            display: flex;
            flex-direction: column;
            background: #f5f5f5;
        }

        body.page-statistik-mojokerto > main {
            flex: 1 0 auto;
        }

        .statistik-hero-custom {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            min-height: clamp(260px, 42vw, 420px) !important;
            height: auto;
        }

        .statistik-hero-custom .corner-band {
            display: none;
        }

        .statistik-hero-custom .hero-layout-center {
            position: relative;
            z-index: 1;
        }

        .statistik-hero-custom .hero-main-logo {
            width: clamp(250px, 40vw, 440px) !important;
            max-width: 440px;
            height: auto;
        }

        .statistik-hero-custom .reveal-card {
            opacity: 1;
            transform: none;
            animation: none;
        }

        .statistik-hero-custom .corner-band,
        .statistik-hero-custom .hero-layout-center {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* === STATISTICS CARDS SECTION === */
        .statistik-cards-section {
            padding: 60px 20px;
            background: #f5f5f5;
        }

        .statistik-cards-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 30px;
        }

        /* === STAT CARD === */
        .stat-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .stat-card-inner {
            width: 100%;
            height: 280px;
            overflow: hidden;
            background: #e0e0e0;
        }

        .stat-card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .stat-card-label {
            padding: 20px;
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #333;
            text-align: center;
            line-height: 1.4;
        }

        .statistik-info-strip {
            background: #4c6732;
            padding: clamp(20px, 3vw, 30px) 20px;
        }

        .statistik-info-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .statistik-info-title {
            margin: 0;
            color: #f6f7f3;
            font-size: clamp(34px, 4.6vw, 54px);
            line-height: 1.05;
            letter-spacing: 0.2px;
            font-family: "Brush Script MT", cursive;
        }

        .statistik-social-row {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .social-dot {
            width: clamp(52px, 6vw, 72px);
            height: clamp(52px, 6vw, 72px);
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
            font-weight: 800;
            font-size: clamp(18px, 2.2vw, 24px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .social-web { background: #222831; }
        .social-mail { background: #ececec; color: #de4b39; }
        .social-wa { background: #24d366; font-size: 18px; }
        .social-ig { background: linear-gradient(135deg, #feda75, #d62976, #4f5bd5); font-size: 18px; }
        .social-fb { background: #1877f2; font-size: 32px; }
        .social-x { background: #111; }
        .social-yt { background: #ff0000; font-size: 20px; }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .statistik-hero-custom {
                min-height: clamp(220px, 52vw, 300px) !important;
            }

            .statistik-hero-custom .hero-main-logo {
                width: clamp(220px, 68vw, 320px) !important;
                max-width: 320px;
            }

            .statistik-cards-grid {
                grid-template-columns: 1fr;
            }

            .stat-card-label {
                font-size: 16px;
            }

            .statistik-info-inner {
                flex-direction: column;
                align-items: flex-start;
            }

            .statistik-info-title {
                font-size: 44px;
            }

            .social-dot {
                width: 58px;
                height: 58px;
                font-size: 20px;
            }
        }
    </style>
</body>
</html>
