<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHardwareTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hardware_ticket', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ticket_id')->unsigned()->nullable();
            $table->integer('hardware_id')->unsigned()->nullable();

            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->foreign('hardware_id')->references('id')->on('hardware')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hardware_ticket');
    }
}
