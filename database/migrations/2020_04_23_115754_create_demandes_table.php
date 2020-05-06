<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('privilege');
            $table->date('date_demande');
            $table->date('from_demande');
            $table->date('to_demande');
            $table->unsignedBigInteger('annonce_id');
            $table->$table->foreign('annonce_id')->references('id')->on('Annonces');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('Clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demandes');
    }
}
