<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStageDetailToStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stages', function (Blueprint $table) {
            //
            $table -> text("stage_detail")->after("stage_name");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stages', function (Blueprint $table) {
            //
            $table->dropColumn("stage_detail");
        });
    }
}
