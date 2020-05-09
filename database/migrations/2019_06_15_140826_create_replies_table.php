<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            
            $table->increments('id');

            $table->longtext('reply');

            $table->integer('answer_id')->unsigned();

            $table->integer('user_id')->unsigned();

            $table->integer('question_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');

            $table->foreign('answer_id')->references('id')->on('answers');

            $table->foreign('question_id')->references('id')->on('questions');

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
        Schema::dropIfExists('replies');
    }
}
