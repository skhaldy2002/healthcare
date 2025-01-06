<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    const FILLABLE = [
        'patient_id',
        'doctor_id',
        'appointment_date',
        'price',
        'status'
    ];

    protected $fillable = self::FILLABLE;

    public function scopeFilter($q)
    {
//        $col = @request('search')['regex'];
//        $value = @request('search')['value'];
//        if ($value) {
//            $q->where('name','like' , "%$value%")->orWhere('phone','like' , "%$value%");
//        }

        if(isPatient()){
            $q->where('patient_id', auth()->id());
        }
        if(isDoctor()){
            $q->where('doctor_id', auth()->id());
        }
        return $q;
    }

    public function scopePending($q)
    {
        return $q->where('status', 'pending');
    }

    public function doctor(){
        return $this->belongsTo(User::class, 'doctor_id');
    }
    public function patient(){
        return $this->belongsTo(User::class, 'patient_id');
    }
    public function medical_records(){
        return $this->hasOne(MedicalRecord::class);
    }


}
