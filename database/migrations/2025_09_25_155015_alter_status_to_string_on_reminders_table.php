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
        // แปลงคอลัมน์ให้เป็น VARCHAR(20) และตั้ง default = "New"
        DB::statement('ALTER TABLE reminders MODIFY status VARCHAR(20) NOT NULL DEFAULT "New"');
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('string_on_reminders', function (Blueprint $table) {
            //
        });
    }
};
