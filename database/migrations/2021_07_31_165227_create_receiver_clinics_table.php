<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiverClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receiver_clinics', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('patient_file_transfer_request_id')->unsigned();
            $table->bigInteger('receiver_clinic_id')->unsigned();
            $table->date('date');
            $table->timestamps();
        });
        Schema::table('receiver_clinics', function($table)
        {
            $table->foreign('patient_file_transfer_request_id')->references('id')->on('patient_file_transfer_requests')->onDelete('cascade');
            $table->foreign('receiver_clinic_id')->references('id')->on('clinics')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receiver_clinics');
    }
}
