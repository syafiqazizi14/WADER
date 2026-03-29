<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Medium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        ]);

        $path = $request->file('file')->store('media', 'public');
        $media = Medium::create([
            'file_name' => $request->file('file')->getClientOriginalName(),
            'file_path' => $path,
            'mime_type' => $request->file('file')->getClientMimeType(),
            'alt_text' => $validated['alt_text'] ?? null,
            'uploaded_by' => $request->user()->id,
        ]);

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'module' => 'media',
            'action' => 'upload',
            'payload' => ['id' => $media->id, 'file_name' => $media->file_name],
        ]);

        return redirect()->route('admin.media.index')->with('status', 'Media berhasil diunggah.');
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
