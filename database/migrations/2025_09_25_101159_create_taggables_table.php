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
        Schema::create('taggables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->morphs('taggable'); // creates taggable_id (BIGINT) & taggable_type (string)
            $table->timestamps();

            // ป้องกันการเพิ่ม tag เดียวกันซ้ำบน model เดียวกัน
            $table->unique(['tag_id', 'taggable_type', 'taggable_id'], 'taggables_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taggables');
    }
};
