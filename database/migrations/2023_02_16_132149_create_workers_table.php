<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string("worker_name");
            $table->integer("old");
            $table->string("address");
            $table->integer("number_of_working_days");
            $table->double("number_of_overtime");
            $table->unsignedBigInteger("salary_id");
            $table->foreign("salary_id")
                ->references("id")
                ->on("salaries")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->unsignedBigInteger("department_id");
            $table->foreign("department_id")
                ->references("id")
                ->on("departments")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->unsignedBigInteger("work_shift_id");
            $table->foreign("work_shift_id")
                ->references("id")
                ->on("work_shifts")
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
        Schema::dropIfExists('workers');
    }
}
