@csrf
<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Judul</label>
        <input type="text" name="title" value="{{ old('title', $page->title ?? '') }}" class="mt-1 w-full border rounded p-2" required>
        @error('title')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Slug</label>
        <input type="text" name="slug" value="{{ old('slug', $page->slug ?? '') }}" class="mt-1 w-full border rounded p-2" required>
        @error('slug')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Meta Description</label>
        <textarea name="meta_description" class="mt-1 w-full border rounded p-2" rows="4">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
        @error('meta_description')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <label class="inline-flex items-center gap-2">
        <input type="hidden" name="is_published" value="0">
        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $page->is_published ?? true) ? 'checked' : '' }}>
        <span>Publish halaman</span>
    </label>

    <div class="pt-2">
        <button class="bg-gray-900 text-white px-4 py-2 rounded">Simpan</button>
    </div>
</div>
