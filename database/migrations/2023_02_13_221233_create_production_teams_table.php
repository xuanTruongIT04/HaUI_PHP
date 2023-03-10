<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_teams', function (Blueprint $table) {
            $table->id();
            $table->string('production_team_name');
            // $table->string('department_code');
            $table->softDeletes();
            $table->timestamps();
            $table->unsignedBigInteger("department_id");
            $table->foreign("department_id")
                ->references("id")
                ->on("departments")
                ->onDelete("cascade")
                ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('production_teams');
    }
}
