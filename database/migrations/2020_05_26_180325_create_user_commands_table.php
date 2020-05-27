<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCommandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_commands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_command');
            $table->foreign('user_command')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('prod_id');
            $table->foreign('prod_id')
                  ->references('id')
                  ->on('prods')
                  ->onDelete('cascade');
            $table->integer('etat')->default(0);
            $table->boolean('vue')->default(0);
            $table->integer('jour');
            $table->date('datedebut');
            $table->string('user_name');
            $table->string('title_prod');   
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
        Schema::dropIfExists('user_commands');
    }
}
