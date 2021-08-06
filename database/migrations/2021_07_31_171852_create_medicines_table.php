<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('diagnosis_Id')->unsigned();
            $table->string('name');
            $table->string('titer');
            $table->date('date');
            $table->timestamps();
        });
        Schema::table('medicines', function($table)
        {
            $table->foreign('diagnosis_Id')->references('id')->on('diagnosis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicines');
    }
}
