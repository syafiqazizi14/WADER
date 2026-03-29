<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Medium;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PageSectionController extends Controller
{
    public function index()
    {
        return view('admin.sections.index', [
            'sections' => PageSection::with('page')->orderBy('sort_order')->paginate(12),
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
        $section->update($this->validated($request));

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

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'page_id' => ['required', 'exists:pages,id'],
            'type' => ['required', Rule::in($this->types())],
            'title' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'media_id' => ['nullable', 'exists:media,id'],
            'button_label' => ['nullable', 'string', 'max:120'],
            'button_url' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }

    private function types(): array
    {
        return ['hero', 'text', 'image', 'cta', 'links', 'embed'];
    }
}
