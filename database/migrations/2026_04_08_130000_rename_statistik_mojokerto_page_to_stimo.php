<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('pages')->where('slug', 'statistik-mojokerto')->update([
            'title' => 'STIMO',
            'meta_description' => 'STIMO - Statistik Mojokerto',
        ]);

        DB::table('pages')->where('slug', 'stimo-2-0')->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('pages')->where('slug', 'statistik-mojokerto')->update([
            'title' => 'Statistik Mojokerto',
            'meta_description' => 'Statistik Mojokerto',
        ]);
    }
};
