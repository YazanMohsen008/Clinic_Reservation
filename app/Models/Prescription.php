<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $table = 'prescriptions';
    protected $fillable = [
    "diagnosis_id",
    "date"
    ];
    public function medicines() {
        return $this->hasMany(Medicine::class);
    }

    public function diagnosis() {
        return $this->belongsTo(Diagnosis::class);
    }
}
