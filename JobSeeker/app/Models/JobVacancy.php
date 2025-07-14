<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'job_category_id',
        'company',
        'address',
        'description'
    ];

    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class);
    }

    public function availablePositions()
    {
        return $this->hasMany(AvailablePosition::class);
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplySociety::class);
    }

    public function jobApplyPositions()
    {
        return $this->hasMany(JobApplyPosition::class);
    }
}
