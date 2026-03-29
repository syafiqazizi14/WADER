<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Media Library</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('status'))
                <div class="bg-green-100 text-green-800 p-3 rounded">{{ session('status') }}</div>
            @endif

            <div class="bg-white p-5 rounded shadow-sm border">
                <h3 class="font-semibold mb-3">Upload Media</h3>
                <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="grid md:grid-cols-3 gap-3 items-end">
                    @csrf
                    <div class="md:col-span-1">
                        <label class="block text-sm text-gray-700">File</label>
                        <input type="file" name="file" class="mt-1 w-full border rounded p-2" required>
                    </div>
                    <div class="md:col-span-1">
                        <label class="block text-sm text-gray-700">Alt Text</label>
                        <input type="text" name="alt_text" class="mt-1 w-full border rounded p-2">
                    </div>
                    <div class="md:col-span-1">
                        <button class="bg-gray-900 text-white px-4 py-2 rounded">Upload</button>
                    </div>
                </form>
                @error('file')<p class="text-sm text-red-600 mt-2">{{ $message }}</p>@enderror
            </div>

            <div class="bg-white p-5 rounded shadow-sm border overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left border-b">
                            <th class="py-2">Nama File</th>
                            <th class="py-2">MIME</th>
                            <th class="py-2">Preview</th>
                            <th class="py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mediaItems as $item)
                            <tr class="border-b">
                                <td class="py-2">{{ $item->file_name }}</td>
                                <td class="py-2">{{ $item->mime_type }}</td>
                                <td class="py-2">
                                    @if (str_starts_with((string) $item->mime_type, 'image/'))
                                        <img src="{{ asset('storage/'.$item->file_path) }}" alt="{{ $item->alt_text }}" class="h-12 w-16 object-cover rounded border">
                                    @else
                                        <a href="{{ asset('storage/'.$item->file_path) }}" target="_blank" class="text-blue-600">Lihat</a>
                                    @endif
                                </td>
                                <td class="py-2">
                                    <form action="{{ route('admin.media.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus file ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="py-4 text-gray-500">Belum ada media.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div>{{ $mediaItems->links() }}</div>
        </div>
    </div>
</x-app-layout>
