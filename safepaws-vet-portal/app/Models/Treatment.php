<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Treatment extends Model
{
    use HasFactory;

    // ✅ Mass assignable fields
    protected $fillable = [
        'pet_id',
        'veterinarian_id', // make sure this matches the column in your DB
        'title',
        'notes',
        'status',
        'started_at',
        'completed_at',
    ];

    // ✅ Cast dates to Carbon instances
    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    // ✅ Relationship to Pet
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    // ✅ Relationship to Treatment Updates (if you have a TreatmentUpdate model)
    public function updates()
    {
        return $this->hasMany(TreatmentUpdate::class);
    }

    // ✅ Relationship to Veterinarian (User model)
    public function vet()
    {
        return $this->belongsTo(User::class, 'veterinarian_id');
    }
}
