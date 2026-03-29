<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Link Layanan</h2>
            <a href="{{ route('admin.service-links.create') }}" class="bg-gray-900 text-white px-3 py-2 rounded text-sm">Tambah Link</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 bg-green-100 text-green-800 p-3 rounded">{{ session('status') }}</div>
            @endif

            <div class="bg-white p-5 rounded shadow-sm border overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left border-b">
                            <th class="py-2">Nama</th>
                            <th class="py-2">Kategori</th>
                            <th class="py-2">URL</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($links as $link)
                            <tr class="border-b">
                                <td class="py-2">{{ $link->name }}</td>
                                <td class="py-2">{{ $link->category ?? '-' }}</td>
                                <td class="py-2"><a href="{{ $link->url }}" target="_blank" class="text-blue-600">Buka</a></td>
                                <td class="py-2">{{ $link->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                                <td class="py-2 space-x-2">
                                    <a href="{{ route('admin.service-links.edit', $link) }}" class="text-blue-600">Edit</a>
                                    <form action="{{ route('admin.service-links.destroy', $link) }}" method="POST" class="inline" onsubmit="return confirm('Hapus link ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="py-4 text-gray-500">Belum ada link layanan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $links->links() }}</div>
        </div>
    </div>
</x-app-layout>
