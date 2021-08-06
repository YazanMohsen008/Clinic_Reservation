<?php

namespace App\Models;

use App\Http\Controllers\ReservationRequestController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;

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
