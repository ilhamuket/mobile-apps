<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUserHaveClassesInMdouleStsudioowners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_have_classes', function (Blueprint $table) {
            $table->string("status_responded")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_have_classes', function (Blueprint $table) {
            $table->dropColumn("status_responded");
        });
    }
}
