<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_visits', function (Blueprint $table) {
            $table->id();
            $table->char('visitor_id');
            $table->string('session_id', 255)->nullable();
            $table->char('ip_hash')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('method', 10)->default('GET');
            $table->string('path', 500);
            $table->text('full_url');
            $table->string('route_name', 255)->nullable();
            $table->string('referrer', 1000)->nullable();
            $table->smallInteger('status_code')->default('200');
            $table->timestamp('visited_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_visits');
    }
};
