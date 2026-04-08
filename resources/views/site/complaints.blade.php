<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan - WADER</title>
    <meta name="description" content="Saluran pengaduan resmi BPS Kabupaten Mojokerto untuk melaporkan pelanggaran.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="site-shell page-pengaduan">
    @php
        $logoHeader = asset('asset/logo bps.png');
    @endphp

    <header class="layout-header">
        <div class="layout-header-inner">
            <a href="{{ route('site.home') }}" class="brand-lockup {{ request()->route()->getName() === 'site.page' && request()->route('slug') === 'statistik-mojokerto' ? 'active' : '' }}">
                <img src="{{ $logoHeader }}" alt="BPS Kabupaten Mojokerto" class="brand-logo-header">
            </a>

            <nav class="layout-nav">
                <a href="{{ route('site.page', 'beranda') }}" class="layout-nav-link">Beranda</a>
                <a href="{{ route('site.page', 'pst-center') }}" class="layout-nav-link">PST Center</a>
                <a href="{{ route('site.chat') }}" class="layout-nav-link">Jenis Pelayanan</a>
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
        <section class="content-followup-wrap reveal-card" style="--delay: 60ms;">
            <div class="content-followup-head">
                <h1 class="content-followup-title">Pengaduan</h1>
                <p class="content-followup-meta">Saluran resmi untuk melaporkan perbuatan berindikasi pelanggaran di lingkungan BPS Kabupaten Mojokerto. Kerahasiaan identitas Anda dijamin.</p>
            </div>

            <article class="content-followup-card reveal-card" style="--delay: 140ms;">
                <div class="content-followup-body">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4" role="alert">
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('complaints.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div class="form-group">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input 
                                type="text" 
                                id="nama_lengkap" 
                                name="nama_lengkap"
                                value="{{ old('nama_lengkap') }}"
                                required
                                placeholder="Masukkan nama lengkap Anda"
                                class="form-input @error('nama_lengkap') border-red-500 @enderror"
                            >
                            @error('nama_lengkap')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nomor_telp" class="form-label">Nomor Telepon <span class="text-red-500">*</span></label>
                            <input 
                                type="tel" 
                                id="nomor_telp" 
                                name="nomor_telp"
                                value="{{ old('nomor_telp') }}"
                                required
                                placeholder="Contoh: 082234567890"
                                class="form-input @error('nomor_telp') border-red-500 @enderror"
                            >
                            @error('nomor_telp')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nomor_identitas" class="form-label">Nomor Identitas (KTP/SIM/Paspor) <span class="text-red-500">*</span></label>
                            <input 
                                type="text" 
                                id="nomor_identitas" 
                                name="nomor_identitas"
                                value="{{ old('nomor_identitas') }}"
                                required
                                placeholder="Masukkan nomor identitas Anda"
                                class="form-input @error('nomor_identitas') border-red-500 @enderror"
                            >
                            @error('nomor_identitas')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_instansi" class="form-label">Nama Instansi <span class="text-red-500">*</span></label>
                            <input 
                                type="text" 
                                id="nama_instansi" 
                                name="nama_instansi"
                                value="{{ old('nama_instansi') }}"
                                required
                                placeholder="Masukkan nama instansi Anda"
                                class="form-input @error('nama_instansi') border-red-500 @enderror"
                            >
                            @error('nama_instansi')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email <span class="text-red-500">*</span></label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email"
                                value="{{ old('email') }}"
                                required
                                placeholder="Masukkan alamat email Anda"
                                class="form-input @error('email') border-red-500 @enderror"
                            >
                            @error('email')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pengaduan" class="form-label">Isi Pengaduan <span class="text-red-500">*</span></label>
                            <textarea 
                                id="pengaduan" 
                                name="pengaduan"
                                required
                                placeholder="Deskripsikan pengaduan Anda dengan jelas dan lengkap. Minimal 10 karakter."
                                rows="8"
                                class="form-input @error('pengaduan') border-red-500 @enderror"
                            >{{ old('pengaduan') }}</textarea>
                            @error('pengaduan')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-info bg-blue-50 border border-blue-200 rounded-lg p-4 my-4">
                            <p class="text-sm text-blue-800 mb-2">
                                <strong>Catatan Penting:</strong>
                            </p>
                            <ul class="text-sm text-blue-700 list-disc list-inside space-y-1">
                                <li>Kerahasiaan identitas Anda dijamin oleh BPS Kabupaten Mojokerto</li>
                                <li>Pengaduan yang disertai bukti-bukti jelas akan ditindaklanjuti lebih cepat</li>
                                <li>Tim kami akan melakukan verifikasi terhadap laporan Anda</li>
                            </ul>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-full">
                            Kirim Pengaduan
                        </button>
                    </form>
                </div>
            </article>
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
</body>
</html>
