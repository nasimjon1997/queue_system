<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueueCabinetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('queue_cabinets');
        Schema::create('queue_cabinets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cabinet_id')->foreign('cabinet_id')->references('id')->on('cabinets')->cascadeOnDelete();
            $table->bigInteger('user_id')->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
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
        Schema::dropIfExists('queue_cabinets');
    }
}
