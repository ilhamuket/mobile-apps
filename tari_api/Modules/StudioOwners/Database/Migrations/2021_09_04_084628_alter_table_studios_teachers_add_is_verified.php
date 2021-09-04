<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableStudiosTeachersAddIsVerified extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('studios_teachers', function (Blueprint $table) {
            $table->boolean('is_verified')->default(false);
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
            $table->dropColumn('is_verified');
        });
    }
}