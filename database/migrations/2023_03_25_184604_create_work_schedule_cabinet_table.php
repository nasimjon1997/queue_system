<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkScheduleCabinetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('work_schedule_cabinets');
        Schema::create('work_schedule_cabinets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cabinet_id')->foreign('cabinet_id')->references('id')->on('cabinets')->cascadeOnDelete();
            $table->timestamp('from');
            $table->timestamp('to');
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
        Schema::dropIfExists('work_schedule_cabinets');
    }
}
