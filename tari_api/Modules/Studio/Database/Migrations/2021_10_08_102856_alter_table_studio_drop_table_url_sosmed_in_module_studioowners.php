<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableStudioDropTableUrlSosmedInModuleStudioowners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('studios', function (Blueprint $table) {
            $table->dropColumn('username_ig');
            $table->dropColumn('username_fb');
            $table->dropColumn('username_tw');
            $table->dropColumn('url_ig');
            $table->dropColumn('url_fb');
            $table->dropColumn('url_tw');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('studios', function (Blueprint $table) {
            $table->string('username_ig');
            $table->string('username_fb');
            $table->string('username_tw');
            $table->string('url_ig');
            $table->string('url_fb');
            $table->string('url_tw');
        });
    }
}