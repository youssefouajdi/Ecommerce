<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoteUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note-users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('note') ;
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('Clients');
        });
        Schema::rename('note-users', 'note_users');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('note-users');
    }
}
