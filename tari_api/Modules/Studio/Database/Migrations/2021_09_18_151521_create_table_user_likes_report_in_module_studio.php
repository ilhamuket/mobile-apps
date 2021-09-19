<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserLikesReportInModuleStudio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like_user_reviews', function (Blueprint $table) {
            $table->foreignId('review_id')->constrained();
            $table->unsignedBigInteger('user_likes')->nullable();
            $table->foreign('user_likes')->references('id')->on('users');
        });

        Schema::create('report_user_reviews', function (Blueprint $table) {
            $table->foreignId('review_id')->constrained();
            $table->unsignedBigInteger('user_report')->nullable();
            $table->foreign('user_report')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('like_user_reviews');
        Schema::dropIfExists("report_user_reviews");
    }
}