<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableStudioclassesAddColumnShowInModuleStudio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('studioclasses', function (Blueprint $table) {
            $table->boolean('show')->default(false);
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
            $table->dropColumn('show');
        });
    }
}