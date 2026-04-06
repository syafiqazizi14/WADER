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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="site-shell page-{{ ($requestCategory ?? 'pelayanan') === 'pengaduan' ? 'pengaduan' : 'jenis-pelayanan' }}">
    @php
        $logoHeader = asset('asset/logo bps.png');
    @endphp

    <header class="layout-header">
        <div class="layout-header-inner">
            <a href="{{ route('site.home') }}" class="brand-lockup">
                <img src="{{ $logoHeader }}" alt="BPS Kabupaten Mojokerto" class="brand-logo-header">
            </a>

            <nav class="layout-nav">
                <a href="{{ route('site.page', 'beranda') }}" class="layout-nav-link">Beranda</a>

                <a href="{{ route('site.page', 'pst-center') }}" class="layout-nav-link">PST Center</a>
                <a href="{{ route('site.chat') }}" class="layout-nav-link {{ ($requestCategory ?? 'pelayanan') === 'pelayanan' ? 'active' : '' }}">Jenis Pelayanan</a>
                <a href="{{ route('site.complaints') }}" class="layout-nav-link {{ ($requestCategory ?? 'pelayanan') === 'pengaduan' ? 'active' : '' }}">Pengaduan</a>
                <a href="{{ route('site.pst-center') }}" class="layout-nav-link">PST Center</a>
                <a href="{{ route('site.chat') }}" class="layout-nav-link active">Jenis Pelayanan</a>
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

    <main class="chat-full-main">
        <section class="chat-full-wrap reveal-card" style="--delay: 60ms;">
            <div class="chat-full-head">
                <h1 class="content-followup-title">{{ $headingTitle ?? 'Jenis Pelayanan' }}</h1>
                <p class="content-followup-meta">{{ $headingDescription ?? 'Silakan isi data singkat lalu pilih jenis pelayanan. Chat ini akan langsung diteruskan ke petugas BPS Kabupaten Mojokerto.' }}</p>
            </div>

            <div class="chatbot-shell chat-full-shell" x-data="pstCenterChatbot('{{ $requestCategory ?? 'pelayanan' }}')">
                <div class="chatbot-log chat-full-log" x-ref="log">
                    <template x-for="(message, idx) in messages" :key="idx">
                        <div class="chat-row" :class="message.from === 'bot' ? 'chat-row-bot' : 'chat-row-user'">
                            <template x-if="message.from === 'bot'">
                                <span class="chat-avatar">🤖</span>
                            </template>
                            <div class="chat-bubble" :class="message.from === 'bot' ? 'chat-bubble-bot' : 'chat-bubble-user'" x-text="message.text"></div>
                        </div>
                    </template>
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
        function pstCenterChatbot(requestCategory = 'pelayanan') {
            const storeUrl = '{{ route('chat-requests.store') }}';
            const csrfToken = '{{ csrf_token() }}';

            return {
                messages: [],
                inputText: '',
                currentMode: 'text',
                currentOptions: [],
                currentStep: null,
                dataForm: {},
                branchSteps: [],
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
                    this.dataForm.request_category = requestCategory;
                    this.branchSteps = [];
                    this.isSaved = false;
                    this.saveFailed = false;
                    this.botAsk(requestCategory === 'pengaduan'
                        ? 'Halo #SahabatData, kami siap menerima pengaduan Anda. Dengan siapa kami berbicara?'
                        : 'Halo #SahabatData, dengan Siapa ini?');
                },

                botAsk(text) {
                    this.messages.push({ from: 'bot', text });
                    this.$nextTick(() => {
                        this.$refs.log.scrollTop = this.$refs.log.scrollHeight;
                    });
                },

                userSay(text) {
                    this.messages.push({ from: 'user', text });
                    this.$nextTick(() => {
                        this.$refs.log.scrollTop = this.$refs.log.scrollHeight;
                    });
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
                                this.currentStep = 'complaint_category';
                                this.botAsk('Kategori pengaduan Anda?');
                                this.setOptions([
                                    'Pengaduan Pelayanan',
                                    'Pengaduan Perilaku Petugas',
                                    'Pengaduan Lainnya'
                                ]);
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
                        case 'complaint_category':
                            this.dataForm.service = value;
                            this.currentStep = 'complaint_detail';
                            this.botAsk('Silakan jelaskan pengaduan Anda secara ringkas dan jelas.');
                            this.setTextMode();
                            break;
                        case 'complaint_detail':
                            this.dataForm.complaint_detail = value;
                            this.currentStep = 'complaint_expectation';
                            this.botAsk('Apa tindak lanjut yang Anda harapkan dari kami?');
                            this.setTextMode();
                            break;
                        case 'complaint_expectation':
                            this.dataForm.complaint_expectation = value;
                            this.finishConversation();
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
                    this.botAsk(requestCategory === 'pengaduan'
                        ? 'Terima kasih, pengaduan Anda sudah kami terima dan akan ditindaklanjuti sesuai prosedur.'
                        : 'Terima kasih sudah menghubungi Badan Pusat Statistik Mojokerto. Keperluanmu akan segera kami proses sesuai antrian.');

                    if (!this.isSaved) {
                        await this.saveConversation();
                    }
                },

                async saveConversation() {
                    try {
                        const response = await fetch(storeUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            body: JSON.stringify({
                                form_data: this.dataForm,
                                messages: this.messages,
                            }),
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
