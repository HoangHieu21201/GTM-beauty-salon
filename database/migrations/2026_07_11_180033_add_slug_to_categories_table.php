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
        foreach ($categories as $category) {
            DB::table('categories')
                ->where('id', $category->id)
                ->update(['slug' => Str::slug($category->name)]);
        }

        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
            // SoftDeletes-compatible unique index
            $table->unique(['slug', 'deleted_at'], 'categories_slug_deleted_at_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique('categories_slug_deleted_at_unique');
            $table->dropColumn('slug');
        });
    }
};
