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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('groups');
            $table->date('date');
            $table->enum('type', ['lesson', 'practice']);
            $table->text('description');
            $table->foreignId('teacher_id')->constrained('teachers');
            $table->string('signature', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        //
    }
};
