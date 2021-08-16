<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableStudioImgTypeNullAbleInModuleStudio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('img_studio', function (Blueprint $table) {
            $table->string('type');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('img_studio', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropSoftDeletes();
        });
    }
}