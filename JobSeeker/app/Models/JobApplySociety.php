<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplySociety extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'notes',
        'date',
        'society_id',
        'job_vacancy_id'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function society()
    {
        return $this->belongsTo(Society::class);
    }

    public function jobVacancy()
    {
        return $this->belongsTo(JobVacancy::class);
    }

    public function jobApplyPositions()
    {
        return $this->hasMany(JobApplyPosition::class, 'job_apply_societies_id');
    }
}
