<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('diagnoses');
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_card_id');
            $table->string('disease');
            $table->text('disease_story')->nullable();
            $table->text('family_story')->nullable();
            $table->string('doctor_diagnosis')->nullable();
            $table->date('date');
            $table->timestamps();

            $table->foreign('patient_card_id')
                ->references('id')
                ->on('patient_card')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnoses');
    }
}
