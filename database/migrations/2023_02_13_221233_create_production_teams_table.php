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
<<<<<<< HEAD
            $table->foreign("department_code")
                ->references('id')
                ->on("departments")
                ->onDelete("cascade")
                ->onUpdate("cascade");
=======
            $table->unsignedBigInteger("department_id");
            $table->foreign("department_id")
                  ->references("id")
                  -> on("departments")
                  ->onDelete("cascade")
                  ->onUpdate("cascade");
>>>>>>> d1cda8893e4dd79928e3dee24b5b6595e6ad83b3
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
