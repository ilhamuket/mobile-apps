<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableImgForTwoTableInModuleStudioowners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('img_list_reviews', function (Blueprint $table) {
            $table->id();
            $table->string("url");
            $table->foreignId("review_id")->constrained();
            $table->timestamps();
        });
        Schema::create('img_class_vidios', function (Blueprint $table) {
            $table->id();
            $table->string("url");
            $table->foreignId("studio_class_vidio_id")->constrained();
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
        Schema::dropIfExists('img_list_reviews');
        Schema::dropIfExists('img_class_vidios');
    }
}