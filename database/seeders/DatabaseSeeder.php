<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('specialization')->insert(['name' => "Nose"]);
        DB::table('specialization')->insert(['name' => "Mouth"]);

        DB::table('clinics')->insert([
            'name' => "YznClinic"
            , 'doctor_name' => "Yzn"
            , 'address' => "42KCZ"
            , 'email' => "Yzn@gmail.com"
            , 'password' => "01"
            , 'working_hours' => 6
            , 'IP_address' => "192.168.221.1"
            , 'specializationId' => 1

        ]);
        DB::table('clinics')->insert([
            'name' => "AhmedClinic"
            , 'doctor_name' => "Ahmed"
            , 'address' => "72KCZ"
            , 'email' => "Ahmed@gmail.com"
            , 'password' => "01"
            , 'working_hours' => 6
            , 'IP_address' => "192.168.221.1"
            , 'specializationId' => 1
        ]);
        DB::table('phone_numbers')->insert([
            'phone_number' => "0944545789"
            , 'clinicId' => 1
        ]);
        DB::table('phone_numbers')->insert([
            'phone_number' => "0974545789"
            , 'clinicId' => 2
        ]);

        DB::table('patient')->insert([
            'full_name' => "Majed"
            , 'phone_number' => "092221124"
            , 'email' => "Majed@gmail.com"
            , 'password' => "01"
        ]);
        DB::table('patient')->insert([
            'full_name' => "Akram"
            , 'phone_number' => "092121124"
            , 'email' => "Akram@gmail.com"
            , 'password' => "01"
        ]);

        //This data for Reservation requests
        DB::table('reservation_requests')->insert([
            'patient_Id' => 1
            , 'clinic_Id' => 1
            , 'reservation_date' => "2013-02-03"
            , 'status' => "pending"
        ]);

        //This Data are for Transferring Requests
        DB::table('patient_card')->insert([
            'name' => "Majed"
            , 'father_name' => "Kareem"
            , 'mother_name' => "Hiba"
            , 'gender' => "male"
            , 'birthdate' => "2020-01-10"
            , 'address' => "5A00C"
            , 'phone_number' => "0978845123"
            , 'children_count' => 0
            , 'material_status' => "dasdas"
            , 'jop' => "Teacher"
            , 'transfer_method' => "Alone"
        ]);
        DB::table('diagnosis')->insert([
            'patient_Id' => 1  //patient card
            , 'disease' => "Hunger"
            , 'disease_story' => "SDada"
            , 'family_story' => "dasdsa"
            , 'doctor_diagnosis' => "dasdas"
            , 'date' => "2020-01-10"
        ]);
        DB::table('attachments')->insert([
            'diagnosis_Id' => 1
            , 'name' => 1
            , 'type' => 1
            , 'file_format' => "2013-02-03"
            , 'file' => "0000"
            , 'date' => "2020-01-10"
        ]);
        DB::table('medicines')->insert([
            'diagnosis_Id' => 1
            , 'name' => 1
            , 'titer' => 1400
            , 'date' => "2020-01-10"
        ]);

        DB::table('patient_file_transfer_requests')->insert([
            'sender_clinic_id' =>1 ,
            'patient_Id' =>1,
            'date'=>"2013-02-03"
        ]);
        DB::table('receiver_clinics')->insert([
            'patient_file_transfer_request_id' =>1 ,
            'receiver_clinic_id' =>2,
            'date'=>"2013-02-03"
        ]);

        DB::table('consultations')->insert([
            'patient_Id' =>1,
            'clinic_specialization' =>1 ,
            'header' =>"hhh" ,
            'content' =>"ccc",
            'date'=>"2013-02-03"
        ]);

    }
}
