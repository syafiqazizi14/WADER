<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    public function index()
    {
        return view('admin.pages.index', [
            'pages' => Page::query()->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('pages', 'slug')],
            'meta_description' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $page = Page::create([
            ...$validated,
            'is_published' => (bool) ($validated['is_published'] ?? false),
            'published_at' => ($validated['is_published'] ?? false) ? now() : null,
        ]);

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'module' => 'pages',
            'action' => 'create',
            'payload' => ['id' => $page->id, 'title' => $page->title],
        ]);

        return redirect()->route('admin.pages.index')->with('status', 'Halaman berhasil ditambahkan.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', ['page' => $page]);
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('pages', 'slug')->ignore($page->id)],
            'meta_description' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $wasPublished = $page->is_published;
        $isPublished = (bool) ($validated['is_published'] ?? false);

        $page->update([
            ...$validated,
            'is_published' => $isPublished,
            'published_at' => $isPublished && ! $wasPublished ? now() : $page->published_at,
        ]);

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'module' => 'pages',
            'action' => 'update',
            'payload' => ['id' => $page->id, 'title' => $page->title],
        ]);

        return redirect()->route('admin.pages.index')->with('status', 'Halaman berhasil diperbarui.');
    }

    public function destroy(Request $request, Page $page)
    {
        $payload = ['id' => $page->id, 'title' => $page->title];
        $page->delete();

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'module' => 'pages',
            'action' => 'delete',
            'payload' => $payload,
        ]);

        return redirect()->route('admin.pages.index')->with('status', 'Halaman berhasil dihapus.');
    }
}
