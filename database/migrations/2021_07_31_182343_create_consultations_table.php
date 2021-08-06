<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('patient_Id')->unsigned();
            $table->bigInteger('response_clinic_id')->unsigned()->nullable();
            $table->string('clinic_specialization');
            $table->string('header');
            $table->string('content');
            $table->date('date');
            $table->string('response')->nullable();
            $table->timestamps();
        });
        Schema::table('consultations', function($table)
        {
            $table->foreign('patient_Id')->references('id')->on('patient')->onDelete('cascade');
            $table->foreign('response_clinic_id')->references('id')->on('clinics')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultations');
    }
}
