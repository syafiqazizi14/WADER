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
            Schema::create('statistik_mojokerto_items', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('image_path');
                $table->longText('image_base64')->nullable();
                $table->string('image_mime_type', 100)->nullable();
                $table->unsignedInteger('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });

            return;
        }

        Schema::table('statistik_mojokerto_items', function (Blueprint $table) {
            if (! Schema::hasColumn('statistik_mojokerto_items', 'image_base64')) {
                $table->longText('image_base64')->nullable()->after('image_path');
            }

            if (! Schema::hasColumn('statistik_mojokerto_items', 'image_mime_type')) {
                $table->string('image_mime_type', 100)->nullable()->after('image_base64');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('statistik_mojokerto_items')) {
            return;
        }

        Schema::table('statistik_mojokerto_items', function (Blueprint $table) {
            if (Schema::hasColumn('statistik_mojokerto_items', 'image_base64')) {
                $table->dropColumn('image_base64');
            }

            if (Schema::hasColumn('statistik_mojokerto_items', 'image_mime_type')) {
                $table->dropColumn('image_mime_type');
            }
        });
    }
};
