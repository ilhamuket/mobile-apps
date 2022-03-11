<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUserHasVideosAddSubcriptionInModuleStudio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_has_videos', function (Blueprint $table) {
            $table->date('start_subscription')->nullable();
            $table->date('end_subscription')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_has_videos', function (Blueprint $table) {
            $table->dropColumn('start_subscription');
            $table->dropColumn('end_subscription');
        });
    }
}
