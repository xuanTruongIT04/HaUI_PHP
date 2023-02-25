<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string("material_name", 255);
            $table->integer("qty_import");
            $table->integer("qty_broken");
            $table->integer("qty_remain");
            $table->integer("price_import");
            $table->dateTime("date_import");
            $table->string("unit_of_measure");
            $table->string("material_status");
            $table->unsignedBigInteger("stage_id");
            $table->unsignedBigInteger("image_id");
            $table->foreign("stage_id")
                  ->references("id")
                  ->on("stages")
                  ->onDelete("cascade")
                  ->onUpdate("cascade");
            $table->foreign("image_id")
                  ->references("id")
                  ->on("images")
                  ->onDelete("cascade")
                  ->onUpdate("cascade");       
            $table->timestamps();
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
        Schema::dropIfExists('materials');
    }
}
