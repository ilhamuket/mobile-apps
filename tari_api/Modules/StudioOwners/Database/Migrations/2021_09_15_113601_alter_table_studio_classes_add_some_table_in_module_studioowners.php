<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableStudioClassesAddSomeTableInModuleStudioowners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('studioClasses', function (Blueprint $table) {
            $table->unsignedBigInteger('views')->default(0);
            $table->string('status_kelas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('studioClasses', function (Blueprint $table) {
            $table->dropColumn('views');
            $table->dropColumn('status_kelas');
        });
    }
}