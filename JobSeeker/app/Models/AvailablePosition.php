<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailablePosition extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'job_vacancy_id',
        'position',
        'capacity',
        'apply_capacity'
    ];

    public function jobVacancy()
    {
        return $this->belongsTo(JobVacancy::class);
    }

    public function jobApplyPositions()
    {
        return $this->hasMany(JobApplyPosition::class, 'position_id');
    }

    public function getApplyCountAttribute()
    {
        return $this->jobApplyPositions()->count();
    }
}
