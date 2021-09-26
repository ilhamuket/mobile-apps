<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStudioClassesVidioInModuleStudio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users');
            $table->string('price');
            $table->string('keyword')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('studio_id')->constrained();
            $table->timestamps();
        });
        Schema::create('studio_class_vidio', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->text('about');
            $table->string('levels');
            $table->string('durasi')->nullable();
            $table->string('price');
            $table->boolean('show')->default(false);
            $table->foreignId('studio_id')->constrained();
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreignId('playlist_id')->constrained();
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
        Schema::dropIfExists('studio_class_vidio');
        Schema::dropIfExists('playlists');
    }
}