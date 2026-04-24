<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div class="settings-header-row" style="display: flex; align-items: center; justify-content: flex-start; gap: 1.1rem; width: 100%; padding-left: 0.75rem;">
                <div class="rounded-xl section-icon-wrap" style="padding: 0.7rem; background-color: #dbeafe; margin-top: 0;">
                    <img src="{{ asset('asset/settings.png') }}" alt="Pengaturan" class="object-contain section-header-icon" style="width: 29px; height: 29px; max-width: 29px; max-height: 29px;">
                    <span class="section-icon-underline" aria-hidden="true"></span>
                </div>
                <div>
                    <h2 class="font-bold text-3xl text-gray-800">Pengaturan Global</h2>
                    <p class="mt-1 text-sm text-gray-500">Kelola informasi kontak dan tautan sosial resmi instansi.</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="alert alert-success mb-6 flex items-center gap-3">
                    <span class="text-xl">✓</span>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kontak dan Media Sosial</h3>
                    <p class="mt-1 text-sm text-gray-500">Pastikan semua URL valid agar pengunjung bisa terhubung ke kanal resmi.</p>
                </div>

                <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Email Kontak -->
                    <div class="space-y-2">
                        <label class="auth-form-label inline-flex items-center gap-2 text-slate-800 font-semibold">
                            <img src="{{ asset('asset/email.png') }}" alt="Email" class="w-4 h-4 object-contain">
                            <span>Email Kontak</span>
                        </label>
                        <input type="email"
                            name="contact_email"
                            value="{{ old('contact_email', $settings['contact_email'] ?? '') }}"
                            placeholder="admin@wader.id"
                            class="form-input w-full">
                        @error('contact_email')
                            <p class="form-error-message">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500">Email untuk menerima pesan dari pengunjung.</p>
                    </div>

                    <!-- WhatsApp URL -->
                    <div class="space-y-2">
                        <label class="auth-form-label inline-flex items-center gap-2 text-slate-800 font-semibold">
                            <img src="{{ asset('asset/whatapp.png') }}" alt="WhatsApp" class="w-4 h-4 object-contain">
                            <span>WhatsApp URL</span>
                        </label>
                        <input type="url"
                            name="contact_whatsapp"
                            value="{{ old('contact_whatsapp', $settings['contact_whatsapp'] ?? '') }}"
                            placeholder="https://wa.me/62..."
                            class="form-input w-full">
                        @error('contact_whatsapp')
                            <p class="form-error-message">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500">Link WhatsApp untuk kontak langsung.</p>
                    </div>

                    <!-- Instagram URL -->
                    <div class="space-y-2">
                        <label class="auth-form-label inline-flex items-center gap-2 text-slate-800 font-semibold">
                            <img src="{{ asset('asset/instagram.png') }}" alt="Instagram" class="w-4 h-4 object-contain">
                            <span>Instagram URL</span>
                        </label>
                        <input type="url"
                            name="contact_instagram"
                            value="{{ old('contact_instagram', $settings['contact_instagram'] ?? '') }}"
                            placeholder="https://instagram.com/..."
                            class="form-input w-full">
                        @error('contact_instagram')
                            <p class="form-error-message">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500">Profil Instagram resmi instansi.</p>
                    </div>

                    <!-- Facebook URL -->
                    <div class="space-y-2">
                        <label class="auth-form-label inline-flex items-center gap-2 text-slate-800 font-semibold">
                            <img src="{{ asset('asset/facebook.png') }}" alt="Facebook" class="w-4 h-4 object-contain">
                            <span>Facebook URL</span>
                        </label>
                        <input type="url"
                            name="contact_facebook"
                            value="{{ old('contact_facebook', $settings['contact_facebook'] ?? '') }}"
                            placeholder="https://facebook.com/..."
                            class="form-input w-full">
                        @error('contact_facebook')
                            <p class="form-error-message">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500">Profil Facebook resmi instansi.</p>
                    </div>

                    <!-- Instansi Link -->
                    <div class="space-y-2">
                        <label class="auth-form-label inline-flex items-center gap-2 text-slate-800 font-semibold">
                            <img src="{{ asset('asset/www.png') }}" alt="Website" class="w-4 h-4 object-contain">
                            <span>Website Instansi</span>
                        </label>
                        <input type="url"
                            name="instansi_link"
                            value="{{ old('instansi_link', $settings['instansi_link'] ?? '') }}"
                            placeholder="https://instansi.gov.id"
                            class="form-input w-full">
                        @error('instansi_link')
                            <p class="form-error-message">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500">URL website resmi instansi.</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4 border-t-2 border-blue-100 flex items-center justify-start">
                        <button type="submit" class="btn btn-primary inline-flex items-center gap-2 px-6 py-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>
                            <span>Simpan Pengaturan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
