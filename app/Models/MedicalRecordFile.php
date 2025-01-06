<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecordFile extends Model
{
    use HasFactory;
    const FILLABLE = ['name','medical_record_id'];

    protected $fillable = self::FILLABLE;
}
