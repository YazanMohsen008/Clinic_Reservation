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
        DB::table('specialization')->insert(["english-name" => "Nose",'arabic-name' => "الأنف"]);
        DB::table('specialization')->insert(['english-name' => "Mouth",'arabic-name' => "الفم"]);

        DB::table('clinics')->insert([
            'name' => "YznClinic"
            , 'doctor_name' => "Yzn"
            , 'address' => "42KCZ"
            , 'email' => "Yzn@gmail.com"
            , 'password' => bcrypt("01")
            , 'working_hours' => 6
            , 'IP_address' => "192.168.221.1"
            , 'specializationId' => 1

        ]);
        DB::table('clinics')->insert([
            'name' => "AhmedClinic"
            , 'doctor_name' => "Ahmed"
            , 'address' => "72KCZ"
            , 'email' => "cezar@gmail.com"
            , 'password' => bcrypt("123")
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
            , 'age' => 20
            , 'email' => "Majed@gmail.com"
            , 'password' => bcrypt("01")
        ]);
        DB::table('patient')->insert([
            'full_name' => "Akram"
            , 'phone_number' => "092121124"
            , 'age' => 20
            , 'email' => "Akram@gmail.com"
            , 'password' => bcrypt("01")
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
            , 'marital_status' => "dasdas"
            , 'job' => "Teacher"
            , 'from_clinic' => "Alone"
        ]);
        DB::table('diagnoses')->insert([
            'patient_card_id' => 1  //patient card
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
            , 'file_path' => "0000"
            , 'date' => "2020-01-10"
        ]);
        DB::table('prescriptions')->insert([
            'diagnosis_Id' => 1
            , 'date' => "2020-01-10"
        ]);
        DB::table('medicines')->insert([
            'prescription_Id' => 1
            , 'name' => 1
            , 'titer' => 1400
            , 'frequency' => 1400
            , 'quantity' => 14
            , 'note' => "note"
        ]);

        DB::table('patient_file_transfer_requests')->insert([
            'sender_clinic_id' => 1,
            'patient_card_Id' => 1,
            'date' => "2013-02-03"
        ]);
        DB::table('receiver_clinics')->insert([
            'patient_file_transfer_request_id' => 1,
            'receiver_clinic_id' => 2,
            'date' => "2013-02-03"
        ]);

        DB::table('consultations')->insert([
            'patient_Id' => 1,
            'clinic_specialization' => 1,
            'header' => "hhh",
            'content' => "ccc",
            'age' => 20,
            'date' => "2013-02-03"
        ]);

    }
}
