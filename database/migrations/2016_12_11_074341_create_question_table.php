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
            $table->string('title_th');
            $table->string('title_en');
            $table->string('background_color');
            $table->string('cover_name');
            $table->string('cover_ext');
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
