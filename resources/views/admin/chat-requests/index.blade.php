<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div class="chat-header-shell" style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; width: 100%; flex-wrap: wrap;">
                <div class="chat-header-row" style="display: flex; align-items: center; justify-content: flex-start; gap: 1.1rem; padding-left: 0.75rem;">
                    <div class="rounded-xl section-icon-wrap" style="padding: 0.7rem; background-color: #dbeafe; margin-top: 0;">
                        <img src="{{ asset('asset/history chat.png') }}" alt="Histori Chat" class="object-contain section-header-icon" style="width: 29px; height: 29px; max-width: 29px; max-height: 29px;">
                        <span class="section-icon-underline" aria-hidden="true"></span>
                    </div>
                    <div>
                        <h2 class="font-bold text-3xl text-gray-800">Histori Permintaan Chat</h2>
                        <p class="mt-1 text-sm text-gray-500">Kelola semua permintaan chat dari pengunjung.</p>
                    </div>
                </div>

                <a href="{{ route('admin.chat-requests.export') }}" class="btn btn-primary inline-flex items-center gap-2 px-5 py-2.5">
                    <i data-lucide="download" class="w-4 h-4"></i>
                    <span>Export Excel</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="p-4 border-b border-gray-100">
                    <form method="GET" action="{{ route('admin.chat-requests.index') }}" class="flex flex-wrap items-end gap-3">
                        <div>
                            <label for="category" class="block text-xs font-semibold text-gray-500 uppercase mb-1">Kategori</label>
                            <select id="category" name="category" class="border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Semua</option>
                                <option value="pelayanan" {{ ($selectedCategory ?? '') === 'pelayanan' ? 'selected' : '' }}>Pelayanan</option>
                                <option value="pengaduan" {{ ($selectedCategory ?? '') === 'pengaduan' ? 'selected' : '' }}>Pengaduan</option>
                            </select>
                        </div>
                        <button type="submit" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-all">
                            Terapkan Filter
                        </button>
                        <a href="{{ route('admin.chat-requests.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">Reset</a>
                    </form>
                </div>
                <div class="overflow-x-auto">
                    <table class="activity-table">
                        <thead>
                            <tr>
                                <th>Waktu</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>HP</th>
                                <th>Kategori</th>
                                <th>Layanan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($chatRequests as $item)
                                <tr>
                                    <td>
                                        <span class="text-xs">{{ optional($item->submitted_at)?->timezone('Asia/Jakarta')->format('d M H:i') ?? '-' }}</span>
                                    </td>
                                    <td class="font-semibold">{{ $item->requester_name ?? '-' }}</td>
                                    <td class="text-xs font-mono">{{ $item->email ?? '-' }}</td>
                                    <td>{{ $item->phone ?? '-' }}</td>
                                    <td>
                                        @if (($item->request_category ?? 'pelayanan') === 'pengaduan')
                                            <span class="inline-block px-2 py-1 rounded-full bg-rose-100 text-rose-700 text-xs font-semibold">Pengaduan</span>
                                        @else
                                            <span class="inline-block px-2 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">Pelayanan</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="inline-block px-2 py-1 rounded-full bg-purple-100 text-purple-700 text-xs font-semibold">
                                            {{ $item->service_type ?? '-' }}
                                        </span>
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
