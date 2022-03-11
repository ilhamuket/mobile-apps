<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCartVideosAddSomethingToHaveMatchWithCartClassFixErrorBeforeInModulePayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("cart_videos", function (Blueprint $table) {
            // $table->dropForeign(["bank_id"]);
            $table->dropColumn("bank_id");
            $table->dropColumn("isPaid");
            $table->dropColumn("image_url");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table("cart_")
    }
}
