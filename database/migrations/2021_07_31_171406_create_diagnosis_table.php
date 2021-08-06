<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('patient_Id')->unsigned();
            $table->string('disease');
            $table->string('disease_story');
            $table->string('family_story');
            $table->string('doctor_diagnosis');
            $table->date('date');
            $table->timestamps();
        });
        Schema::table('diagnosis', function($table)
        {
            $table->foreign('patient_Id')->references('id')->on('patient')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnosis');
    }
}
