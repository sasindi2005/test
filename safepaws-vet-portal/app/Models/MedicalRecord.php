<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = [
        'pet_id',
        'vet_id',
        'symptoms',
        'diagnosis',
        'prescription',
        'notes',
    ];

    protected $casts = [
        'prescription' => 'array', // ✅ JSON cast
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function vet()
    {
        return $this->belongsTo(User::class, 'vet_id'); // assuming vet is user
    }

    public function files()
    {
        return $this->hasMany(MedicalRecordFile::class);
    }
}
