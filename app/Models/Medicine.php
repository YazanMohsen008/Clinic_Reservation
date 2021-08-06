<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $table='medicines';
    protected $fillable = [
        "diagnosis_Id",
        "name",
        "titer",
        "date"
        ];
    public function diagnosis(){
        return $this->belongsTo(Diagnosis::Class,'diagnosis_Id');
    }

}
