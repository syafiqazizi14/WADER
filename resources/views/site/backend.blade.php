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
    <link rel="icon" type="image/png" href="{{ asset('asset/favicon-wader.png') }}">
    <link rel="shortcut icon" href="{{ asset('asset/favicon-wader.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('asset/favicon-wader.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('site.partials.topbar-transparent')
    <style>
        .page-backend .layout-header {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            z-index: 60 !important;
            background: transparent !important;
            backdrop-filter: none !important;
            border-bottom-color: transparent !important;
            box-shadow: none !important;
        }

        .page-backend .layout-header.is-scrolled {
            background: rgba(255, 255, 255, 0.96) !important;
            backdrop-filter: blur(10px) !important;
            border-bottom: 1px solid rgba(15, 23, 42, 0.08) !important;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.1) !important;
        }

        .page-backend .layout-header.is-at-top {
            background: transparent !important;
            backdrop-filter: none !important;
            border-bottom-color: transparent !important;
            box-shadow: none !important;
        }

        .page-backend .hero-layout-stage {
            min-height: 100vh !important;
            background: #ffffff url('{{ asset('asset/beranda2.png') }}') center top / cover no-repeat !important;
        }

        .page-backend .hero-layout-center {
            transform: none !important;
            padding: 0 !important;
            border-radius: 0 !important;
        }

        .page-backend .backend-hero-title {
            margin: 0 !important;
            color: #0b2e59 !important;
            font-family: 'Sora', 'Plus Jakarta Sans', system-ui, sans-serif !important;
            font-size: clamp(2.8rem, 8vw, 5.2rem) !important;
            font-weight: 800 !important;
            letter-spacing: -0.02em !important;
            text-shadow: 0 8px 22px rgba(11, 46, 89, 0.18) !important;
            line-height: 1 !important;
        }

        .page-backend .backend-hero-title::after {
            content: none !important;
        }

        .page-backend .backend-guide-panel {
            background: linear-gradient(180deg, #eff1f3 0%, #e7e9ec 100%) !important;
            padding: clamp(1.2rem, 2.2vw, 2rem) clamp(0.9rem, 2vw, 1.4rem) !important;
        }

        .page-backend .backend-guide-inner {
            max-width: 1540px !important;
            margin: 0 auto !important;
            display: grid !important;
            grid-template-columns: minmax(0, 1fr) minmax(180px, 280px) !important;
            gap: clamp(1rem, 2.2vw, 1.8rem) !important;
            align-items: center !important;
        }

        .page-backend .backend-guide-text {
            background: #ffffff;
            border-radius: 22px;
            border: 1px solid rgba(15, 23, 42, 0.08);
            box-shadow: 0 16px 36px rgba(15, 23, 42, 0.08);
            padding: clamp(1.1rem, 2.1vw, 1.8rem) clamp(1.2rem, 2.4vw, 2rem);
        }

        .page-backend .backend-guide-note {
            margin: 0;
            color: #0f1721;
            font-size: clamp(1rem, 1.2vw, 1.45rem);
            line-height: 1.45;
            text-shadow: none;
        }

        .page-backend .backend-guide-note-chip {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.5rem;
            padding: 0.2rem 0.55rem;
            border-radius: 999px;
            background: #0f6a3d;
            color: #ffffff;
            font-size: 0.82em;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .page-backend .backend-guide-title {
            margin: clamp(0.85rem, 1.4vw, 1.15rem) 0 clamp(0.4rem, 0.7vw, 0.6rem);
            color: #0f1721;
            font-size: clamp(1.12rem, 1.25vw, 1.5rem);
            font-weight: 700;
            text-shadow: none;
        }

        .page-backend .backend-guide-list {
            margin: 0;
            padding-left: clamp(1.3rem, 1.8vw, 1.9rem);
            color: #0f1721;
            font-size: clamp(1rem, 1.22vw, 1.42rem);
            line-height: 1.5;
            list-style: decimal;
            text-shadow: none;
        }

        .page-backend .backend-guide-list li {
            margin-bottom: clamp(0.45rem, 0.7vw, 0.72rem);
            color: #0f1721;
        }

        .page-backend .backend-guide-list li::marker {
            color: #0f1721;
            font-weight: 400;
        }

        .page-backend .backend-guide-file {
            display: flex;
            justify-content: center;
            align-self: stretch;
        }

        .page-backend .backend-guide-file-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            width: 100%;
            background: linear-gradient(165deg, #ffffff 0%, #f8fbff 100%);
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 22px;
            box-shadow: 0 16px 30px rgba(15, 23, 42, 0.1);
            padding: clamp(1rem, 1.6vw, 1.5rem) clamp(0.8rem, 1.3vw, 1rem);
            text-decoration: none;
            transition: transform 180ms ease, box-shadow 180ms ease;
        }

        .page-backend .backend-guide-file-link:hover {
            transform: translateY(-3px);
            box-shadow: 0 22px 34px rgba(15, 23, 42, 0.13);
        }

        .page-backend .backend-guide-file-logo {
            width: min(100%, 138px);
        }

        .page-backend .backend-guide-file-label {
            color: #111827;
            font-size: clamp(1.45rem, 1.95vw, 1.95rem);
            font-weight: 700;
            letter-spacing: 0;
            text-decoration: underline;
        }

        .page-backend .backend-feature-zone {
            background: #4f6f35;
            padding: 1.2rem 32px 0.8rem 32px;
            min-height: auto;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .page-backend .backend-feature-inner {
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1.1fr;
            gap: 2rem;
            align-items: flex-end;
        }

        .page-backend .backend-feature-list {
            display: flex;
            flex-direction: column;
            gap: 1.4rem;
            padding-right: 0;
            padding-left: 0;
            max-width: 100%;
            margin-right: 0;
        }

        .page-backend .backend-feature-link {
            display: block;
            text-decoration: none;
            transition: transform 220ms ease, box-shadow 220ms ease;
            border-radius: 18px;
            overflow: hidden;
        }

        .page-backend .backend-feature-link:hover {
            transform: translateY(-2px);
        }

        .page-backend .backend-feature-pill {
            display: block;
            width: 100%;
            height: auto;
            max-width: 100%;
            border-radius: 16px;
            object-fit: cover;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.18);
        }

        .page-backend .backend-feature-figure-wrap {
            display: flex;
            align-items: flex-end;
            justify-content: center;
            width: 100%;
            height: auto;
            margin-bottom: -1.2rem;
            padding-right: 0;
        }

        .page-backend .backend-feature-figure {
            display: block;
            width: 75%;
            height: auto;
            object-fit: contain;
            max-width: 100%;
        }

        .page-backend .backend-social-strip {
            background: #4f6f35;
            padding: clamp(1rem, 1.6vw, 1.5rem) 0;
        }

        .page-backend .backend-social-inner {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 clamp(0.8rem, 1.4vw, 1.6rem);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .page-backend .backend-social-text {
            margin: 0;
            color: #ffffff;
            font-family: "Brush Script MT", "Segoe Script", cursive;
            font-size: clamp(1.7rem, 2.4vw, 2.7rem);
            line-height: 1.2;
        }

        .page-backend .backend-social-icons {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.55rem;
            flex-wrap: nowrap;
        }

        .page-backend .backend-social-icon-link {
            width: 46px;
            height: 46px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.16);
            transition: transform 180ms ease;
        }

        .page-backend .backend-social-icon-link:hover {
            transform: translateY(-2px);
        }

        .page-backend .backend-social-icon {
            width: 36px;
            height: 36px;
            object-fit: contain;
            display: block;
        }

        @media (max-width: 980px) {
            .page-backend .backend-feature-inner {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .page-backend .backend-feature-list {
                order: 2;
            }

            .page-backend .backend-feature-figure-wrap {
                order: 1;
                max-height: 300px;
            }

            .page-backend .backend-guide-inner {
                display: grid;
                grid-template-columns: 1fr;
                gap: 1.2rem;
            }

            .page-backend .backend-guide-file {
                justify-content: stretch;
            }

            .page-backend .backend-guide-file-label {
                font-size: clamp(1.55rem, 7vw, 2.2rem);
            }
        }

        @media (max-width: 640px) {
            .page-backend .backend-feature-zone {
                padding: 1.5rem 12px;
                min-height: auto;
            }

            .page-backend .backend-social-inner {
                justify-content: center;
                text-align: center;
            }

            .page-backend .backend-social-icons {
                justify-content: center;
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body class="site-shell page-backend">
    @php
        $logoHeader = asset('asset/logo bps.png');
        $backendCardOutput = asset('asset/output-form-perminataan.png');
        $backendCardLetter = asset('asset/surat-yang-diunggah.png');
        $backendCardMonitoring = asset('asset/monitoring-perminataan.png');
        $backendCardUpload = asset('asset/unggah data.png');
        $backendFigure = asset('asset/kak anin.png');
        $backendOutputFormUrl = 'https://docs.google.com/spreadsheets/d/1wuMMNHJ7Wjm8vXG-_H0dX6VtTTA7gKH5p-xw_oUXAcg/edit?gid=472492380#gid=472492380';
        $backendLetterUrl = 'https://drive.google.com/drive/folders/1WlBPzUyoxpCMBVuJmPvBcAqpFCtY6QKqvKaP-Bz-1ErHNfGoG-tKV1S_p9IhoDiociPA4sm1?usp=drive_link';
        $backendMonitoringUrl = 'https://docs.google.com/spreadsheets/d/118_EQ_YEH0dYEs0qYz7JsdKmrRIPSiIwkQ2Aw3I8rbQ/edit?usp=drive_link';
        $backendUploadUrl = 'https://drive.google.com/drive/folders/1StemcGfXWPAotcuLi9r-u7Bnq4j6prac?usp=drive_link';
        $semuaFileLogo = asset('asset/semua-file.png');
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

        $semuaFileLink = 'https://drive.google.com/drive/folders/140hYR77n-euXRJZWSNMCsK_bzur2vAOS?usp=sharing';

        $backendCards = [
            [
                'url' => $backendOutputFormUrl,
                'label' => 'Buka Output Form Permintaan Data dan Konsultasi',
                'image' => $backendCardOutput,
                'alt' => 'Output Form Permintaan Data dan Konsultasi',
            ],
            [
                'url' => $backendLetterUrl,
                'label' => 'Buka Surat yang Diunggah',
                'image' => $backendCardLetter,
                'alt' => 'Surat yang Diunggah',
            ],
            [
                'url' => $backendMonitoringUrl,
                'label' => 'Buka Monitoring Permintaan Data',
                'image' => $backendCardMonitoring,
                'alt' => 'Monitoring Permintaan Data',
            ],
            [
                'url' => $backendUploadUrl,
                'label' => 'Buka Unggah Data yang Sudah Ditindak Lanjuti',
                'image' => $backendCardUpload,
                'alt' => 'Unggah Data yang Sudah Ditindak Lanjuti',
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
                <a href="{{ route('site.page', 'statistik-mojokerto') }}" class="layout-nav-link">STIMO 2.0</a>
                <a href="{{ route('site.page', 'backend') }}" class="layout-nav-link active">Backend</a>
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
            <div class="hero-layout-center reveal-card" style="--delay: 0ms;">
                <h1 class="backend-hero-title">BACKEND</h1>
            </div>
        </section>

        <section class="backend-feature-zone">
            <div class="backend-feature-inner">
                <div class="backend-feature-list">
                    @foreach ($backendCards as $card)
                        <a href="{{ $card['url'] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $card['label'] }}" title="{{ $card['label'] }}" class="backend-feature-link">
                            <img src="{{ $card['image'] }}" alt="{{ $card['alt'] }}" class="backend-feature-pill">
                        </a>
                    @endforeach
                </div>
                <div class="backend-feature-figure-wrap">
                    <img src="{{ $backendFigure }}" alt="Petugas BPS" class="backend-feature-figure">
                </div>
            </div>
        </section>

        <section class="backend-guide-panel">
            <div class="backend-guide-inner">
                <div class="backend-guide-text">
                    <p class="backend-guide-note"><span class="backend-guide-note-chip">NB</span>File di akses menggunakan gmail BPS Kabupaten Mojokerto</p>
                    <p class="backend-guide-title">Langkah :</p>
                    <ol class="backend-guide-list">
                        <li>Cek <strong><em>Output Permintaan Data &amp; Konsultasi</em></strong> serta cek <strong><em>Surat yang di Upload</em></strong></li>
                        <li>Pindahkan informasi pada <strong><em>Monitoring Permintaan Data</em></strong></li>
                        <li>Apabila sudah selesai ditindahlanjuti, <strong><em>unggah file</em></strong> yang diberikan pada Pengguna Data (jika Layanan Permintaan Data), Jika hanya konsultasi statistik, hanya sampai monitoring permintaan data.</li>
                    </ol>
                </div>
                <div class="backend-guide-file">
                    <a href="{{ $semuaFileLink }}" target="_blank" rel="noopener noreferrer" class="backend-guide-file-link">
                        <img src="{{ $semuaFileLogo }}" alt="Semua File" class="backend-guide-file-logo">
                        <span class="backend-guide-file-label">SEMUA FILE</span>
                    </a>
                </div>
            </div>
        </section>

        <section class="backend-social-strip">
            <div class="backend-social-inner">
                <p class="backend-social-text">Jangan Lewatkan Informasi Terbaru Kami</p>
                <div class="backend-social-icons">
                    <a href="{{ $settings['instansi_link'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="backend-social-icon-link" aria-label="Website">
                        <img src="{{ $iconWeb }}" alt="Website" class="backend-social-icon">
                    </a>
                    <a href="mailto:{{ $settings['contact_email'] ?? '' }}" class="backend-social-icon-link" aria-label="Email">
                        <img src="{{ $iconEmail }}" alt="Email" class="backend-social-icon">
                    </a>
                    <a href="{{ $whatsappLink }}" target="_blank" rel="noopener noreferrer" class="backend-social-icon-link" aria-label="WhatsApp">
                        <img src="{{ $iconWhatsapp }}" alt="WhatsApp" class="backend-social-icon">
                    </a>
                    <a href="{{ $settings['contact_instagram'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="backend-social-icon-link" aria-label="Instagram">
                        <img src="{{ $iconInstagram }}" alt="Instagram" class="backend-social-icon">
                    </a>
                    <a href="{{ $settings['contact_facebook'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="backend-social-icon-link" aria-label="Facebook">
                        <img src="{{ $iconFacebook }}" alt="Facebook" class="backend-social-icon">
                    </a>
                    <a href="https://x.com/bpsmojokerto" target="_blank" rel="noopener noreferrer" class="backend-social-icon-link" aria-label="X">
                        <img src="{{ $iconX }}" alt="X" class="backend-social-icon">
                    </a>
                    <a href="#" class="backend-social-icon-link" aria-label="YouTube">
                        <img src="{{ $iconYoutube }}" alt="YouTube" class="backend-social-icon">
                    </a>
                </div>
            </div>
        </section>
    </main>
</body>
</html>

