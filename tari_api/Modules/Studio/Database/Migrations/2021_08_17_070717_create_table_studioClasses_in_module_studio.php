<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStudioClassesInModuleStudio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studioClasses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('status');
            $table->string('levels');
            $table->string('about');
            $table->boolean('isVerified')->default(false);
            $table->unsignedBigInteger("author_id");
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreignId('studio_id')->constrained();
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
        Schema::dropIfExists('studioClasses');
    }
}