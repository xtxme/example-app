<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('user_bios', function (Blueprint $table) {
            if (!Schema::hasColumn('user_bios', 'user_id')) {
                $table->unsignedBigInteger('user_id')->unique()->after('id');
                $table->foreign('user_id')
                      ->references('id')->on('users')
                      ->onDelete('cascade');
            }

            if (!Schema::hasColumn('user_bios', 'bio')) {
                $table->text('bio')->nullable()->after('user_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('user_bios', function (Blueprint $table) {
            if (Schema::hasColumn('user_bios', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropUnique(['user_id']);
                $table->dropColumn('user_id');
            }
            if (Schema::hasColumn('user_bios', 'bio')) {
                $table->dropColumn('bio');
            }
        });
    }
};
