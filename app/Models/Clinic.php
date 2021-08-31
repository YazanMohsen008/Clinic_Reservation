<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Clinic extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens;
    protected $guard = 'clinic';

    protected $table='clinics';
    protected $fillable = [
        'name',
        'doctor_name',
        'address',
        'email',
        'password',
        'working_hours',
        'IP_address',
        'specializationId',
    ];
    public  function specialization(){
        return $this->belongsTo(Specialization::Class,'specializationId');
    }
    public function phoneNumber(){
        return $this->hasMany(PhoneNumber::Class,'clinicId');
    }
    public function reservations(){
        return $this->hasMany(ReservationRequest::Class,'clinic_Id');
    }
}
