<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_produits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('comment')->unique();
            $table->unsignedBigInteger('prod_id');
            $table->foreign('prod_id')->references('id')->on('prods');
            $table->integer('etat_comment');
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
        Schema::dropIfExists('comment_produits');
    }
}
