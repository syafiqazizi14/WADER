<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $superadminRole = Role::firstOrCreate(
            ['name' => 'superadmin'],
            ['label' => 'Super Admin'],
        );

        $editorRole = Role::firstOrCreate(
            ['name' => 'editor'],
            ['label' => 'Editor'],
        );

        $admin = User::firstOrCreate(
            ['email' => 'admin@wader.local'],
            [
                'name' => 'Admin WADER',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
        );

        $admin->roles()->syncWithoutDetaching([$superadminRole->id, $editorRole->id]);

        Page::firstOrCreate(
            ['slug' => 'beranda'],
            [
                'title' => 'Beranda',
                'meta_description' => 'Portal layanan data WADER',
                'is_published' => true,
                'published_at' => now(),
            ],
        );

        Page::firstOrCreate(
            ['slug' => 'pst-center'],
            ['title' => 'PST Center', 'is_published' => true, 'published_at' => now()],
        );

        Page::firstOrCreate(
            ['slug' => 'stimo-2-0'],
            ['title' => 'STIMO 2.0', 'is_published' => true, 'published_at' => now()],
        );

        Page::firstOrCreate(
            ['slug' => 'backend'],
            ['title' => 'Backend', 'is_published' => true, 'published_at' => now()],
        );

        Setting::updateOrCreate(['key' => 'contact_email'], ['group' => 'contact', 'value' => 'bps3516@bps.go.id']);
        Setting::updateOrCreate(['key' => 'contact_whatsapp'], ['group' => 'contact', 'value' => 'https://wa.me/628113693516']);
        Setting::updateOrCreate(['key' => 'contact_instagram'], ['group' => 'contact', 'value' => 'https://www.instagram.com/bpsmojokertokab']);
        Setting::updateOrCreate(['key' => 'contact_facebook'], ['group' => 'contact', 'value' => 'https://www.facebook.com/BPSMojokertoKab']);
        Setting::updateOrCreate(['key' => 'instansi_link'], ['group' => 'contact', 'value' => 'https://mojokertokab.bps.go.id']);

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
        );
    }
}
