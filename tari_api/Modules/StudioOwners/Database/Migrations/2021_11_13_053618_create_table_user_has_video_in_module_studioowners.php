<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserHasVideoInModuleStudioowners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_has_videos', function (Blueprint $table) {
            $table->id();
            $table->string("status");
            $table->string("type");
            $table->foreignId("user_id")->constrained();
            $table->unsignedBigInteger("video_id")->nullable();
            $table->foreign("video_id")->references("id")->on("studio_class_vidios");
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create("has_video", function (Blueprint $table) {
            $table->foreignId("user_id");
            $table->unsignedBigInteger("video_id");
            $table->foreign("video_id")->references("id")->on("studio_class_vidios");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_has_videos');
        Schema::dropIfExists('has_video');
    }
}
