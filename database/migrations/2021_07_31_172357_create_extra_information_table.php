<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_information', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('patient_Id')->unsigned();
            $table->string('type');
            $table->string('description');
            $table->timestamps();
        });
        Schema::table('extra_information', function($table)
        {
            $table->foreign('patient_Id')->references('id')->on('patient_card')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extra_information');
    }
}
