<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;
    protected $table='diagnosis';
    protected $fillable = [
        "patient_Id",
        "disease",
        "disease_story",
        "family_story",
        "doctor_diagnosis",
        "date",
    ];

    public function patient(){
        return $this->belongsTo(PatientCard::Class,'patient_Id');
    }
    public function medicines(){
        return $this->hasMany(Medicine::Class,'diagnosis_Id');
    }
    public function attachments(){
        return $this->hasMany(Attachment::Class,'diagnosis_Id');
    }
}
