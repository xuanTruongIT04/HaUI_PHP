<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductBrokenToDefectiveProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('defective_products', function (Blueprint $table) {
            //
            $table->integer("qty_broken") -> nullable() -> after("can_fix");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('defective_products', function (Blueprint $table) {
            //
            $table->dropColumn("qty_broken");
        });
    }
}
