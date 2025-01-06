<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    const FILLABLE = ['treatment','diagnosis','appointment_id'];

    protected $fillable = self::FILLABLE;

    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }
    public function diagnosis_files()
    {
        return $this->hasMany(MedicalRecordFile::class ,'medical_record_id');
    }


}
