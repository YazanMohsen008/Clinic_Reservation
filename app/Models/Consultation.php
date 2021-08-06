<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    protected $table='consultations';
    protected $fillable = [
        "patient_Id",
        "response_clinic_id",
        "clinic_specialization",
        "header",
        "content",
        "date",
        "response"
    ];
    public function clinic(){
        return $this->belongsTo(Clinic::Class,'response_clinic_id');
    }
    public function patient(){
        return $this->belongsTo(Patient::Class,'patient_Id');
    }

}
