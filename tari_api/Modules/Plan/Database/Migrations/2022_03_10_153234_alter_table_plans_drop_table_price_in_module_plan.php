<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePlansDropTablePriceInModulePlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("plans", function (Blueprint $table) {
            $table->dropColumn("price");
            $table->dropColumn("duration");
            $table->unsignedBigInteger("date_count")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("plans", function (Blueprint $table) {
            $table->integer("price")->nullable();
            $table->integer("duration")->nullable();
            $table->dropColumn("date_count");
        });
    }
}
