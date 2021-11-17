<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUserHaveClassesAddForeignKeyReviewsIdInMdouleStsudioowners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("user_have_classes", function (Blueprint $table) {
            $table->unsignedBigInteger("review_id")->nullable();
            $table->foreign("review_id")->references("id")->on("reviews");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("user_have_classes", function (Blueprint $table) {
            $table->dropForeign(["review_id"]);
            $table->dropColumn("review_id");
        });
    }
}
