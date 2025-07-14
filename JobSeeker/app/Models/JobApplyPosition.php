<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplyPosition extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'date',
        'society_id',
        'job_vacancy_id',
        'position_id',
        'job_apply_societies_id',
        'status'
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

    public function availablePosition()
    {
        return $this->belongsTo(AvailablePosition::class, 'position_id');
    }

    public function jobApplySociety()
    {
        return $this->belongsTo(JobApplySociety::class, 'job_apply_societies_id');
    }
}
