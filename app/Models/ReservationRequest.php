<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationRequest extends Model
{
    use HasFactory;
    protected $table='reservation_requests';
    protected $fillable = [
        "patient_Id",
        "clinic_Id",
        "reservation_date",
        "status",
        "request_type",
        "reservation_time",
        "reject_reason",
    ];
    public function clinic(){
        return $this->belongsTo(Clinic::Class,'clinic_Id');
    }
    public function patient(){
        return $this->belongsTo(Patient::Class,'patient_Id');
    }
}
