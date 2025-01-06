<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Constants\Enum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    const FILLABLE = [
        'uuid',
        'name',
        'email',
        'password',
        'username',
        'dob',
        'is_deleted',
        'role',
        'photo',
        'phone',
        'specialty_id',
        'verified_by_admin',
        'address',
    ];

    protected $fillable = self::FILLABLE;

    protected $appends = ['photo_path'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

    public function getPhotoPathAttribute()
    {
        if ($this->photo == 'blank.png') {
            return asset('assets/media/avatars/' . $this->photo);
        }
        return asset('storage/user-photos/' . $this->photo);
    }


    public function scopeFilter($q)
    {
        $col = @request('search')['regex'];
        $value = @request('search')['value'];
        if ($value) {
            $q->where('name','like' , "%$value%")->orWhere('phone','like' , "%$value%");
        }
        return $q;
    }
    public function scopeAdmins($q)
    {
        return $q->where('role', Enum::ADMIN);
    }
    public function scopePatients($q)
    {
        return $q->where('role', Enum::PATIENT);
    }
    public function scopeDoctors($q)
    {
        return $q->where('role', Enum::DOCTOR);
    }
    public function doctorSpecialty()
    {
        return $this->belongsTo(Specialty::class, 'specialty_id');
    }

    public function doctorAppointments()
    {
        return $this->hasMany(Appointment::class,'doctor_id');
    }
    public function patientAppointments()
    {
        return $this->hasMany(Appointment::class,'patient_id');
    }


}
