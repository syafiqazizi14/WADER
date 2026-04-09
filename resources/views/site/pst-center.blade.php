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
                <a href="{{ route('site.page', 'statistik-mojokerto') }}" class="layout-nav-link">STIMO 2.0</a>
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
        <section class="hero-layout-stage pst-hero" style="min-height: 100vh; background: #ffffff url('{{ asset('asset/beranda2.png') }}') center top / cover no-repeat;">
            <div class="hero-layout-center reveal-card" style="--delay: 0ms;">
                <h1 class="pst-hero-title">PST Center</h1>
            </div>
        </section>

        <section class="content-followup-wrap pst-center-section">
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

        <section style="background: #466633; padding: 0.9rem 0;">
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
        </section>
    </main>

    <style>
        .pst-hero {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            background: #ffffff;
        }

        .pst-hero .hero-layout-center {
            position: relative;
            z-index: 1;
        }

        .pst-hero-title {
            margin: 0;
            color: #0b2e59;
            font-family: 'Sora', 'Plus Jakarta Sans', system-ui, sans-serif;
            font-size: clamp(2.8rem, 8vw, 5.2rem);
            font-weight: 800;
            letter-spacing: -0.02em;
            text-shadow: 0 8px 22px rgba(11, 46, 89, 0.18);
        }

        .pst-center-section {
            max-width: 100%;
            margin: 0;
            padding: 2.2rem 2.5rem 3.2rem;
            background: #ffffff;
        }

        .pst-center-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 28px;
            align-items: start;
            max-width: 1480px;
            margin: 0 auto;
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
            width: min(24vw, 320px);
            aspect-ratio: 1 / 1;
            min-width: 210px;
            border-radius: 0;
            background: transparent;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: none;
            animation: icon-float 3.8s ease-in-out infinite;
        }

        .pst-service-card:nth-child(1) .pst-service-bubble { animation-delay: 90ms; }
        .pst-service-card:nth-child(2) .pst-service-bubble { animation-delay: 170ms; }
        .pst-service-card:nth-child(3) .pst-service-bubble { animation-delay: 250ms; }
        .pst-service-card:nth-child(4) .pst-service-bubble { animation-delay: 330ms; }

        .pst-service-image {
            width: 90%;
            height: 90%;
            object-fit: contain;
        }

        @media (max-width: 980px) {
            .pst-center-section {
                padding: 1.5rem 1rem 2.2rem;
            }

            .pst-center-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 18px;
            }

            .pst-service-bubble {
                min-width: 185px;
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
