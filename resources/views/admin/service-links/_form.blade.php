@csrf
<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Nama</label>
        <input type="text" name="name" value="{{ old('name', optional($link)->name) }}" class="mt-1 w-full border rounded p-2" required>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">URL</label>
        <input type="url" name="url" value="{{ old('url', optional($link)->url) }}" class="mt-1 w-full border rounded p-2" required>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Kategori</label>
            <input type="text" name="category" value="{{ old('category', optional($link)->category) }}" class="mt-1 w-full border rounded p-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Icon (opsional)</label>
            <input type="text" name="icon" value="{{ old('icon', optional($link)->icon) }}" class="mt-1 w-full border rounded p-2">
        </div>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Urutan</label>
        <input type="number" min="0" name="sort_order" value="{{ old('sort_order', optional($link)->sort_order ?? 0) }}" class="mt-1 w-full border rounded p-2">
    </div>
    <label class="inline-flex items-center gap-2">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', optional($link)->is_active ?? true) ? 'checked' : '' }}>
        <span>Aktif</span>
    </label>
    <div>
        <button class="bg-gray-900 text-white px-4 py-2 rounded">Simpan</button>
    </div>
</div>
