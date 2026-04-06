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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                'url' => '#',
            ],
            [
                'label' => 'Daftar LO PSS',
                'image' => asset('asset/daftar-LO-PSS.png'),
                'url' => '#',
            ],
            [
                'label' => 'Jadwal Safari PSS',
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
                        <a href="{{ $card['url'] }}" class="pss-menu-link" aria-label="{{ $card['label'] }}">
                            <img src="{{ $card['image'] }}" alt="{{ $card['label'] }}" class="pss-menu-image">
                        </a>
                    @endforeach
                </div>
            </article>
        </section>
    </main>

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
        }

        .pss-bg-bottom {
            bottom: 0;
            z-index: 1;
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
