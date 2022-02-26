<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCartClassesInModuleAdministrator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_classes', function (Blueprint $table) {
            $table->string('image_url')->nullable();
            $table->boolean("isPaid")->nullable();
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
        Schema::table('cart_classes', function (Blueprint $table) {
            $table->dropColumn('image_url');
            $table->dropColumn("isPaid");
            $table->dropSoftDeletes();
        });
    }
}
