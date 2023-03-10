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
        Schema::dropIfExists('extra_information');
        Schema::create('extra_information', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('patient_card_id');
            $table->string('type');
            $table->string('description');
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
        Schema::dropIfExists('extra_information');
    }
}
