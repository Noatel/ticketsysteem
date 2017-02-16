<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActieTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actie_ticket', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ticket_id')->unsigned()->nullable();
            $table->integer('actie_id')->unsigned()->nullable();

            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->foreign('actie_id')->references('id')->on('acties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('actie_ticket');
    }
}
