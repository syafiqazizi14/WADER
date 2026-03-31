<?php

namespace Database\Seeders;

use App\Models\StatistikMojokertoItem;
use Illuminate\Database\Seeder;

class StatistikMojokertoItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'title' => 'Kemiskinan',
                'image_path' => 'asset/beranda.jpg',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Tingkat Partisipasi Angkatan Kerja (TPAK)',
                'image_path' => 'asset/beranda2.png',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Tingkat Pengangguran Terbuka (TPT)',
                'image_path' => 'asset/beranda2.png',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            $absolutePath = public_path($item['image_path']);
            $imageBase64 = null;
            $imageMimeType = null;

            if (is_file($absolutePath)) {
                $binary = file_get_contents($absolutePath);

                if ($binary !== false) {
                    $imageBase64 = base64_encode($binary);
                    $imageMimeType = mime_content_type($absolutePath) ?: 'image/jpeg';
                }
            }

            StatistikMojokertoItem::updateOrCreate(
                ['title' => $item['title']],
                [
                    'image_path' => $item['image_path'],
                    'image_base64' => $imageBase64,
                    'image_mime_type' => $imageMimeType,
                    'sort_order' => $item['sort_order'],
                    'is_active' => $item['is_active'],
                ]
            );
        }
    }
}
