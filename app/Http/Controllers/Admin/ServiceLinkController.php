<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\ServiceLink;
use Illuminate\Http\Request;

class ServiceLinkController extends Controller
{
    public function index()
    {
        return view('admin.service-links.index', [
            'links' => ServiceLink::orderBy('sort_order')->paginate(12),
        ]);
    }

    public function create()
    {
        return view('admin.service-links.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $validated['is_active'] = $request->boolean('is_active');
        $link = ServiceLink::create($validated);

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'module' => 'service_links',
            'action' => 'create',
            'payload' => ['id' => $link->id, 'name' => $link->name],
        ]);

        return redirect()->route('admin.service-links.index')->with('status', 'Link layanan berhasil ditambahkan.');
    }

    public function edit(ServiceLink $service_link)
    {
        return view('admin.service-links.edit', ['link' => $service_link]);
    }

    public function update(Request $request, ServiceLink $service_link)
    {
        $validated = $this->validated($request);
        $validated['is_active'] = $request->boolean('is_active');
        $service_link->update($validated);

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'module' => 'service_links',
            'action' => 'update',
            'payload' => ['id' => $service_link->id, 'name' => $service_link->name],
        ]);

        return redirect()->route('admin.service-links.index')->with('status', 'Link layanan berhasil diperbarui.');
    }

    public function destroy(Request $request, ServiceLink $service_link)
    {
        $payload = ['id' => $service_link->id, 'name' => $service_link->name];
        $service_link->delete();

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'module' => 'service_links',
            'action' => 'delete',
            'payload' => $payload,
        ]);

        return redirect()->route('admin.service-links.index')->with('status', 'Link layanan berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'url' => ['required', 'url', 'max:255'],
            'category' => ['nullable', 'string', 'max:120'],
            'icon' => ['nullable', 'string', 'max:120'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
