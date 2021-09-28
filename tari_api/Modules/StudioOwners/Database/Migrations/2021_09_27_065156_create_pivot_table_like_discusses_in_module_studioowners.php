<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotTableLikeDiscussesInModuleStudioowners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discuss_like', function (Blueprint $table) {
            $table->foreignId('discuss_id')->constrained();
            $table->foreignId('user_id')->constrained();
        });
        Schema::create('discuss_report', function (Blueprint $table) {
            $table->foreignId('discuss_id')->constrained();
            $table->foreignId('user_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discuss_like');
        Schema::dropIfExists('discuss_report');
    }
}