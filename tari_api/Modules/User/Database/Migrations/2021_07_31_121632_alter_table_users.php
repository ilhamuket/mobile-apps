<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nickName')->nullable();
            $table->string('noHp')->nullable();
            $table->boolean('isVerified')->default(false);
            $table->boolean('isSubcribe')->default(false);
            $table->date('start_subscribe')->nullable();
            $table->date('end_subscribe')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nickName');
            $table->dropColumn('noHp');
            $table->dropColumn('isVerified');
            $table->dropColumn('isSubcribe');
            $table->dropColumn('start_subscribe');
            $table->dropColumn('end_subscribe');
        });
    }
}