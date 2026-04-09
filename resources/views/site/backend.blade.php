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
<body class="site-shell page-backend">
    @php
        $logoHeader = asset('asset/logo bps.png');
        $heroBg = asset('asset/beranda2.png');
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
        <section class="hero-layout-stage" style="min-height: calc(100vh - 88px); background: #ffffff url('{{ $heroBg }}') center top / cover no-repeat;">
            <div class="hero-layout-center reveal-card" style="--delay: 0ms;">
                <h1 class="backend-hero-title">BACKEND</h1>
            </div>
        </section>

        <section class="backend-feature-zone">
            <div class="backend-feature-inner">
                <div class="backend-feature-list">
                    <a href="{{ $backendOutputFormUrl }}" target="_blank" rel="noopener noreferrer" class="backend-feature-pill backend-pill-yellow">
                        <div class="backend-pill-content">
                            <h3 class="backend-pill-title">OUTPUT FORM PERMINTAAN DATA & KONSULTASI</h3>
                            <p class="backend-pill-subtitle">Lihat hasil dari Google Form Permintaan Data</p>
                        </div>
                    </a>
                    <a href="{{ $backendLetterUrl }}" target="_blank" rel="noopener noreferrer" class="backend-feature-pill backend-pill-white">
                        <div class="backend-pill-content">
                            <h3 class="backend-pill-title">SURAT YANG DIUNGGAH</h3>
                            <p class="backend-pill-subtitle">Jika ada</p>
                        </div>
                    </a>
                    <a href="{{ $backendMonitoringUrl }}" target="_blank" rel="noopener noreferrer" class="backend-feature-pill backend-pill-yellow">
                        <div class="backend-pill-content">
                            <h3 class="backend-pill-title">MONITORING PERMINTAAN DATA</h3>
                            <p class="backend-pill-subtitle">MONITORING - AKSES ADMIN</p>
                        </div>
                    </a>
                    <a href="{{ $backendUploadUrl }}" target="_blank" rel="noopener noreferrer" class="backend-feature-pill backend-pill-white">
                        <div class="backend-pill-content">
                            <h3 class="backend-pill-title">UNGGAH DATA YANG SUDAH DITINDAK LANJUTI</h3>
                            <p class="backend-pill-subtitle">Setelah dokumen selesai</p>
                        </div>
                    </a>
                </div>
                <div class="backend-feature-figure-wrap">
                    <img src="{{ $backendFigure }}" alt="Petugas BPS" class="backend-feature-figure">
                </div>
            </div>
        </section>

        <section class="backend-guide-panel">
            <div class="backend-guide-inner">
                <div class="backend-guide-text">
                    <p class="backend-guide-note">NB : File di akses menggunakan gmail BPS Kabupaten Mojokerto</p>
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
