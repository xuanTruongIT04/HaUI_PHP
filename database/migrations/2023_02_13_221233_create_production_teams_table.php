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
<<<<<<< HEAD
            $table->string('department_code');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("department_code")
                ->references('id')
=======
            // $table->string('department_code');
            $table->softDeletes();
            $table->timestamps();
            $table->unsignedBigInteger("department_id");
            $table->foreign("department_id")
                ->references("id")
>>>>>>> d693082fd433130cc38eff42a34ffc475a914cd4
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
