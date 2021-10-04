<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableReviewsAndDiscussAddBooleanInModuleStudioowners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->boolean('is_response')->default(false);
        });
        Schema::table('discusses', function (Blueprint $table) {
            $table->boolean('is_response')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('is_response');
        });
        Schema::table('discusses', function (Blueprint $table) {
            $table->dropColumn('is_response');
        });
    }
}