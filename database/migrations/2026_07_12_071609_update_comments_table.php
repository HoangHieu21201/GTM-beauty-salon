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
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comments_ibfk_3');
            $table->bigInteger('salon_id')->nullable()->change();
            $table->foreign('salon_id', 'comments_ibfk_3')->references('id')->on('salons')->onDelete('cascade');
            
            $table->bigInteger('post_id')->nullable()->after('salon_id');

            // Add foreign key constraint for post_id
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->dropColumn('post_id');
            $table->dropForeign('comments_ibfk_3');
            $table->bigInteger('salon_id')->nullable(false)->change();
            $table->foreign('salon_id', 'comments_ibfk_3')->references('id')->on('salons')->onDelete('cascade');
        });
    }
};
