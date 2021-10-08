<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableStudioTeachersDropTableAboutInModuleStudioowners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('studios_teachers', function (Blueprint $table) {
            $table->dropColumn('about');
        });
        Schema::table('studios_teachers', function (Blueprint $table) {
            $table->text('about')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('studios_teachers', function (Blueprint $table) {
            $table->dropColumn('about');
        });
        Schema::table('studios_teachers', function (Blueprint $table) {
            $table->string('about')->nullable();
        });
    }
}