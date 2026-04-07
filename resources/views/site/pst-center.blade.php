<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PST Center - WADER</title>
    <meta name="description" content="Pusat layanan PST Center WADER Kabupaten Mojokerto.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="site-shell page-pst-center">
    @php
        $logoHeader = asset('asset/logo bps.png');
        $heroBgPstCenter = asset('asset/beranda2.png');

        $serviceCards = [
            [
                'title' => 'PST WA',
                'image' => asset('asset/PST WA.png'),
                'url' => $settings['contact_whatsapp'] ?? '#',
                'external' => true,
            ],
            [
                'title' => 'PST Jadwal Jaga',
                'image' => asset('asset/pst Jadwal Jaga.png'),
                'url' => '#',
                'external' => false,
            ],
            [
                'title' => 'PST Buku Tamu',
                'image' => asset('asset/PST Buku tamu.png'),
                'url' => '#',
                'external' => false,
            ],
            [
                'title' => 'PST Form',
                'image' => asset('asset/PST Form.png'),
                'url' => route('site.complaints'),
                'external' => false,
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
                <a href="{{ route('site.pst-center') }}" class="layout-nav-link active">PST Center</a>
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

    <main>
        <section class="pst-hero" style="background-image: url('{{ $heroBgPstCenter }}');">
            <div class="hero-layout-center reveal-card" style="--delay: 0ms;">
                <h1 class="pst-hero-title">PST Center</h1>
            </div>
        </section>

        <section class="content-followup-wrap">
            <div class="content-followup-head reveal-card" style="--delay: 90ms;">
                <p class="content-followup-meta">Pusat layanan statistik terpadu WADER untuk permintaan data, konsultasi, pembinaan, dan tindak lanjut pengaduan.</p>
            </div>

            <div class="pst-center-grid">
                @foreach ($serviceCards as $card)
                    <a href="{{ $card['url'] }}" @if($card['external']) target="_blank" rel="noopener noreferrer" @endif class="pst-service-card reveal-card" style="--delay: {{ ($loop->index + 1) * 90 }}ms;" aria-label="{{ $card['title'] }}">
                        <span class="pst-service-bubble">
                            <img src="{{ $card['image'] }}" alt="{{ $card['title'] }}" class="pst-service-image">
                        </span>
                    </a>
                @endforeach
            </div>
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

    <style>
        .pst-hero {
            min-height: clamp(280px, 45vw, 460px);
            display: flex;
            align-items: center;
            justify-content: center;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        .pst-hero-title {
            margin: 0;
            color: #000000;
            font-family: 'Sora', 'Plus Jakarta Sans', system-ui, sans-serif;
            font-size: clamp(2rem, 6vw, 4.5rem);
            font-weight: 800;
            letter-spacing: 0.02em;
            text-shadow: 0 1px 6px rgba(255, 255, 255, 0.45);
        }

        .pst-center-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 28px;
            align-items: start;
        }

        .pst-service-card {
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: transform 180ms ease;
        }

        .pst-service-card:hover {
            transform: translateY(-4px);
        }

        .pst-service-bubble {
            width: min(22vw, 280px);
            aspect-ratio: 1 / 1;
            min-width: 170px;
            border-radius: 999px;
            background: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 14px 22px rgba(0, 0, 0, 0.22);
        }

        .pst-service-image {
            width: 76%;
            height: 76%;
            object-fit: contain;
        }

        .pst-center-links {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        @media (max-width: 980px) {
            .pst-center-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 18px;
            }
        }

        @media (max-width: 560px) {
            .pst-center-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</body>
</html>
