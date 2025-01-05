<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('password', 255)->after('weekly_hours');
        });
    }

    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            //
        });
    }
};