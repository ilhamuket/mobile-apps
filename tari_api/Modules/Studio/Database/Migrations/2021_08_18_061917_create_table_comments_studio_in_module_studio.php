<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCommentsStudioInModuleStudio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_studio_vidios', function (Blueprint $table) {
            $table->id();
            $table->string('comment');
            $table->unsignedBigInteger('studio_vidio_id');
            $table->foreign('studio_vidio_id')->references('id')->on('studiovidios');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('comment_studio_vidios');
            $table->foreignId('user_id')->constrained();
            $table->boolean('isReplies')->default(false);
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
        Schema::dropIfExists('comment_studio_vidios');
    }
}