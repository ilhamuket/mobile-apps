<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableFormRegisterEnsikloVideoAddTableDateSubscriptionInModuleStudio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("form_register_ensiklovideos", function (Blueprint $table) {
            $table->string("date_subscription")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("form_register_ensiklovideos", function (Blueprint $table) {
            $table->dropColumn("date_subscription");
        });
    }
}
