<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard Admin</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="bg-green-100 text-green-800 p-3 rounded">{{ session('status') }}</div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-5 rounded shadow-sm border">
                    <p class="text-sm text-gray-500">Total Halaman</p>
                    <p class="text-2xl font-bold">{{ $totalPages }}</p>
                </div>
                <div class="bg-white p-5 rounded shadow-sm border">
                    <p class="text-sm text-gray-500">Halaman Publish</p>
                    <p class="text-2xl font-bold">{{ $publishedPages }}</p>
                </div>
                <div class="bg-white p-5 rounded shadow-sm border">
                    <p class="text-sm text-gray-500">Link Layanan Aktif</p>
                    <p class="text-2xl font-bold">{{ $activeServiceLinks }}</p>
                </div>
            </div>

            <div class="bg-white p-5 rounded shadow-sm border">
                <h3 class="text-lg font-semibold mb-3">Aktivitas Terbaru</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left border-b">
                                <th class="py-2">Waktu</th>
                                <th class="py-2">User</th>
                                <th class="py-2">Modul</th>
                                <th class="py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentActivities as $activity)
                                <tr class="border-b">
                                    <td class="py-2">{{ $activity->created_at?->format('d M Y H:i') }}</td>
                                    <td class="py-2">{{ $activity->user?->name ?? '-' }}</td>
                                    <td class="py-2">{{ $activity->module }}</td>
                                    <td class="py-2">{{ $activity->action }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-3 text-gray-500">Belum ada aktivitas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
