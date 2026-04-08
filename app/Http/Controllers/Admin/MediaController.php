<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Medium;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MediaController extends Controller
{
    public function index()
    {
        return view('admin.media.index', [
            'mediaItems' => Medium::latest()->paginate(16),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'file' => ['required', 'file', 'mimes:jpg,jpeg,png,webp,gif,pdf', 'max:5120'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'content_target' => ['nullable', Rule::in(['general', 'statistik_mojokerto'])],
            'section_title' => ['nullable', 'string', 'max:255'],
            'section_is_active' => ['nullable', 'boolean'],
        ]);

        $contentTarget = $validated['content_target'] ?? 'general';

        if ($contentTarget === 'statistik_mojokerto' && trim((string) ($validated['section_title'] ?? '')) === '') {
            return back()->withErrors([
                'section_title' => 'Judul statistik wajib diisi untuk target Statistik Mojokerto.',
            ])->withInput();
        }

        $path = $request->file('file')->store('media', 'public');
        $media = Medium::create([
            'file_name' => $request->file('file')->getClientOriginalName(),
            'file_path' => $path,
            'mime_type' => $request->file('file')->getClientMimeType(),
            'alt_text' => $validated['alt_text'] ?? null,
            'uploaded_by' => $request->user()->id,
        ]);

        if ($contentTarget === 'statistik_mojokerto') {
            $statistikPage = Page::query()->where('slug', 'statistik-mojokerto')->first();

            if (! $statistikPage) {
                Storage::disk('public')->delete($media->file_path);
                $media->delete();

                return back()->withErrors([
                    'content_target' => 'Halaman Statistik Mojokerto belum tersedia.',
                ])->withInput();
            }

            $title = trim((string) ($validated['section_title'] ?? ''));

            PageSection::create([
                'page_id' => $statistikPage->id,
                'type' => 'image',
                'title' => $title,
                'content' => null,
                'media_id' => $media->id,
                'button_label' => null,
                'button_url' => null,
                'sort_order' => (int) PageSection::query()
                    ->where('page_id', $statistikPage->id)
                    ->max('sort_order') + 1,
                'is_active' => $request->boolean('section_is_active', true),
            ]);
        }

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'module' => 'media',
            'action' => 'upload',
            'payload' => ['id' => $media->id, 'file_name' => $media->file_name],
        ]);

        $statusMessage = $contentTarget === 'statistik_mojokerto'
            ? 'Media berhasil diunggah dan item Statistik Mojokerto berhasil dibuat.'
            : 'Media berhasil diunggah.';

        return redirect()->route('admin.media.index')->with('status', $statusMessage);
    }

    public function destroy(Request $request, Medium $medium)
    {
        Storage::disk('public')->delete($medium->file_path);
        $payload = ['id' => $medium->id, 'file_name' => $medium->file_name];
        $medium->delete();

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'module' => 'media',
            'action' => 'delete',
            'payload' => $payload,
        ]);

        return redirect()->route('admin.media.index')->with('status', 'Media berhasil dihapus.');
    }
}
