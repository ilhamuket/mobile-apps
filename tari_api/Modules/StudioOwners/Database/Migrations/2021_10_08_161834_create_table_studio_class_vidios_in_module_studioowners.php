<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStudioClassVidiosInModuleStudioowners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studio_class_vidios', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('levels');
            $table->string('url');
            $table->string('duration');
            $table->text('about');
            $table->string('price');
            $table->string('status');
            $table->string('slug');
            $table->text('note');
            $table->string('url_thumbnail');
            $table->string('type')->default('vidio');
            $table->boolean('is_verified')->default(false);
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('studio_id')->constrained();
            $table->foreignId('playlist_id')->nullable()->constrained();
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
        Schema::dropIfExists('studio_class_vidios');
    }
}