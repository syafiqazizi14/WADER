<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Section Halaman</h2>
            <a href="{{ route('admin.sections.create') }}" class="bg-gray-900 text-white px-3 py-2 rounded text-sm">Tambah Section</a>
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
                            <th class="py-2">Halaman</th>
                            <th class="py-2">Tipe</th>
                            <th class="py-2">Judul</th>
                            <th class="py-2">Urutan</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sections as $section)
                            <tr class="border-b">
                                <td class="py-2">{{ $section->page?->title ?? '-' }}</td>
                                <td class="py-2">{{ strtoupper($section->type) }}</td>
                                <td class="py-2">{{ $section->title ?? '-' }}</td>
                                <td class="py-2">{{ $section->sort_order }}</td>
                                <td class="py-2">{{ $section->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                                <td class="py-2 space-x-2">
                                    <a href="{{ route('admin.sections.edit', $section) }}" class="text-blue-600">Edit</a>
                                    <form action="{{ route('admin.sections.destroy', $section) }}" method="POST" class="inline" onsubmit="return confirm('Hapus section ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="py-4 text-gray-500">Belum ada section.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $sections->links() }}</div>
        </div>
    </div>
</x-app-layout>
