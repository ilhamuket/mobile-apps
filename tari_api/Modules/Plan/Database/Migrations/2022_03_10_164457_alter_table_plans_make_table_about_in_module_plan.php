<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePlansMakeTableAboutInModulePlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("plans", function (Blueprint $table) {
            $table->longText("about")->nullable();
        });

        Schema::table("subscriptions", function (Blueprint $table) {
            $table->dropColumn("title");
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
            $table->dropColumn("about");
        });
        Schema::table("subscriptions", function (Blueprint $table) {
            $table->string("title")->nullable();
        });
    }
}
