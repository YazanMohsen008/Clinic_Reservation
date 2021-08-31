<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraInformation extends Model
{
    use HasFactory;
    protected $table='extra_information';
    protected $fillable = [
        "patient_card_id",
        "type",
        "description",
    ];

    public function patient(){
        return $this->belongsTo(PatientCard::Class,'patient_card_id');
    }

}
