<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? 'Jenis Pelayanan' }} - WADER</title>
    <meta name="description" content="{{ $pageDescription ?? 'Layanan chatbot interaktif untuk memilih jenis pelayanan WADER.' }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=20260410">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=20260410">
    <link rel="apple-touch-icon" href="{{ asset('favicon-preview.png') }}?v=20260410">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="site-shell page-{{ ($requestCategory ?? 'pelayanan') === 'pengaduan' ? 'pengaduan' : 'jenis-pelayanan' }}">
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
                <a href="{{ route('site.chat') }}" class="layout-nav-link {{ ($requestCategory ?? 'pelayanan') === 'pelayanan' ? 'active' : '' }}">Jenis Pelayanan</a>
                <a href="{{ route('site.complaints') }}" class="layout-nav-link {{ ($requestCategory ?? 'pelayanan') === 'pengaduan' ? 'active' : '' }}">Pengaduan</a>
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

    <main class="chat-full-main">
        <section class="chat-full-wrap reveal-card" style="--delay: 60ms;">
            <div class="chat-full-head">
                <h1 class="content-followup-title">{{ $headingTitle ?? 'Jenis Pelayanan' }}</h1>
                <p class="content-followup-meta">{{ $headingDescription ?? 'Silakan isi data singkat lalu pilih jenis pelayanan. Chat ini akan langsung diteruskan ke petugas BPS Kabupaten Mojokerto.' }}</p>
            </div>

            <div class="chatbot-shell chat-full-shell" x-data="pstCenterChatbot()">
                <div class="chatbot-log chat-full-log" x-ref="log">
                    <template x-for="(message, idx) in messages" :key="idx">
                        <div class="chat-row" :class="message.from === 'bot' ? 'chat-row-bot' : 'chat-row-user'" :style="`--bubble-delay: ${idx * 70}ms`">
                            <template x-if="message.from === 'bot'">
                                <span class="chat-avatar">ðŸ¤–</span>
                            </template>
                            <div class="chat-bubble" :class="message.from === 'bot' ? 'chat-bubble-bot' : 'chat-bubble-user'" x-text="message.text"></div>
                        </div>
                    </template>

                    <div class="chat-row chat-row-bot chat-row-typing" x-show="isTyping">
                        <span class="chat-avatar">ðŸ¤–</span>
                        <div class="chat-bubble chat-bubble-bot chat-bubble-typing">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>

                <div class="chatbot-options" x-show="currentMode === 'options'">
                    <template x-for="choice in currentOptions" :key="choice">
                        <button type="button" class="chat-choice" @click="submitOption(choice)" x-text="choice"></button>
                    </template>
                </div>

                <form class="chatbot-input-wrap" @submit.prevent="submitText" x-show="currentMode === 'text'">
                    <input type="text" x-model="inputText" class="chatbot-input" placeholder="Ketik jawabanmu..." autocomplete="off">
                    <button type="submit" class="chatbot-send">Kirim</button>
                </form>

                <div class="chatbot-file-wrap" x-show="currentMode === 'file'">
                    <div>
                        <label for="evidence-upload" class="chatbot-file-label">Unggah bukti pendukung</label>
                        <p class="chatbot-file-hint">Format yang didukung: PDF, JPG, JPEG, PNG, WEBP, DOC, DOCX. Maksimal 10 MB per file.</p>
                    </div>
                    <input
                        id="evidence-upload"
                        type="file"
                        x-ref="evidenceInput"
                        class="chatbot-file-input"
                        accept=".pdf,.jpg,.jpeg,.png,.webp,.doc,.docx,image/*,application/pdf"
                        multiple
                    >
                    <div class="chatbot-file-actions">
                        <button type="button" class="chatbot-file-upload" @click="submitFiles">Unggah Bukti</button>
                        <span class="chatbot-file-name" x-show="evidenceFiles.length" x-text="evidenceFiles.map((file) => file.name).join(', ')"></span>
                    </div>
                </div>

                <div class="chatbot-reset-wrap">
                    <button type="button" class="chatbot-reset" @click="restartChat">Mulai Ulang Chat</button>
                </div>
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

    <script>
        function pstCenterChatbot() {
            const storeUrl = '{{ route('chat-requests.store') }}';
            const csrfToken = '{{ csrf_token() }}';
            const requestCategory = '{{ $requestCategory ?? 'pelayanan' }}';

            return {
                messages: [],
                inputText: '',
                currentMode: 'text',
                currentOptions: [],
                currentStep: null,
                dataForm: {},
                branchSteps: [],
                evidenceFiles: [],
                isTyping: false,
                isSaved: false,
                saveFailed: false,

                init() {
                    this.restartChat();
                },

                restartChat() {
                    this.messages = [];
                    this.inputText = '';
                    this.currentMode = 'text';
                    this.currentOptions = [];
                    this.currentStep = 'name';
                    this.dataForm = {};
                    this.branchSteps = [];
                    this.evidenceFiles = [];
                    this.isTyping = false;
                    this.isSaved = false;
                    this.saveFailed = false;
                    this.botAsk('Halo #SahabatData, dengan Siapa ini?');
                },

                scrollLog() {
                    this.$nextTick(() => {
                        this.$refs.log?.scrollTo({ top: this.$refs.log.scrollHeight, behavior: 'smooth' });
                    });
                },

                botAsk(text) {
                    this.isTyping = true;
                    window.setTimeout(() => {
                        this.messages.push({ from: 'bot', text });
                        this.isTyping = false;
                        this.scrollLog();
                    }, 380);
                },

                userSay(text) {
                    this.messages.push({ from: 'user', text });
                    this.scrollLog();
                },

                submitText() {
                    const value = this.inputText.trim();
                    if (!value || this.currentMode !== 'text') {
                        return;
                    }

                    this.inputText = '';
                    this.userSay(value);
                    this.advance(value);
                },

                submitOption(choice) {
                    if (this.currentMode !== 'options') {
                        return;
                    }

                    this.userSay(choice);
                    this.advance(choice);
                },

                setOptions(options) {
                    this.currentMode = 'options';
                    this.currentOptions = options;
                },

                setTextMode() {
                    this.currentMode = 'text';
                    this.currentOptions = [];
                },

                setFileMode() {
                    this.currentMode = 'file';
                    this.currentOptions = [];
                },

                submitFiles() {
                    if (this.currentMode !== 'file') {
                        return;
                    }

                    const input = this.$refs.evidenceInput;
                    const files = input?.files ? Array.from(input.files) : [];
                    if (!files.length) {
                        return;
                    }

                    this.evidenceFiles = files;
                    const fileNames = files.map((file) => file.name);
                    this.userSay(`Unggah bukti: ${fileNames.join(', ')}`);
                    this.dataForm.evidence_uploads = fileNames;
                    if (input) {
                        input.value = '';
                    }
                    this.advanceBranch(fileNames.join(', '));
                },

                advance(value) {
                    switch (this.currentStep) {
                        case 'name':
                            this.dataForm.name = value;
                            this.currentStep = 'age';
                            this.botAsk('Baik, bisa masukkan umur anda?');
                            this.setTextMode();
                            break;
                        case 'age':
                            this.dataForm.age = value;
                            this.currentStep = 'gender';
                            this.botAsk('Jenis kelamin anda?');
                            this.setOptions(['Laki-laki', 'Perempuan']);
                            break;
                        case 'gender':
                            this.dataForm.gender = value;
                            this.currentStep = 'institution';
                            this.botAsk('Nama Dinas/Instansi anda?');
                            this.setTextMode();
                            break;
                        case 'institution':
                            this.dataForm.institution = value;
                            this.currentStep = 'address';
                            this.botAsk('Baik, Silakan masukkan Alamat anda!');
                            this.setTextMode();
                            break;
                        case 'address':
                            this.dataForm.address = value;
                            this.currentStep = 'email';
                            this.botAsk('Masukkan alamat email anda');
                            this.setTextMode();
                            break;
                        case 'email':
                            this.dataForm.email = value;
                            this.currentStep = 'phone';
                            this.botAsk('Masukkan nomor HP anda ya');
                            this.setTextMode();
                            break;
                        case 'phone':
                            this.dataForm.phone = value;
                            if (requestCategory === 'pengaduan') {
                                this.dataForm.service = 'Pengaduan';
                                this.setupBranch('Pengaduan');
                                this.runBranchStep();
                            } else {
                                this.currentStep = 'service';
                                this.botAsk('Apa yang bisa kami bantu?');
                                this.setOptions([
                                    'Permintaan Data',
                                    'Rekomendasi Statistik',
                                    'Magang BPS',
                                    'Konsultasi Statistik',
                                    'Penjualan Produk Statistik Berbayar'
                                ]);
                            }
                            break;
                        case 'service':
                            this.dataForm.service = value;
                            this.setupBranch(value);
                            this.runBranchStep();
                            break;
                        default:
                            this.advanceBranch(value);
                            break;
                    }
                },

                setupBranch(service) {
                    const branches = {
                        'Pengaduan': [
                            { key: 'complaint_type', ask: 'Jenis pengaduan apa yang ingin disampaikan?', mode: 'options', options: ['Pelanggaran Integritas', 'Pelanggaran Disiplin', 'Penyalahgunaan Wewenang', 'Lainnya'] },
                            { key: 'complaint_detail', ask: 'Silakan jelaskan kronologi pengaduan secara ringkas dan jelas.', mode: 'text' },
                            { key: 'incident_time', ask: 'Kapan kejadian tersebut terjadi?', mode: 'text' },
                            { key: 'incident_location', ask: 'Di mana lokasi kejadian?', mode: 'text' },
                            { key: 'has_evidence', ask: 'Apakah Anda memiliki bukti pendukung?', mode: 'options', options: ['Ada', 'Tidak Ada'] },
                            { key: 'evidence_uploads', ask: 'Silakan unggah bukti pendukung dalam bentuk file.', mode: 'file' },
                            { key: 'final', ask: 'Laporan pengaduan Anda sudah kami terima. Tim kami akan melakukan verifikasi dan menindaklanjuti sesuai prosedur.', mode: 'done' },
                        ],
                        'Permintaan Data': [
                            { key: 'request_detail', ask: 'Tolong sebutkan data yang diminta', mode: 'text' },
                            { key: 'has_letter', ask: 'Apakah ada surat dari instansi?', mode: 'options', options: ['Ada', 'Tidak'] },
                            { key: 'final', ask: 'Terima kasih, permintaan data Anda kami proses. Tim kami akan menghubungi melalui email atau nomor HP yang sudah diberikan.', mode: 'done' },
                        ],
                        'Rekomendasi Statistik': [
                            { key: 'topic', ask: 'Topik rekomendasi statistik apa yang dibutuhkan?', mode: 'text' },
                            { key: 'urgency', ask: 'Apakah rekomendasinya untuk kebutuhan cepat?', mode: 'options', options: ['Ya', 'Tidak'] },
                            { key: 'final', ask: 'Baik, kebutuhan rekomendasi statistik Anda sudah tercatat. Kami akan menyiapkan arahan indikator prioritas.', mode: 'done' },
                        ],
                        'Magang BPS': [
                            { key: 'intern_name', ask: 'Nama Pemagang', mode: 'text' },
                            { key: 'university', ask: 'Dari universitas mana ya?', mode: 'text' },
                            { key: 'duration', ask: 'Coba ceritakan rencana durasi magang? Dari kapan?', mode: 'text' },
                            { key: 'people_count', ask: 'Berapa orang?', mode: 'text' },
                            { key: 'final', ask: 'Informasi magang sudah kami terima. Silakan lanjut kirim surat pengantar resmi ke email layanan kami.', mode: 'done' },
                        ],
                        'Konsultasi Statistik': [
                            { key: 'consult_topic', ask: 'Topik konsultasi statistik yang ingin dibahas apa?', mode: 'text' },
                            { key: 'consult_channel', ask: 'Konsultasi ingin dilakukan online atau tatap muka?', mode: 'options', options: ['Online', 'Tatap Muka'] },
                            { key: 'final', ask: 'Terima kasih, jadwal konsultasi statistik akan kami koordinasikan lebih lanjut melalui kontak Anda.', mode: 'done' },
                        ],
                        'Penjualan Produk Statistik Berbayar': [
                            { key: 'product_name', ask: 'Produk statistik berbayar apa yang ingin dipesan?', mode: 'text' },
                            { key: 'product_amount', ask: 'Berapa kebutuhan eksemplar/produk?', mode: 'text' },
                            { key: 'final', ask: 'Baik, detail pemesanan produk statistik berbayar sudah tercatat. Tim kami akan mengirim informasi biaya dan prosedurnya.', mode: 'done' },
                        ],
                    };

                    this.branchSteps = branches[service] || [];
                    this.currentStep = 'branch';
                },

                runBranchStep() {
                    const step = this.branchSteps[0];
                    if (!step) {
                        this.finishConversation();
                        return;
                    }

                    this.botAsk(step.ask);
                    if (step.mode === 'options') {
                        this.setOptions(step.options || []);
                    } else if (step.mode === 'text') {
                        this.setTextMode();
                    } else if (step.mode === 'file') {
                        this.setFileMode();
                    } else {
                        this.setTextMode();
                        this.branchSteps.shift();
                        this.finishConversation();
                    }
                },

                advanceBranch(value) {
                    const step = this.branchSteps.shift();
                    if (!step) {
                        this.finishConversation();
                        return;
                    }

                    if (step.mode !== 'done') {
                        this.dataForm[step.key] = value;
                    }

                    if (step.key === 'has_evidence' && value !== 'Ada') {
                        this.branchSteps = this.branchSteps.filter((item) => item.key !== 'evidence_uploads');
                    }

                    if (!this.branchSteps.length) {
                        this.finishConversation();
                        return;
                    }

                    this.runBranchStep();
                },

                async finishConversation() {
                    this.currentStep = 'done';
                    this.currentMode = 'done';
                    this.currentOptions = [];
                    this.botAsk('Terima kasih sudah menghubungi Badan Pusat Statistik Mojokerto. Keperluanmu akan segera kami proses sesuai antrian.');

                    if (!this.isSaved) {
                        await this.saveConversation();
                    }
                },

                async saveConversation() {
                    try {
                        const payload = new FormData();
                        payload.append('request_category', requestCategory);
                        payload.append('form_data', JSON.stringify(this.dataForm));
                        payload.append('messages', JSON.stringify(this.messages));

                        this.evidenceFiles.forEach((file) => {
                            payload.append('evidence_files[]', file);
                        });

                        const response = await fetch(storeUrl, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            body: payload,
                        });

                        if (!response.ok) {
                            throw new Error('Failed to save chat request');
                        }

                        this.isSaved = true;
                    } catch (error) {
                        this.saveFailed = true;
                        this.botAsk('Data chat belum tersimpan sempurna. Silakan klik "Mulai Ulang Chat" dan kirim ulang bila diperlukan.');
                    }
                },
            };
        }
    </script>
</body>
</html>

