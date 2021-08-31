<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientCard extends Model
{
    use HasFactory;
    protected $table='patient_card';
    protected $fillable = [
        "name",
        "father_name",
        "mother_name",
        "birthdate",
        "gender",
        "address",
        "phone_number",
        "marital_status",
        "children_count",
        "job",
        "from_clinic",
    ];
    public function PatientFileTransferRequest(){
        return $this->belongsTo(PatientFileTransferRequest::Class,'id');
    }
    public function diagnosis(){
        return $this->hasMany(Diagnosis::Class,'patient_Id');
    }
    public function extraInformation(){
        return $this->hasMany(ExtraInformation::Class,'patient_Id');
    }
}
