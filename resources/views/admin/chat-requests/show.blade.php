<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-3">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Histori Chat</h2>
            <a href="{{ route('admin.chat-requests.index') }}" class="text-blue-600">Kembali</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white p-5 rounded border shadow-sm">
                <h3 class="font-semibold mb-3">Data Pemohon</h3>
                <div class="grid md:grid-cols-2 gap-3 text-sm">
                    <p><span class="font-semibold">Nama:</span> {{ $chatRequest->requester_name ?? '-' }}</p>
                    <p><span class="font-semibold">Email:</span> {{ $chatRequest->email ?? '-' }}</p>
                    <p><span class="font-semibold">HP:</span> {{ $chatRequest->phone ?? '-' }}</p>
                    <p><span class="font-semibold">Jenis Kelamin:</span> {{ $chatRequest->gender ?? '-' }}</p>
                    <p><span class="font-semibold">Umur:</span> {{ $chatRequest->age ?? '-' }}</p>
                    <p><span class="font-semibold">Instansi:</span> {{ $chatRequest->institution ?? '-' }}</p>
                    <p class="md:col-span-2"><span class="font-semibold">Alamat:</span> {{ $chatRequest->address ?? '-' }}</p>
                    <p><span class="font-semibold">Layanan:</span> {{ $chatRequest->service_type ?? '-' }}</p>
                    <p><span class="font-semibold">Waktu Submit:</span> {{ optional($chatRequest->submitted_at)->format('d M Y H:i:s') }}</p>
                </div>
            </div>

            <div class="bg-white p-5 rounded border shadow-sm">
                <h3 class="font-semibold mb-3">Detail Layanan</h3>
                <div class="grid md:grid-cols-2 gap-3 text-sm">
                    @forelse ($chatRequest->service_answers as $label => $value)
                        <p><span class="font-semibold">{{ $label }}:</span> {{ $value }}</p>
                    @empty
                        <p class="text-gray-500 text-sm md:col-span-2">Belum ada jawaban lanjutan setelah pemilihan layanan.</p>
                    @endforelse
                </div>
            </div>

            @php
                $evidenceUploads = collect(data_get($chatRequest->form_data, 'evidence_uploads', []));
            @endphp

            @if ($evidenceUploads->isNotEmpty())
                <div class="bg-white p-5 rounded border shadow-sm">
                    <h3 class="font-semibold mb-3">Bukti Pendukung</h3>
                    <div class="grid md:grid-cols-2 gap-3 text-sm">
                        @foreach ($evidenceUploads as $upload)
                            <div class="border rounded p-3">
                                <p class="font-semibold">{{ $upload['original_name'] ?? '-' }}</p>
                                @if (!empty($upload['path']))
                                    <a href="{{ asset('storage/'.$upload['path']) }}" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">Lihat file</a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
