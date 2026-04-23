<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div class="flex items-start gap-3">
                <div class="rounded-xl section-icon-wrap" style="padding: 0.7rem; background-color: #dbeafe; margin-top: -55px;">
                    <img src="{{ asset('asset/media.png') }}" alt="Media" class="object-contain section-header-icon" style="width: 29px; height: 29px; max-width: 29px; max-height: 29px;">
                    <span class="section-icon-underline" aria-hidden="true"></span>
                </div>
                <div>
                    <h2 class="font-bold text-3xl text-gray-800">Media Library</h2>
                    <p class="mt-1 text-sm text-gray-500">Kelola dan unggah aset gambar atau file lainnya.</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @if (session('status'))
                <div class="alert alert-success mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <!-- Upload Form -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload-cloud"><path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"/><path d="M12 12v9"/><path d="m16 16-4-4-4 4"/></svg>
                    Upload Media Baru
                </h3>
                <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" id="mediaUploadForm">
                    @csrf
                    <div class="grid md:grid-cols-3 gap-6 items-end">
                        <div>
                            <label class="form-label">Target Konten</label>
                            <select name="content_target" id="contentTarget" class="form-input">
                                <option value="general" {{ old('content_target', 'general') === 'general' ? 'selected' : '' }}>Umum (Media Library)</option>
                                <option value="statistik_mojokerto" {{ old('content_target') === 'statistik_mojokerto' ? 'selected' : '' }}>Statistik Mojokerto</option>
                            </select>
                            @error('content_target')
                                <p class="form-error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label">Pilih File</label>
                            <input type="file" name="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-md" required>
                            @error('file')
                                <p class="form-error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label">Alt Text (Opsional)</label>
                            <input type="text" name="alt_text" placeholder="Deskripsi gambar..." value="{{ old('alt_text') }}" class="form-input">
                            @error('alt_text')
                                <p class="form-error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div id="statistikFields" class="mt-6 md:grid md:grid-cols-3 gap-6 items-end" style="display: none;">
                        <div>
                            <label class="form-label">Judul Statistik</label>
                            <input type="text" name="section_title" value="{{ old('section_title') }}" class="form-input" placeholder="Contoh: Inflasi Kabupaten Mojokerto">
                            @error('section_title')
                                <p class="form-error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label">Status Tampil</label>
                            <label class="inline-flex items-center gap-2 mt-2">
                                <input type="hidden" name="section_is_active" value="0">
                                <input type="checkbox" name="section_is_active" value="1" {{ old('section_is_active', '1') ? 'checked' : '' }}>
                                <span>Aktif</span>
                            </label>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Saat target ini dipilih, upload media otomatis membuat item section untuk halaman Statistik Mojokerto.</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="btn btn-primary w-full md:w-auto flex justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                            <span>Upload File</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Media List -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-library"><path d="m16 6 4 14"/><path d="M12 6v14"/><path d="M8 8v12"/><path d="M4 4v16"/></svg>
                        Daftar Koleksi Media
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preview</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama & Tipe</th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($mediaItems as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if (str_starts_with((string) $item->mime_type, 'image/'))
                                            <div class="h-16 w-16 rounded-lg overflow-hidden border border-gray-200 bg-gray-50">
                                                <img src="{{ asset('storage/'.$item->file_path) }}" alt="{{ $item->alt_text }}" class="h-full w-full object-cover">
                                            </div>
                                        @else
                                            <div class="h-16 w-16 rounded-lg border border-gray-200 bg-gray-50 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file text-gray-400"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/></svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 border-b border-transparent hover:border-gray-300 inline-block overflow-hidden text-ellipsis max-w-xs" title="{{ $item->file_name }}">
                                            {{ $item->file_name }}
                                        </div>
                                        <div class="mt-1">
                                            <span class="badge badge-secondary text-xs">{{ $item->mime_type }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end gap-2">
                                            @if(!str_starts_with((string) $item->mime_type, 'image/'))
                                                <a href="{{ asset('storage/'.$item->file_path) }}" target="_blank" class="btn btn-sm btn-secondary">
                                                    Lihat
                                                </a>
                                            @endif
                                            <form action="{{ route('admin.media.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin hapus media ini? Tindakan ini tidak dapat diurungkan.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                                    <span>Hapus</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <div class="text-center py-12 px-6">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-300" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image-off"><line x1="2" x2="22" y1="2" y2="22"/><path d="M10.41 10.41a2 2 0 1 1-2.83-2.83"/><line x1="13.5" x2="6" y1="13.5" y2="21"/><line x1="18" x2="21" y1="12" y2="15"/><path d="M3.59 3.59A1.99 1.99 0 0 0 3 5v14a2 2 0 0 0 2 2h14c.55 0 1.05-.22 1.41-.59"/><path d="M21 15V5a2 2 0 0 0-2-2H9"/></svg>
                                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada file media</h3>
                                            <p class="mt-1 text-sm text-gray-500">Unggah file pertama Anda menggunakan formulir di atas.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($mediaItems->hasPages())
                <div class="mt-6">
                    {{ $mediaItems->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        (() => {
            const targetSelect = document.getElementById('contentTarget');
            const statistikFields = document.getElementById('statistikFields');

            if (!targetSelect || !statistikFields) {
                return;
            }

            const syncFields = () => {
                const isStatistik = targetSelect.value === 'statistik_mojokerto';
                statistikFields.style.display = isStatistik ? '' : 'none';
            };

            targetSelect.addEventListener('change', syncFields);
            syncFields();
        })();
    </script>
</x-app-layout>
