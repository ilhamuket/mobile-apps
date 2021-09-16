<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImgStudioClassesListInModuleStudioowners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('img_list_classes', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('studioclasses');
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
        Schema::dropIfExists('img_list_classes');
    }
}