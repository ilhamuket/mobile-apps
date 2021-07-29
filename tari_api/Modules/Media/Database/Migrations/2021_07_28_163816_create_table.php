<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('display_name');
            $table->string('status')->nullable();
            $table->boolean('isVerified')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('display_name');
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users');
            $table->unsignedBigInteger('teacher_id');
            $table->string('status');
            $table->foreign('teacher_id')->references('id')->on('users');
            $table->string('type');
            $table->boolean('isVerified')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->unsignedBigInteger('author_id');
            $table->string('status')->nullable();
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreignId('category_id')->nullable()->constrained();
            $table->foreignId('class_id')->nullable()->constrained();
            $table->boolean('isVerified')->default(false);
            $table->string('type');
            $table->string('title_yt');
            $table->string('slug');
            $table->string('thumbnail_url');
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
        Schema::dropIfExists('posts');
        Schema::dropIfExists('classes');
        Schema::dropIfExists('categories');
    }
}