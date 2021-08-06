<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('doctor_name');
            $table->string('address');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('working_hours');
            $table->string('IP_address');
            $table->bigInteger('specializationId')->unsigned();
            $table->timestamps();
        });
        Schema::table('clinics', function($table)
        {
            $table->foreign('specializationId')->references('id')->on('specialization')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinics');
    }

}
