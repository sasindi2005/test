<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TreatmentUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'treatment_id',
        'veterinarian_id',
        'status',
        'notes',
        'attachment',
    ];

    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }
}
