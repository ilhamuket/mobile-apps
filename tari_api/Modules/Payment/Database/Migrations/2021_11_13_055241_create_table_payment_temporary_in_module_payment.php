<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePaymentTemporaryInModulePayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string("status")->nullable();
            $table->string("type")->nullable();
            $table->string("methods");
            $table->foreignId("user_id")->constrained();
            $table->unsignedBigInteger("class_id")->nullable();
            $table->foreign("class_id")->references("id")->on("studioClasses");
            $table->unsignedBigInteger("video_id")->nullable();
            $table->foreign("video_id")->references("id")->on("studio_class_vidios");
            $table->unsignedBigInteger("cart_class_id")->nullable();
            $table->foreign("cart_class_id")->references("id")->on("cart_classes");
            $table->unsignedBigInteger("cart_video_id")->nullable();
            $table->foreign("cart_video_id")->references("id")->on("cart_videos");
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
        Schema::dropIfExists('payments');
    }
}
