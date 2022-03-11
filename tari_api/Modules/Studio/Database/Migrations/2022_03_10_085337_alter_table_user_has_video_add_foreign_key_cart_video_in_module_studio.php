<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUserHasVideoAddForeignKeyCartVideoInModuleStudio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("user_has_videos", function (Blueprint $table) {
            $table->unsignedBigInteger('cart_video_id')->nullable();
            $table->foreign("cart_video_id")->references("id")->on("cart_videos")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("user_has_videos", function (Blueprint $table) {
            $table->dropForeign(["cart_video_id"]);
            $table->dropColumn("cart_video_id");
        });
    }
}
