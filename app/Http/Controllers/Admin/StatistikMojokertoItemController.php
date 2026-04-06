<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\StatistikMojokertoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StatistikMojokertoItemController extends Controller
{
    public function index()
    {
        return view('admin.statistik-mojokerto.index', [
            'items' => StatistikMojokertoItem::query()->latest()->paginate(12),
        ]);
    }

    public function create()
    {
        return view('admin.statistik-mojokerto.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request, true);
        $image = $request->file('image');
        $storedPath = $image->store('statistik-mojokerto', 'public');

        $item = StatistikMojokertoItem::create([
            'title' => $validated['title'],
            'image_path' => 'storage/'.$storedPath,
            'image_base64' => null,
            'image_mime_type' => null,
            'is_active' => $request->boolean('is_active', true),
        ]);

        $this->enforceMaxVisibleItems();

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'module' => 'statistik_mojokerto',
            'action' => 'create',
            'payload' => ['id' => $item->id, 'title' => $item->title],
        ]);

        return redirect()->route('admin.statistik-mojokerto.index')->with('status', 'Item statistik berhasil ditambahkan.');
    }

    public function edit(StatistikMojokertoItem $item)
    {
        return view('admin.statistik-mojokerto.edit', ['item' => $item]);
    }

    public function update(Request $request, StatistikMojokertoItem $item)
    {
        $validated = $this->validateData($request, false);
        $data = [
            'title' => $validated['title'],
            'is_active' => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('image')) {
            $newPath = $request->file('image')->store('statistik-mojokerto', 'public');

            if (str_starts_with($item->image_path, 'storage/')) {
                Storage::disk('public')->delete(substr($item->image_path, strlen('storage/')));
            }

            $data['image_path'] = 'storage/'.$newPath;
            $data['image_base64'] = null;
            $data['image_mime_type'] = null;
        }

        $item->update($data);
        $this->enforceMaxVisibleItems();

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'module' => 'statistik_mojokerto',
            'action' => 'update',
            'payload' => ['id' => $item->id, 'title' => $item->title],
        ]);

        return redirect()->route('admin.statistik-mojokerto.index')->with('status', 'Item statistik berhasil diperbarui.');
    }

    public function destroy(Request $request, StatistikMojokertoItem $item)
    {
        if (str_starts_with($item->image_path, 'storage/')) {
            Storage::disk('public')->delete(substr($item->image_path, strlen('storage/')));
        }

        $payload = ['id' => $item->id, 'title' => $item->title];
        $item->delete();

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'module' => 'statistik_mojokerto',
            'action' => 'delete',
            'payload' => $payload,
        ]);

        return redirect()->route('admin.statistik-mojokerto.index')->with('status', 'Item statistik berhasil dihapus.');
    }

    private function validateData(Request $request, bool $isCreate): array
    {
        $imageRules = ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'];

        if ($isCreate) {
            $imageRules[0] = 'required';
        }

        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => $imageRules,
            'is_active' => ['nullable', 'boolean'],
        ]);
    }

    private function enforceMaxVisibleItems(): void
    {
        $visibleIds = StatistikMojokertoItem::query()
            ->where('is_active', true)
            ->latest()
            ->limit(12)
            ->pluck('id');

        StatistikMojokertoItem::query()
            ->where('is_active', true)
            ->whereNotIn('id', $visibleIds)
            ->update(['is_active' => false]);
    }
}
