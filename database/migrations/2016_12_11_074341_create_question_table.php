<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('questions')) {
            Schema::dropIfExists('questions');
        }

        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question_th');
            $table->string('choice1_th');
            $table->string('choice2_th');
            $table->string('choice3_th');
            $table->string('choice4_th');
            $table->longText('description_th');

            $table->string('question_en');
            $table->string('choice1_en');
            $table->string('choice2_en');
            $table->string('choice3_en');
            $table->string('choice4_en');
            $table->longText('description_en');

            $table->string('question_vn');
            $table->string('choice1_vn');
            $table->string('choice2_vn');
            $table->string('choice3_vn');
            $table->string('choice4_vn');
            $table->longText('description_vn');
            $table->integer('order');
            $table->integer('answer');

        
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
        Schema::dropIfExists('questions');
    }
}
