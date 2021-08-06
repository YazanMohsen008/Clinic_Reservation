<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiverClinic extends Model
{
    use HasFactory;
    protected $table='reservation_requests';
    protected $fillable = [
        "patient_file_transfer_request",
        "receiver_clinic",
        "date",
    ];
    public function receiver_clinic(){
        return $this->belongsTo(Clinic::Class,'clinic_Id');
    }
    public function patient_file_transfer_request(){
        return $this->belongsTo(PatientFileTransferRequest::Class,'patient_Id');
    }

}
