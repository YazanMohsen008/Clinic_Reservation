<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    protected $table='attachments';
    protected $fillable = [
        "diagnosis_Id",
        "name",
        "type",
        "file_format",
        "file",
        "date"
    ];
    public function diagnosis(){
        return $this->belongsTo(Diagnosis::Class,'diagnosis_Id');
    }
}
