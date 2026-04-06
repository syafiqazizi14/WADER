@php
    $item = $item ?? null;
@endphp
@csrf
<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Judul</label>
        <input type="text" name="title" value="{{ old('title', optional($item)->title) }}" class="mt-1 w-full border rounded p-2" required>
        @error('title')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Foto {{ isset($item) ? '(opsional untuk ganti)' : '' }}</label>
        <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="mt-1 w-full border rounded p-2" {{ isset($item) ? '' : 'required' }}>
        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WEBP. Maksimal 5MB.</p>
        @error('image')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    @if (isset($item))
        @php
            $previewSrc = $item->image_base64 && $item->image_mime_type
                ? 'data:'.$item->image_mime_type.';base64,'.$item->image_base64
                : asset($item->image_path);
        @endphp
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Foto Saat Ini</label>
            <img src="{{ $previewSrc }}" alt="{{ $item->title }}" class="h-28 w-auto rounded border border-gray-200">
        </div>
    @endif

    <label class="inline-flex items-center gap-2">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', optional($item)->is_active ?? true) ? 'checked' : '' }}>
        <span>Aktif</span>
    </label>

    <div class="pt-2">
        <button class="bg-gray-900 text-white px-4 py-2 rounded">Simpan</button>
    </div>
</div>
