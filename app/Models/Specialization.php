<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;
    protected $table='specialization';
    protected $fillable = [
        'name',
    ];
    public function clinic(){
        return $this->hasMany(Clinic::Class,'id');
    }
}
