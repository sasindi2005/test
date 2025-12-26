<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'branch_id',
        'appointment_at',
        'status',
        'notes',
    ];

    protected $casts = [
        'appointment_at' => 'datetime',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
