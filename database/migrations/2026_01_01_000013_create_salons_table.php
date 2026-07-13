<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id');
            $table->string('name', 255);
            $table->string('address', 255);
            $table->string('phone', 255);
            $table->string('website', 255)->nullable();
            $table->longText('description')->nullable();
            $table->string('image', 255)->nullable();
            $table->integer('score')->default('0');
            $table->decimal('rating')->default('5.0');
            $table->integer('review_count')->default('0');
            $table->tinyInteger('is_featured')->default('0');
            $table->string('status', 255)->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salons');
    }
};
