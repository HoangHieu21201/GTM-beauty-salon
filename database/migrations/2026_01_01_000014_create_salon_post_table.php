<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salon_post', function (Blueprint $table) {
            $table->bigInteger('post_id');
            $table->bigInteger('salon_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salon_post');
    }
};
