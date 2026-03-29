@csrf
<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Halaman</label>
        <select name="page_id" class="mt-1 w-full border rounded p-2" required>
            <option value="">Pilih halaman</option>
            @foreach ($pages as $pageOption)
                <option value="{{ $pageOption->id }}" {{ (string) old('page_id', optional($section)->page_id) === (string) $pageOption->id ? 'selected' : '' }}>
                    {{ $pageOption->title }}
                </option>
            @endforeach
        </select>
        @error('page_id')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Tipe</label>
        <select name="type" class="mt-1 w-full border rounded p-2" required>
            @foreach ($types as $type)
                <option value="{{ $type }}" {{ old('type', optional($section)->type) === $type ? 'selected' : '' }}>{{ strtoupper($type) }}</option>
            @endforeach
        </select>
        @error('type')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Judul Section</label>
        <input type="text" name="title" value="{{ old('title', optional($section)->title) }}" class="mt-1 w-full border rounded p-2">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Konten</label>
        <textarea name="content" rows="5" class="mt-1 w-full border rounded p-2">{{ old('content', optional($section)->content) }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Media (opsional)</label>
        <select name="media_id" class="mt-1 w-full border rounded p-2">
            <option value="">Tanpa media</option>
            @foreach ($media as $item)
                <option value="{{ $item->id }}" {{ (string) old('media_id', optional($section)->media_id) === (string) $item->id ? 'selected' : '' }}>
                    #{{ $item->id }} - {{ $item->file_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Label Tombol</label>
            <input type="text" name="button_label" value="{{ old('button_label', optional($section)->button_label) }}" class="mt-1 w-full border rounded p-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">URL Tombol</label>
            <input type="url" name="button_url" value="{{ old('button_url', optional($section)->button_url) }}" class="mt-1 w-full border rounded p-2">
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Urutan</label>
        <input type="number" min="0" name="sort_order" value="{{ old('sort_order', optional($section)->sort_order ?? 0) }}" class="mt-1 w-full border rounded p-2">
    </div>

    <label class="inline-flex items-center gap-2">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', optional($section)->is_active ?? true) ? 'checked' : '' }}>
        <span>Aktif</span>
    </label>

    <div class="pt-2">
        <button class="bg-gray-900 text-white px-4 py-2 rounded">Simpan</button>
    </div>
</div>
