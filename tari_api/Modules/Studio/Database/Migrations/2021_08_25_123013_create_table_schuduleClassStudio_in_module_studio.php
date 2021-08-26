<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSchuduleClassStudioInModuleStudio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_schedule_studio', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('about');
            $table->date('start_at');
            $table->time('time_start');
            $table->date('end_at');
            $table->time('time_end');
            $table->string('status');
            $table->boolean('is_verified')->default(false);
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('studioClasses');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes_schedule_studio');
    }
}