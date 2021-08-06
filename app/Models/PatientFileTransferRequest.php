<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientFileTransferRequest extends Model
{
    use HasFactory;
    protected $table='patient_file_transfer_requests';
    protected $fillable = [
        "sender_clinic_id",
        "patient_Id",
        "date"
    ];
    public function clinic(){
        return $this->belongsTo(Clinic::Class,'sender_clinic_id');
    }

    public function PatientCard(){
        return $this->hasOne(PatientCard::Class,'id');
    }

    public function reciverClinics(){
        return $this->hasMany(ReceiverClinic::Class,'receiver_clinic');
    }

}
