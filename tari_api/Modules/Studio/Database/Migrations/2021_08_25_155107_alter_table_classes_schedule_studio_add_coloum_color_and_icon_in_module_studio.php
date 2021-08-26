<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableClassesScheduleStudioAddColoumColorAndIconInModuleStudio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classes_schedule_studio', function (Blueprint $table) {
            $table->string('icon')->default('mdi-star');
            $table->string('color')->default('red lighten-2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classes_schedule_studio', function (Blueprint $table) {
            $table->dropColumn('icon');
            $table->dropColumn('color');
        });
    }
}