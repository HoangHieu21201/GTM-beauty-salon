<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });

        // Populate slug for existing categories
        $categories = DB::table('categories')->get();
        $usedSlugs = [];
        
        foreach ($categories as $category) {
            $baseSlug = Str::slug($category->name);
            $slug = $baseSlug;
            $counter = 1;
            
            while (isset($usedSlugs[$slug])) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            $usedSlugs[$slug] = true;

            DB::table('categories')
                ->where('id', $category->id)
                ->update(['slug' => $slug]);
        }

        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
            // MySQL unique index workaround for SoftDeletes
            $table->string('active_deleted_at')->virtualAs('IFNULL(deleted_at, "0")');
            $table->unique(['slug', 'active_deleted_at'], 'categories_slug_active_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique('categories_slug_active_unique');
            $table->dropColumn('active_deleted_at');
            $table->dropColumn('slug');
        });
    }
};
