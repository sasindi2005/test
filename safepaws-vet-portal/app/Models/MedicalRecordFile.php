<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecordFile extends Model
{
    protected $fillable = [
        'medical_record_id',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
    ];

    public function record()
    {
        return $this->belongsTo(MedicalRecord::class, 'medical_record_id');
    }

    public function url(): string
    {
        return asset('storage/' . $this->file_path);
    }
}
