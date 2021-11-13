<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFormRegisterEnsikloVideosInModuleStudioowners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_videos', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string("type");
            $table->foreignId("user_id")->constrained();
            $table->unsignedBigInteger("video_id")->nullable();
            $table->foreign("video_id")->references("id")->on("studio_class_vidios");
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create("form_register_ensiklovideos", function (Blueprint $table) {
            $table->id();
            $table->string("fullName");
            $table->string("contact");
            $table->string("address");
            $table->string("email");
            $table->string("ttl");
            $table->foreignId('cart_video_id')->constrained();
            $table->foreignId("user_id")->constrained();
            $table->unsignedBigInteger("video_id")->nullable();
            $table->foreign("video_id")->references("id")->on("studio_class_vidios");
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
        Schema::dropIfExists('form_register_ensiklovideos');
        Schema::dropIfExists('cart_videos');
    }
}
