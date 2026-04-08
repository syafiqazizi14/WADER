@csrf
<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Halaman</label>
        <select id="sectionPageId" name="page_id" class="mt-1 w-full border rounded p-2" required>
            <option value="">Pilih halaman</option>
            @foreach ($pages as $pageOption)
                <option
                    value="{{ $pageOption->id }}"
                    data-page-slug="{{ $pageOption->slug }}"
                    {{ (string) old('page_id', optional($section)->page_id) === (string) $pageOption->id ? 'selected' : '' }}
                >
                    {{ $pageOption->title }}
                </option>
            @endforeach
        </select>
        @error('page_id')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div id="sectionGeneralTypeWrap">
        <label class="block text-sm font-medium text-gray-700">Tipe</label>
        <select id="sectionTypeSelect" name="type" class="mt-1 w-full border rounded p-2" required>
            @foreach ($types as $type)
                <option value="{{ $type }}" {{ old('type', optional($section)->type) === $type ? 'selected' : '' }}>{{ strtoupper($type) }}</option>
            @endforeach
        </select>
        @error('type')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <input type="hidden" id="sectionStatistikType" name="type" value="image" disabled>

    <div>
        <label class="block text-sm font-medium text-gray-700">Judul Section</label>
        <input type="text" name="title" value="{{ old('title', optional($section)->title) }}" class="mt-1 w-full border rounded p-2">
        @error('title')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div id="statistikOnlyFields" class="space-y-3" style="display: none;">
        <div>
            <label class="block text-sm font-medium text-gray-700">Teks Spotlight</label>
            <input type="text" name="spotlight_text" value="{{ old('spotlight_text', optional($section)->spotlight_text) }}" class="mt-1 w-full border rounded p-2" maxlength="255" placeholder="Contoh: Inflasi tahunan terkini Mojokerto">
            <p class="text-xs text-gray-500 mt-1">Teks ini akan tampil sebagai highlight/spotlight di kartu user.</p>
            @error('spotlight_text')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Thumbnail {{ isset($section) ? '(opsional untuk ganti)' : '' }}</label>
            <input type="file" name="thumbnail_image" accept="image/jpeg,image/png,image/webp" class="mt-1 w-full border rounded p-2">
            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WEBP. Maksimal 5MB.</p>
            @error('thumbnail_image')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        @if (isset($section) && $section->thumbnailMedia && str_starts_with((string) $section->thumbnailMedia->mime_type, 'image/'))
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Thumbnail Saat Ini</label>
                <img src="{{ asset('storage/'.$section->thumbnailMedia->file_path) }}" alt="Thumbnail {{ $section->title }}" class="h-28 w-auto rounded border border-gray-200">
            </div>
        @endif

        <div>
            <label class="block text-sm font-medium text-gray-700">Foto {{ isset($section) ? '(opsional untuk ganti)' : '' }}</label>
            <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="mt-1 w-full border rounded p-2">
            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WEBP. Maksimal 5MB.</p>
            @error('image')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        @if (isset($section) && $section->media && str_starts_with((string) $section->media->mime_type, 'image/'))
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Foto Saat Ini</label>
                <img src="{{ asset('storage/'.$section->media->file_path) }}" alt="{{ $section->title }}" class="h-28 w-auto rounded border border-gray-200">
            </div>
        @endif
    </div>

    <div id="sectionGeneralFields" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Konten</label>
            <textarea name="content" rows="5" class="mt-1 w-full border rounded p-2">{{ old('content', optional($section)->content) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Media (opsional)</label>
            <select id="sectionMediaId" name="media_id" class="mt-1 w-full border rounded p-2">
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

<script>
    (() => {
        const pageSelect = document.getElementById('sectionPageId');
        const typeSelect = document.getElementById('sectionTypeSelect');
        const statistikType = document.getElementById('sectionStatistikType');
        const statistikFields = document.getElementById('statistikOnlyFields');
        const generalFields = document.getElementById('sectionGeneralFields');
        const generalTypeWrap = document.getElementById('sectionGeneralTypeWrap');
        const mediaSelect = document.getElementById('sectionMediaId');

        if (!pageSelect || !typeSelect || !statistikType || !statistikFields || !generalFields || !generalTypeWrap || !mediaSelect) {
            return;
        }

        const syncMode = () => {
            const selected = pageSelect.options[pageSelect.selectedIndex];
            const isStatistik = (selected?.dataset?.pageSlug || '') === 'statistik-mojokerto';

            statistikFields.style.display = isStatistik ? '' : 'none';
            generalFields.style.display = isStatistik ? 'none' : '';
            generalTypeWrap.style.display = isStatistik ? 'none' : '';

            typeSelect.disabled = isStatistik;
            mediaSelect.disabled = isStatistik;
            statistikType.disabled = !isStatistik;
        };

        pageSelect.addEventListener('change', syncMode);
        syncMode();
    })();
</script>
