<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableClassInstructorTeacherV2ModuleStudioowners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_instructor_v2', function (Blueprint $table) {
            $table->unsignedBigInteger('instructor_id');
            $table->foreign('instructor_id')->references('id')->on('studios_teachers');
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('studioclasses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_instructor_v2');
    }
}