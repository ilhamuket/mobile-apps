<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableStudioClassesAddUserActivityIdInModuleStudio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_user_activity', function (Blueprint $table) {
            $table->unsignedBigInteger('user_activity_id');
            $table->foreign('user_activity_id')->references('id')->on('users');
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('studioClasses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes_user_activity');
    }
}