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
        Schema::create('social_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('platform', 100);        // e.g. Facebook, X, LinkedIn
            $table->string('url', 255);
            $table->timestamps();

            // กันซ้ำแพลตฟอร์มเดียวกันในผู้ใช้คนเดียว (ถ้าอยากอนุญาตซ้ำ ลบบรรทัดนี้ออก)
            $table->unique(['user_id', 'platform']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_links');
    }
};
