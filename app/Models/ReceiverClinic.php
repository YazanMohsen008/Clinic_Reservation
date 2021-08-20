<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiverClinic extends Model
{
    use HasFactory;
    protected $table='receiver_clinics';
    protected $fillable = [
        "patient_file_transfer_request_id",
        "receiver_clinic_id",
        "date",
    ];
    public function receiver_clinic(){
        return $this->belongsTo(Clinic::Class,'receiver_clinic_id');
    }
    public function patient_file_transfer_request(){
        return $this->belongsTo(PatientFileTransferRequest::Class,'patient_file_transfer_request_id');
    }

}
