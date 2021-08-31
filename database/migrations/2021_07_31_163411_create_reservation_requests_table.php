<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('patient_Id')->unsigned();
            $table->bigInteger('clinic_Id')->unsigned();
            $table->dateTime("reservation_date");
            $table->string('status')->nullable();
            $table->string('request_type')->nullable();
            $table->Time("reservation_time")->nullable();
            $table->string('reject_reason')->nullable();
            $table->timestamps();
        });
        Schema::table('reservation_requests', function($table)
        {
            $table->foreign('patient_Id')->references('id')->on('patient')->onDelete('cascade');
            $table->foreign('clinic_Id')->references('id')->on('clinics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_requests');
    }
}
