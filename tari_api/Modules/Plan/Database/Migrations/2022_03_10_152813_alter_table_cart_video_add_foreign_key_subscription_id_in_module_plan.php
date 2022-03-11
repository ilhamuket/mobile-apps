<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCartVideoAddForeignKeySubscriptionIdInModulePlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("cart_videos", function (Blueprint $table) {
            $table->unsignedBigInteger('subscription_id')->nullable();
            $table->foreign("subscription_id")->references("id")->on("subscriptions")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("cart_videos", function (Blueprint $table) {
            $table->dropForeign(["subscription_id"]);
            $table->dropColumn("subscription_id");
        });
    }
}
