<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHasClassInModuleStudioowners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('has_class', function (Blueprint $table) {
            $table->foreignId("user_id")->constrained();
            $table->unsignedBigInteger("class_id");
            $table->foreign("class_id")->references("id")->on("studioClasses");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('has_class');
    }
}
