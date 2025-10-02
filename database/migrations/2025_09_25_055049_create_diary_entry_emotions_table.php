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
        Schema::create('diary_entry_emotion', function (Blueprint $table) {
            $table->foreignId('diary_entries_id')->constrained('diary_entries')->onDelete('cascade');
            $table->foreignId('emotion_id')->constrained('emotions')->onDelete('cascade');
            $table->integer('intensity');
            $table->timestamps();
            $table->primary(['diary_entries_id','emotion_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diary_entry_emotions');
    }
};
