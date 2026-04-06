<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h2 class="font-bold text-3xl bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">📋 Data Pengaduan</h2>       
                <p class="mt-1 text-sm text-gray-500">Kelola dan pantau semua pengaduan yang masuk</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="mb-6 pb-4 border-b border-gray-200">
                    <div class="flex flex-col gap-4">
                        <div class="flex flex-wrap gap-3 items-center">
                            <form method="GET" action="{{ route('admin.complaints.index') }}" class="flex flex-wrap gap-2 w-full">
                                <div class="flex-1 min-w-64">
                                    <input 
                                        type="text" 
                                        name="search" 
                                        placeholder="Cari nama, email, atau nomor identitas..." 
                                        value="{{ request('search') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-blue-500"
                                    >
                                </div>
                                <select 
                                    name="status" 
                                    class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-blue-500"
                                >
                                    <option value="">Semua Status</option>
                                    @foreach ($statuses as $key => $label)
                                        <option value="{{ $key }}" {{ request('status') === $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                <button 
                                    type="submit" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors"
                                >
                                    Cari
                                </button>
                                @if (request('search') || request('status'))
                                    <a 
                                        href="{{ route('admin.complaints.index') }}"
                                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-100 transition-colors"
                                    >
                                        Reset
                                    </a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="activity-table">
                        <thead>
                            <tr>
                                <th>🕐 Waktu</th>
                                <th>👤 Nama Lengkap</th>
                                <th>📧 Email</th>
                                <th>📱 Nomor Telp</th>
                                <th>🏢 Instansi</th>
                                <th>📊 Status</th>
                                <th>⚙️ Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($complaints as $complaint)
                                <tr>
                                    <td>
                                        <span class="text-xs">{{ $complaint->created_at->format('d M H:i') }}</span>
                                    </td>
                                    <td class="font-semibold">{{ $complaint->nama_lengkap }}</td>
                                    <td class="text-xs font-mono">{{ $complaint->email }}</td>
                                    <td>{{ $complaint->nomor_telp }}</td>
                                    <td class="text-sm">{{ $complaint->nama_instansi }}</td>
                                    <td>
                                        @if ($complaint->status === 'pending')
                                            <span class="badge badge-warning">⏳ Belum Diproses</span>
                                        @elseif ($complaint->status === 'processed')
                                            <span class="badge badge-info">🔄 Sedang Diproses</span>
                                        @else
                                            <span class="badge badge-success">✓ Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a 
                                            href="{{ route('admin.complaints.show', $complaint) }}" 
                                            class="text-blue-600 hover:text-blue-800 font-semibold transition-all hover:underline"
                                        >
                                            👁️ Lihat
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-8 text-center text-gray-400">
                                        <p class="text-lg">📭 Tidak ada pengaduan</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                {{ $complaints->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
