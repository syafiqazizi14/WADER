<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $keys = [
            'contact_email',
            'contact_whatsapp',
            'contact_instagram',
            'contact_facebook',
            'instansi_link',
        ];

        return view('admin.settings.index', [
            'settings' => Setting::query()->whereIn('key', $keys)->pluck('value', 'key'),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'contact_email' => ['nullable', 'email'],
            'contact_whatsapp' => ['nullable', 'url'],
            'contact_instagram' => ['nullable', 'url'],
            'contact_facebook' => ['nullable', 'url'],
            'instansi_link' => ['nullable', 'url'],
        ]);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['group' => 'contact', 'value' => $value],
            );
        }

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'module' => 'settings',
            'action' => 'update',
            'payload' => ['keys' => array_keys($validated)],
        ]);

        return redirect()->route('admin.settings.index')->with('status', 'Pengaturan berhasil disimpan.');
    }
}
