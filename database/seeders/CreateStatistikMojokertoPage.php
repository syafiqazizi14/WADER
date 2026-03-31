<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class CreateStatistikMojokertoPage extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::create([
            'title' => 'Statistik Mojokerto',
            'slug' => 'statistik-mojokerto',
            'meta_description' => 'Statistik Mojokerto',
            'is_published' => true,
        ]);
    }
}
