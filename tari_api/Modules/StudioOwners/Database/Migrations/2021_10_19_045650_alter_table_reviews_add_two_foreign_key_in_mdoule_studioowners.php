<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableReviewsAddTwoForeignKeyInMdouleStudioowners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("reviews", function (Blueprint $table) {
            $table->unsignedBigInteger('class_id')->nullable();
            $table->foreign('class_id')->references('id')->on('studioClasses');
            $table->unsignedBigInteger('class_vidio_id')->nullable();
            $table->foreign('class_vidio_id')->references('id')->on('studio_class_vidios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("reviews", function (Blueprint $table) {
            $table->dropForeign(['class_id']);
            $table->dropColumn('class_id');
            $table->dropForeign(['class_vidio_id']);
            $table->dropColumn('class_vidio_id');
        });
    }
}