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
            $table->uuid('visitor_id');
            $table->string('session_id')->nullable();
            $table->char('ip_hash', 64)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('method', 10)->default('GET');
            $table->string('path', 500);
            $table->text('full_url');
            $table->string('route_name')->nullable();
            $table->string('referrer', 1000)->nullable();
            $table->unsignedSmallInteger('status_code')->default(200);
            $table->timestamp('visited_at');
            $table->timestamps();

            $table->index(['visited_at', 'status_code', 'path']);
            $table->index(['visited_at', 'status_code', 'visitor_id']);
            $table->index(['visitor_id', 'path', 'visited_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_visits');
    }
};
