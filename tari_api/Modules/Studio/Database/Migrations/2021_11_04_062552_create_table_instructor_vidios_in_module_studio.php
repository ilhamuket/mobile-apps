<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInstructorVidiosInModuleStudio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_profile_vidios', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("slug")->nullable();
            $table->string("status");
            $table->boolean("is_verified");
            $table->string("url");
            $table->string("url_thumbnail");
            $table->unsignedBigInteger("instructor_id");
            $table->foreign("instructor_id")->references("id")->on("studios_teachers");
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
        Schema::dropIfExists('instructor_profile_vidios');
    }
}
