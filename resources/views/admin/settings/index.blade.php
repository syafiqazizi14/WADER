<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">⚙️ Pengaturan Global</h2>
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
                <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <!-- Email Kontak -->
                    <div>
                        <label class="auth-form-label">📧 Email Kontak</label>
                        <input type="email" 
                            name="contact_email" 
                            value="{{ old('contact_email', $settings['contact_email'] ?? '') }}"
                            placeholder="admin@wader.id"
                            class="w-full border-1.5 border-blue-200 rounded-lg px-4 py-2.5 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 transition-all">
                        <p class="text-xs text-gray-500 mt-1">💡 Email untuk menerima pesan dari pengunjung</p>
                    </div>

                    <!-- WhatsApp URL -->
                    <div>
                        <label class="auth-form-label">📱 WhatsApp URL</label>
                        <input type="url" 
                            name="contact_whatsapp" 
                            value="{{ old('contact_whatsapp', $settings['contact_whatsapp'] ?? '') }}"
                            placeholder="https://wa.me/62..."
                            class="w-full border-1.5 border-blue-200 rounded-lg px-4 py-2.5 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 transition-all">
                        <p class="text-xs text-gray-500 mt-1">💡 Link WhatsApp untuk kontak langsung</p>
                    </div>

                    <!-- Instagram URL -->
                    <div>
                        <label class="auth-form-label">📸 Instagram URL</label>
                        <input type="url" 
                            name="contact_instagram" 
                            value="{{ old('contact_instagram', $settings['contact_instagram'] ?? '') }}"
                            placeholder="https://instagram.com/..."
                            class="w-full border-1.5 border-blue-200 rounded-lg px-4 py-2.5 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 transition-all">
                        <p class="text-xs text-gray-500 mt-1">💡 Profil Instagram</p>
                    </div>

                    <!-- Facebook URL -->
                    <div>
                        <label class="auth-form-label">👍 Facebook URL</label>
                        <input type="url" 
                            name="contact_facebook" 
                            value="{{ old('contact_facebook', $settings['contact_facebook'] ?? '') }}"
                            placeholder="https://facebook.com/..."
                            class="w-full border-1.5 border-blue-200 rounded-lg px-4 py-2.5 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 transition-all">
                        <p class="text-xs text-gray-500 mt-1">💡 Profil Facebook</p>
                    </div>

                    <!-- Instansi Link -->
                    <div>
                        <label class="auth-form-label">🌐 Website Instansi</label>
                        <input type="url" 
                            name="instansi_link" 
                            value="{{ old('instansi_link', $settings['instansi_link'] ?? '') }}"
                            placeholder="https://instansi.gov.id"
                            class="w-full border-1.5 border-blue-200 rounded-lg px-4 py-2.5 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 transition-all">
                        <p class="text-xs text-gray-500 mt-1">💡 URL website resmi instansi</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4 border-t-2 border-blue-100">
                        <button type="submit" class="bg-gray-900 text-white px-6 py-2.5 rounded-lg font-bold uppercase tracking-widest hover:shadow-lg transition-all active:scale-95 inline-flex items-center gap-2">
                            ✅ Simpan Pengaturan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
