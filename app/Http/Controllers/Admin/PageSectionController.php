<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Medium;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PageSectionController extends Controller
{
    public function index(Request $request)
    {
        $pageFilters = Page::query()
            ->select(['id', 'title', 'slug'])
            ->orderBy('title')
            ->get();

        $activePageSlug = trim((string) $request->query('page', ''));
        if ($activePageSlug === '' || ! $pageFilters->contains('slug', $activePageSlug)) {
            $activePageSlug = null;
        }

        $sectionsQuery = PageSection::query()
            ->with('page')
            ->orderBy('sort_order')
            ->orderByDesc('id');

        if ($activePageSlug) {
            $sectionsQuery->whereHas('page', function ($query) use ($activePageSlug) {
                $query->where('slug', $activePageSlug);
            });
        }

        return view('admin.sections.index', [
            'sections' => $sectionsQuery->paginate(12)->withQueryString(),
            'pageFilters' => $pageFilters,
            'activePageSlug' => $activePageSlug,
        ]);
    }

    public function create()
    {
        return view('admin.sections.create', [
            'pages' => Page::orderBy('title')->get(),
            'media' => Medium::latest()->limit(50)->get(),
            'types' => $this->types(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $section = PageSection::create($validated);

        $this->enforceMaxActiveStatistikItems($section->page_id);

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'module' => 'page_sections',
            'action' => 'create',
            'payload' => ['id' => $section->id, 'title' => $section->title],
        ]);

        return redirect()->route('admin.sections.index')->with('status', 'Section berhasil ditambahkan.');
    }

    public function edit(PageSection $section)
    {
        return view('admin.sections.edit', [
            'section' => $section,
            'pages' => Page::orderBy('title')->get(),
            'media' => Medium::latest()->limit(50)->get(),
            'types' => $this->types(),
        ]);
    }

    public function update(Request $request, PageSection $section)
    {
        $section->update($this->validated($request, $section));

        $this->enforceMaxActiveStatistikItems($section->page_id);

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'module' => 'page_sections',
            'action' => 'update',
            'payload' => ['id' => $section->id, 'title' => $section->title],
        ]);

        return redirect()->route('admin.sections.index')->with('status', 'Section berhasil diperbarui.');
    }

    public function destroy(Request $request, PageSection $section)
    {
        $payload = ['id' => $section->id, 'title' => $section->title];
        $section->delete();

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'module' => 'page_sections',
            'action' => 'delete',
            'payload' => $payload,
        ]);

        return redirect()->route('admin.sections.index')->with('status', 'Section berhasil dihapus.');
    }

    private function validated(Request $request, ?PageSection $section = null): array
    {
        $pageId = (int) $request->input('page_id');
        $page = Page::query()->find($pageId);
        $isStatistikPage = $page && $page->slug === 'statistik-mojokerto';

        $validated = $request->validate([
            'page_id' => ['required', 'exists:pages,id'],
            'type' => [$isStatistikPage ? 'nullable' : 'required', Rule::in($this->types())],
            'title' => [$isStatistikPage ? 'required' : 'nullable', 'string', 'max:255'],
            'spotlight_text' => [$isStatistikPage ? 'required' : 'nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'media_id' => ['nullable', 'exists:media,id'],
            'thumbnail_media_id' => ['nullable', 'exists:media,id'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'thumbnail_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'button_label' => ['nullable', 'string', 'max:120'],
            'button_url' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($isStatistikPage) {
            $validated['type'] = 'image';
            $validated['content'] = null;
            $validated['button_label'] = null;
            $validated['button_url'] = null;

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('media', 'public');
                $media = Medium::create([
                    'file_name' => $request->file('image')->getClientOriginalName(),
                    'file_path' => $path,
                    'mime_type' => $request->file('image')->getClientMimeType(),
                    'alt_text' => $validated['title'] ?? null,
                    'uploaded_by' => $request->user()->id,
                ]);

                $validated['media_id'] = $media->id;
            }

            if ($request->hasFile('thumbnail_image')) {
                $path = $request->file('thumbnail_image')->store('media', 'public');
                $thumbnailMedia = Medium::create([
                    'file_name' => $request->file('thumbnail_image')->getClientOriginalName(),
                    'file_path' => $path,
                    'mime_type' => $request->file('thumbnail_image')->getClientMimeType(),
                    'alt_text' => ($validated['title'] ?? null) ? 'Thumbnail '.$validated['title'] : null,
                    'uploaded_by' => $request->user()->id,
                ]);

                $validated['thumbnail_media_id'] = $thumbnailMedia->id;
            }

            $effectiveMediaId = $validated['media_id'] ?? $section?->media_id;
            if (! $effectiveMediaId) {
                throw ValidationException::withMessages([
                    'image' => 'Foto wajib diunggah untuk Section Statistik Mojokerto.',
                ]);
            }

            $effectiveThumbnailMediaId = $validated['thumbnail_media_id'] ?? $section?->thumbnail_media_id;
            if (! $effectiveThumbnailMediaId) {
                throw ValidationException::withMessages([
                    'thumbnail_image' => 'Thumbnail wajib diunggah untuk Section Statistik Mojokerto.',
                ]);
            }
        } else {
            $validated['spotlight_text'] = null;
            $validated['thumbnail_media_id'] = null;
        }

        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }

    private function types(): array
    {
        return ['hero', 'text', 'image', 'cta', 'links', 'embed'];
    }

    private function enforceMaxActiveStatistikItems(int $pageId): void
    {
        $page = Page::query()->find($pageId);
        if (! $page || $page->slug !== 'statistik-mojokerto') {
            return;
        }

        $visibleIds = PageSection::query()
            ->where('page_id', $pageId)
            ->where('type', 'image')
            ->where('is_active', true)
            ->whereNotNull('media_id')
            ->latest('id')
            ->limit(12)
            ->pluck('id');

        PageSection::query()
            ->where('page_id', $pageId)
            ->where('type', 'image')
            ->where('is_active', true)
            ->whereNotNull('media_id')
            ->whereNotIn('id', $visibleIds)
            ->update(['is_active' => false]);
    }
}
