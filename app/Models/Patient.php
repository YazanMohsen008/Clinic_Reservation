<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table='patient';
    protected $fillable = [
        "full_name",
        "phone_number",
        "email",
        "password",
    ];
    public function reservationRequests(){
        return $this->hasMany(ReservationRequest::Class,'patient_Id');
    }

}
