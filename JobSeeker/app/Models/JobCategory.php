<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'job_category'
    ];

    public function jobVacancies()
    {
        return $this->hasMany(JobVacancy::class);
    }

    public function validations()
    {
        return $this->hasMany(Validation::class);
    }
}
