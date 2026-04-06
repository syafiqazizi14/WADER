<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('statistik_mojokerto_items')) {
            return;
        }

        if (Schema::hasColumn('statistik_mojokerto_items', 'sort_order')) {
            Schema::table('statistik_mojokerto_items', function (Blueprint $table) {
                $table->dropColumn('sort_order');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('statistik_mojokerto_items')) {
            return;
        }

        if (! Schema::hasColumn('statistik_mojokerto_items', 'sort_order')) {
            Schema::table('statistik_mojokerto_items', function (Blueprint $table) {
                $table->unsignedInteger('sort_order')->default(0)->after('image_mime_type');
            });
        }
    }
};
