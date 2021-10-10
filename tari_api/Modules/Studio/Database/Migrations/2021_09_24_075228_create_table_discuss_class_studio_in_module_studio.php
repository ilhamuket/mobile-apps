<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDiscussClassStudioInModuleStudio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discusses', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->boolean('isReplies')->nullable()->default(false);
            $table->boolean('isReport')->nullable()->default(false);
            $table->boolean('isChildReplies')->nullable()->default(false);
            $table->boolean('isChildReport')->nullable()->default(false);
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on("discusses");
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('studioClasses');
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
        Schema::dropIfExists('discusses');
    }
}