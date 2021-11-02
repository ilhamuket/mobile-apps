<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableStudioTeachersAddColumnSocmedInModuleStudio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('studios_teachers', function (Blueprint $table) {
            $table->string('username_ig')->nullable();
            $table->string('username_fb')->nullable();
            $table->string('username_tw')->nullable();
            $table->string('url_ig')->nullable();
            $table->string('url_fb')->nullable();
            $table->string('url_tw')->nullable();
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
            $table->dropColumn('username_ig');
            $table->dropColumn('username_fb');
            $table->dropColumn('username_tw');
            $table->dropColumn('url_ig');
            $table->dropColumn('url_fb');
            $table->dropColumn('url_tw');
        });
    }
}