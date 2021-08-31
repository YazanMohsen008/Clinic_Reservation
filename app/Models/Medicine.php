<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $table='medicines';
    protected $fillable = [
        "prescription_id",
        "name",
        "titer",
        "frequency",
        "quantity",
        "note"
        ];
    public function prescriptions(){
        return $this->belongsTo(Prescription::Class,'prescription_id');
    }

}
