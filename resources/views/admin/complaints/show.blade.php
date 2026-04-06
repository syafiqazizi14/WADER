<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h2 class="font-bold text-3xl bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">📋 Detail Pengaduan</h2>       
                <p class="mt-1 text-sm text-gray-500">Informasi lengkap dan pengelolaan pengaduan</p>
            </div>
            <a href="{{ route('admin.complaints.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card space-y-6">
                <!-- Info Box -->
                <div class="bg-blue-50 border-l-4 border-blue-600 p-4">
                    <h3 class="font-bold text-lg text-blue-900 mb-2">Informasi Pelapor</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-blue-800">
                        <div>
                            <p class="font-semibold">Nama Lengkap</p>
                            <p>{{ $complaint->nama_lengkap }}</p>
                        </div>
                        <div>
                            <p class="font-semibold">Nomor Telepon</p>
                            <p>{{ $complaint->nomor_telp }}</p>
                        </div>
                        <div>
                            <p class="font-semibold">Email</p>
                            <p>{{ $complaint->email }}</p>
                        </div>
                        <div>
                            <p class="font-semibold">Nomor Identitas</p>
                            <p>{{ $complaint->nomor_identitas }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="font-semibold">Nama Instansi</p>
                            <p>{{ $complaint->nama_instansi }}</p>
                        </div>
                    </div>
                </div>

                <!-- Complaint Content -->
                <div>
                    <h3 class="font-bold text-lg mb-3">Isi Pengaduan</h3>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 whitespace-pre-wrap text-sm leading-relaxed text-gray-800">
                        {{ $complaint->pengaduan }}
                    </div>
                </div>

                <!-- Status Timeline -->
                <div>
                    <h3 class="font-bold text-lg mb-4">Status Pengaduan</h3>
                    <div class="flex items-center justify-between mb-6">
                        @php
                            $stages = [
                                'pending' => ['label' => 'Belum Diproses', 'icon' => '⏳'],
                                'processed' => ['label' => 'Sedang Diproses', 'icon' => '🔄'],
                                'closed' => ['label' => 'Selesai', 'icon' => '✓'],
                            ];
                        @endphp
                        @foreach ($stages as $status => $info)
                            <div class="flex flex-col items-center flex-1">
                                <div class="w-10 h-10 rounded-full {{ $complaint->status === $status ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600' }} flex items-center justify-center font-bold mb-2">
                                    {{ $info['icon'] }}
                                </div>
                                <p class="text-xs text-center {{ $complaint->status === $status ? 'font-bold text-blue-600' : 'text-gray-600' }}">
                                    {{ $info['label'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Update Status Form -->
                <div class="border-t pt-6">
                    <h3 class="font-bold text-lg mb-4">Perbarui Status</h3>
                    <form action="{{ route('admin.complaints.update', $complaint) }}" method="POST" class="flex gap-2 items-end">
                        @csrf
                        @method('PUT')
                        <div class="flex-1">
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status Baru</label>
                            <select name="status" id="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required>
                                @foreach ($statuses as $key => $label)
                                    <option value="{{ $key }}" {{ $complaint->status === $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                            Perbarui
                        </button>
                    </form>
                </div>

                <!-- Meta Information -->
                <div class="border-t pt-4 text-xs text-gray-500 space-y-1">
                    <p>Dipenerima pada: <span class="font-mono">{{ $complaint->created_at->format('d M Y H:i:s') }}</span></p>
                    <p>Terakhir diperbarui: <span class="font-mono">{{ $complaint->updated_at->format('d M Y H:i:s') }}</span></p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
