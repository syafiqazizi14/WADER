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
        $logoHeader = asset('asset/Wader.png');
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
                            <button type="button" class="stat-card-zoom-btn" aria-label="Perbesar {{ $item->title }}">Perbesar</button>
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
                <a href="{{ $settings['instansi_link'] ?? '#' }}" target="_blank" class="social-icon-link" aria-label="Website">
                    <img src="{{ asset('asset/www.png') }}" alt="Website" class="social-icon">
                </a>
                <a href="mailto:{{ $settings['contact_email'] ?? '' }}" class="social-icon-link" aria-label="Email">
                    <img src="{{ asset('asset/email.png') }}" alt="Email" class="social-icon">
                </a>
                <a href="{{ $settings['contact_whatsapp'] ?? '#' }}" target="_blank" class="social-icon-link" aria-label="WhatsApp">
                    <img src="{{ asset('asset/whatapp.png') }}" alt="WhatsApp" class="social-icon">
                </a>
                <a href="{{ $settings['contact_instagram'] ?? '#' }}" target="_blank" class="social-icon-link" aria-label="Instagram">
                    <img src="{{ asset('asset/instagram.png') }}" alt="Instagram" class="social-icon">
                </a>
                <a href="#" class="social-icon-link" aria-label="X">
                    <img src="{{ asset('asset/x.png') }}" alt="X" class="social-icon">
                </a>
                <a href="{{ $settings['contact_facebook'] ?? '#' }}" target="_blank" class="social-icon-link" aria-label="Facebook">
                    <img src="{{ asset('asset/facebook.png') }}" alt="Facebook" class="social-icon">
                </a>
                <a href="#" class="social-icon-link" aria-label="YouTube">
                    <img src="{{ asset('asset/yt.png') }}" alt="YouTube" class="social-icon">
                </a>
            </div>
        </div>
    </footer>

    <div class="stat-lightbox" id="statLightbox" aria-hidden="true">
        <div class="stat-lightbox-backdrop" data-close-lightbox></div>
        <div class="stat-lightbox-dialog" role="dialog" aria-modal="true" aria-label="Gambar Statistik">
            <button type="button" class="stat-lightbox-close" id="statLightboxClose" aria-label="Tutup">&times;</button>
            <img src="" alt="" class="stat-lightbox-image" id="statLightboxImage">
            <p class="stat-lightbox-title" id="statLightboxTitle"></p>
        </div>
    </div>

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
            padding: 56px 12px;
            background: #f5f5f5;
        }

        .statistik-cards-grid {
            max-width: 1420px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        /* === STAT CARD === */
        .stat-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.65);
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
            height: auto;
            overflow: hidden;
            background: #ffffff;
            position: relative;
        }

        .stat-card-image {
            width: 100%;
            height: auto;
            object-fit: contain;
            display: block;
            transform: scale(1.045);
            transform-origin: center;
        }

        .stat-card-zoom-btn {
            position: absolute;
            right: 10px;
            bottom: 10px;
            border: none;
            border-radius: 999px;
            padding: 0.42rem 0.8rem;
            font-size: 0.82rem;
            font-weight: 700;
            color: #0f3f75;
            background: rgba(255, 255, 255, 0.92);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.18);
            cursor: pointer;
        }

        .stat-lightbox {
            position: fixed;
            inset: 0;
            z-index: 130;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .stat-lightbox.is-open {
            display: flex;
        }

        .stat-lightbox-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(8, 12, 20, 0.82);
        }

        .stat-lightbox-dialog {
            position: relative;
            z-index: 1;
            width: min(1200px, 96vw);
            max-height: 92vh;
            border-radius: 12px;
            background: #0d1119;
            padding: 14px 14px 10px;
            overflow: auto;
        }

        .stat-lightbox-image {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 8px;
            background: #ffffff;
        }

        .stat-lightbox-title {
            margin: 10px 0 2px;
            color: #edf3ff;
            font-size: 0.95rem;
            font-weight: 600;
            text-align: center;
        }

        .stat-lightbox-close {
            position: absolute;
            top: 6px;
            right: 8px;
            width: 34px;
            height: 34px;
            border: none;
            border-radius: 999px;
            font-size: 1.4rem;
            line-height: 1;
            color: #0c1d3d;
            background: rgba(255, 255, 255, 0.92);
            cursor: pointer;
        }

        .stat-card-label {
            padding: 22px;
            margin: 0;
            font-size: 20px;
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
            font-size: clamp(24px, 3.5vw, 42px);
            line-height: 1.2;
            letter-spacing: 0.2px;
            font-family: "Brush Script MT", cursive;
            white-space: nowrap;
        }

        .statistik-social-row {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: nowrap;
            justify-content: flex-end;
        }

        .social-icon-link {
            width: clamp(48px, 5.5vw, 65px);
            height: clamp(48px, 5.5vw, 65px);
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            background: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            flex-shrink: 0;
        }

        .social-icon-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
        }

        .social-icon {
            width: 60%;
            height: 60%;
            object-fit: contain;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .statistik-cards-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .statistik-hero-custom {
                min-height: clamp(220px, 52vw, 300px) !important;
            }

            .statistik-hero-custom .hero-main-logo {
                width: clamp(220px, 68vw, 320px) !important;
                max-width: 320px;
            }

            .stat-card-label {
                font-size: 16px;
            }

            .statistik-info-inner {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .statistik-info-title {
                font-size: 24px;
                white-space: normal;
            }

            .social-icon-link {
                width: 58px;
                height: 58px;
            }

            .stat-card-zoom-btn {
                right: 8px;
                bottom: 8px;
                padding: 0.36rem 0.66rem;
                font-size: 0.76rem;
            }
        }

        @media (max-width: 1100px) and (min-width: 769px) {
            .statistik-cards-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 16px;
            }

        }
    </style>

    <script>
        (() => {
            const lightbox = document.getElementById('statLightbox');
            const lightboxImage = document.getElementById('statLightboxImage');
            const lightboxTitle = document.getElementById('statLightboxTitle');
            const closeBtn = document.getElementById('statLightboxClose');

            if (!lightbox || !lightboxImage || !lightboxTitle || !closeBtn) {
                return;
            }

            const openLightbox = (src, title) => {
                lightboxImage.src = src;
                lightboxImage.alt = title || 'Gambar statistik';
                lightboxTitle.textContent = title || '';
                lightbox.classList.add('is-open');
                lightbox.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            };

            const closeLightbox = () => {
                lightbox.classList.remove('is-open');
                lightbox.setAttribute('aria-hidden', 'true');
                lightboxImage.src = '';
                document.body.style.overflow = '';
            };

            document.addEventListener('click', (event) => {
                const zoomBtn = event.target.closest('.stat-card-zoom-btn');
                if (zoomBtn) {
                    const card = zoomBtn.closest('.stat-card');
                    const image = card ? card.querySelector('.stat-card-image') : null;
                    const title = card ? card.querySelector('.stat-card-label') : null;

                    if (image) {
                        openLightbox(image.src, title ? title.textContent.trim() : '');
                    }

                    return;
                }

                if (event.target.hasAttribute('data-close-lightbox')) {
                    closeLightbox();
                }
            });

            closeBtn.addEventListener('click', closeLightbox);

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && lightbox.classList.contains('is-open')) {
                    closeLightbox();
                }
            });
        })();
    </script>
</body>
</html>
