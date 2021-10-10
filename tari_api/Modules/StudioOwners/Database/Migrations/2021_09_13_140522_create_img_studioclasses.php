<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImgStudioclasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('img_studio_classes', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('studioClasses');
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
        Schema::dropIfExists('img_studio_classes');
    }
}