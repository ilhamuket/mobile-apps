<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRoomStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_student', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignid('room_id')->nullable()->constrained();
            $table->unsignedBigInteger('sub_class_id');
            $table->foreign('sub_class_id')->references('id')->on('classes_schedule_studio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_student');
    }
}