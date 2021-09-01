<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;
    protected $table='diagnoses';
    protected $fillable = [
        "patient_card_id",
        "disease",
        "disease_story",
        "family_story",
        "doctor_diagnosis",
        "date",
    ];

    public function patient(){
        return $this->belongsTo(PatientCard::Class,'patient_card_id');
    }
    public function prescriptions() {
        return $this->hasMany(Prescription::class,'diagnosis_Id');
    }

    public function attachments(){
        return $this->hasMany(Attachment::Class,'diagnosis_Id');
    }
}
