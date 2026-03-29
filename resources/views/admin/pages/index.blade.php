<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Halaman</h2>
            <a href="{{ route('admin.pages.create') }}" class="bg-gray-900 text-white px-3 py-2 rounded text-sm">Tambah Halaman</a>
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
                            <th class="py-2">Judul</th>
                            <th class="py-2">Slug</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pages as $page)
                            <tr class="border-b">
                                <td class="py-2">{{ $page->title }}</td>
                                <td class="py-2">{{ $page->slug }}</td>
                                <td class="py-2">{{ $page->is_published ? 'Publish' : 'Draft' }}</td>
                                <td class="py-2 space-x-2">
                                    <a href="{{ route('admin.pages.edit', $page) }}" class="text-blue-600">Edit</a>
                                    <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="inline" onsubmit="return confirm('Hapus halaman ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4 text-gray-500">Belum ada data halaman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $pages->links() }}</div>
        </div>
    </div>
</x-app-layout>
