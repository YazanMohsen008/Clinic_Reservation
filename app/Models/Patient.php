<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Patient extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens;

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
    public function consultations(){
        return $this->hasMany(Consultation::Class,'patient_Id');
    }

}
