<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifySubjectAndCourseNameInCoursesTable extends Migration
{
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('subject')->nullable(false)->change(); // Remove nullable
            $table->string('course_name')->nullable(false)->change(); // Remove nullable
        });
    }
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('subject')->nullable()->change(); // Revert to nullable
            $table->string('course_name')->nullable()->change(); // Revert to nullable
        });
    }
}
