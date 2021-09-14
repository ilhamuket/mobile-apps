<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRoomsInModuleStudio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('links');
            $table->boolean('is_verified')->default(false);
            $table->string('status')->default('concept');
            $table->softDeletes();
            $table->unsignedBigInteger('sub_class_id');
            $table->foreign('sub_class_id')->references('id')->on('classes_schedule_studio');
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
        Schema::dropIfExists('rooms');
    }
}