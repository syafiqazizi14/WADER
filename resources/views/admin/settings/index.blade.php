<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pengaturan Global</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 bg-green-100 text-green-800 p-3 rounded">{{ session('status') }}</div>
            @endif

            <div class="bg-white p-6 rounded shadow-sm border">
                <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email Kontak</label>
                        <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" class="mt-1 w-full border rounded p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">WhatsApp URL</label>
                        <input type="url" name="contact_whatsapp" value="{{ old('contact_whatsapp', $settings['contact_whatsapp'] ?? '') }}" class="mt-1 w-full border rounded p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Instagram URL</label>
                        <input type="url" name="contact_instagram" value="{{ old('contact_instagram', $settings['contact_instagram'] ?? '') }}" class="mt-1 w-full border rounded p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Facebook URL</label>
                        <input type="url" name="contact_facebook" value="{{ old('contact_facebook', $settings['contact_facebook'] ?? '') }}" class="mt-1 w-full border rounded p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Website Instansi</label>
                        <input type="url" name="instansi_link" value="{{ old('instansi_link', $settings['instansi_link'] ?? '') }}" class="mt-1 w-full border rounded p-2">
                    </div>

                    <button class="bg-gray-900 text-white px-4 py-2 rounded">Simpan Pengaturan</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
