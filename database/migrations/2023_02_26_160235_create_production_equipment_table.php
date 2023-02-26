<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_equipment', function (Blueprint $table) {
            $table->id();
            $table->string("equipment_name");
            $table->string("status");
            $table->integer("quantity");
            $table->string("price");
            $table->dateTime("output_time");
            $table->dateTime("maintenance_time");
            $table->text("specifications");
            $table->text("describe");
            $table->unsignedBigInteger("production_team_id");
            $table->foreign("production_team_id")
                ->references("id")
                ->on("production_teams")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('production_equipment');
    }
}
