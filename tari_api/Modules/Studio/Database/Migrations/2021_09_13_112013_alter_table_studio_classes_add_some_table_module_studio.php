<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableStudioClassesAddSomeTableModuleStudio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('studioclasses', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->string('url_meets')->nullable();
            $table->string('keyword')->nullable();
            $table->string('durasi')->nullable();
            $table->string('harga')->nullable();
            $table->unsignedBigInteger('kapasitas')->default(0);
            $table->time('time_start');
            $table->time('time_end');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('studioclasses', function (Blueprint $table) {
            $table->boolean('status')->nullable();
            $table->dropColumn('url_meets');
            $table->dropColumn('keyword');
            $table->dropColumn('durasi');
            $table->dropColumn('kapasitas');
            $table->dropColumn('harga');
            $table->dropColumn('time_start');
            $table->dropColumn('time_end');
        });
    }
}