<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoteProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_produits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('note');
            $table->unsignedBigInteger('prod_id');
            $table->foreign('prod_id')->references('id')->on('prods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('note_produits');
    }
}
