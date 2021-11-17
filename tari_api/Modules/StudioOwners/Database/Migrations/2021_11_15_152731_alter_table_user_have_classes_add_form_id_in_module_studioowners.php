<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUserHaveClassesAddFormIdInModuleStudioowners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("user_have_classes", function (Blueprint $table) {
            $table->unsignedBigInteger("form_id")->nullable();
            $table->foreign("form_id")->references("id")->on("form-registers");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("user_have_classes", function (Blueprint $table) {
            $table->dropForeign(["form_id"]);
            $table->dropColumn("form_id");
        });
    }
}
