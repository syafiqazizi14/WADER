@csrf
<div class="space-y-6">
    <div>
        <label for="title" class="form-label">Judul Halaman</label>
        <input type="text" id="title" name="title" value="{{ old('title', $page->title) }}" placeholder="Contoh: Tentang Kami" class="form-input" required>
        @error('title')
            <p class="form-error-message">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="slug" class="form-label">Slug (URL)</label>
        <div class="flex items-center">
            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">{{ url('/') }}/</span>
            <input type="text" id="slug" name="slug" value="{{ old('slug', $page->slug) }}" placeholder="contoh-halaman-baru" class="form-input rounded-l-none" required>
        </div>
        <p class="form-help-text">Gunakan huruf kecil, angka, dan tanda hubung (-). Ini akan menjadi bagian dari URL halaman Anda.</p>
        @error('slug')
            <p class="form-error-message">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="meta_description" class="form-label">Meta Description (SEO)</label>
        <textarea id="meta_description" name="meta_description" rows="3" placeholder="Deskripsi singkat halaman untuk mesin pencari seperti Google..." class="form-textarea">{{ old('meta_description', $page->meta_description) }}</textarea>
        <p class="form-help-text">Optimal: 70-160 karakter. Ini akan muncul di hasil pencarian.</p>
        @error('meta_description')
            <p class="form-error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
        <label class="flex items-center gap-3 cursor-pointer">
            <input type="hidden" name="is_published" value="0">
            <input type="checkbox" name="is_published" value="1" class="form-checkbox" @checked(old('is_published', $page->is_published))>
            <div>
                <span class="font-semibold text-gray-800">Publikasikan Halaman</span>
                <p class="text-xs text-gray-600">Jika dicentang, halaman ini akan dapat diakses oleh pengunjung website.</p>
            </div>
        </label>
    </div>

    <div class="flex items-center justify-end gap-4 pt-5 border-t">
        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">
            <span>Batal</span>
        </a>
        <button type="submit" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
            <span>{{ $page->exists ? 'Simpan Perubahan' : 'Buat Halaman' }}</span>
        </button>
    </div>
</div>
