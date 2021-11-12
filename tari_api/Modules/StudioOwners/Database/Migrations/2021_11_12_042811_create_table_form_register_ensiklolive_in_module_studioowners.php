<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFormRegisterEnsikloliveInModuleStudioowners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form-registers', function (Blueprint $table) {
            $table->id();
            $table->string("fullName");
            $table->string("contact");
            $table->string("address");
            $table->string("email");
            $table->string("ttl");
            $table->unsignedBigInteger("class_id");
            $table->foreign("class_id")->references("id")->on("studioClasses");
            $table->foreignId("user_id")->constrained();
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
        Schema::dropIfExists('form-registers');
    }
}
