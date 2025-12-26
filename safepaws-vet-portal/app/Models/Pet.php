<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    // ✅ Mass assignable fields
    protected $fillable = [
        'owner_id',
        'name',
        'species',
        'breed',
        'gender',
        'age',
    ];

    // ✅ Relationships

    // Each Pet belongs to an Owner
    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    // Each Pet can have multiple Appointments
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    // Each Pet can have multiple Consultations
    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    // Each Pet can have multiple Treatments
    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }

    // Each Pet can have multiple Medical Records
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
}
