<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h2 class="font-bold text-3xl bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">💬 Histori Permintaan Chat</h2>
                <p class="mt-1 text-sm text-gray-500">Kelola semua permintaan chat dari pengunjung</p>
            </div>
            <a href="{{ route('admin.chat-requests.export') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-all shadow-sm hover:shadow active:scale-95">
                <i data-lucide="download" class="w-4 h-4"></i> Export Excel
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="overflow-x-auto">
                    <table class="activity-table">
                        <thead>
                            <tr>
                                <th>⏰ Waktu</th>
                                <th>👤 Nama</th>
                                <th>📧 Email</th>
                                <th>📱 HP</th>
                                <th>🎯 Layanan</th>
                                <th>📊 Status</th>
                                <th>⚙️ Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($chatRequests as $item)
                                <tr>
                                    <td>
                                        <span class="text-xs">{{ optional($item->submitted_at)->format('d M H:i') ?? '-' }}</span>
                                    </td>
                                    <td class="font-semibold">{{ $item->requester_name ?? '-' }}</td>
                                    <td class="text-xs font-mono">{{ $item->email ?? '-' }}</td>
                                    <td>{{ $item->phone ?? '-' }}</td>
                                    <td>
                                        <span class="inline-block px-2 py-1 rounded-full bg-purple-100 text-purple-700 text-xs font-semibold">
                                            {{ $item->service_type ?? '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($item->status === 'approved')
                                            <span class="badge badge-success">✓ Approved</span>
                                        @elseif($item->status === 'pending')
                                            <span class="badge badge-primary">⏳ Pending</span>
                                        @else
                                            <span class="badge badge-danger">✕ {{ ucfirst($item->status) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.chat-requests.show', $item) }}" class="text-blue-600 hover:text-blue-800 font-semibold transition-all hover:underline">
                                            👁️ Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-8 text-center text-gray-400">
                                        <p class="text-lg">📭 Belum ada histori chat.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                {{ $chatRequests->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
