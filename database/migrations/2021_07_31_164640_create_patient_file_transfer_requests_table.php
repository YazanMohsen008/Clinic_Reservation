<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientFileTransferRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
*/
    public function up()
    {
        Schema::create('patient_file_transfer_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sender_clinic_id')->unsigned();
            $table->bigInteger('patient_Id')->unsigned()->nullable();
            $table->date('date');
            $table->timestamps();
        });

        Schema::table('patient_file_transfer_requests', function($table)
        {
            $table->foreign('patient_Id')->references('id')->on('patient_card')->onDelete('cascade');
            $table->foreign('sender_clinic_id')->references('id')->on('clinics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_file_transfer_requests');
    }
}
