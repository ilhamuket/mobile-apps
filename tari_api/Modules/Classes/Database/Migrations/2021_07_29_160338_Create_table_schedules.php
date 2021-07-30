<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('start_at')->nullable();
            $table->time('time_start')->nullable();
            $table->date('end_at')->nullable();
            $table->time('time_end')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('users');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('class_schedules', function (Blueprint $table) {
            $table->foreignId('schedule_id')->constrained();
            $table->foreignId('class_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_schedules');
        Schema::dropIfExists('schedules');
    }
}