<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'job_category_id',
        'society_id',
        'validator_id',
        'status',
        'work_experience',
        'job_position',
        'reason_accepted',
        'validator_notes'
    ];

    public function society()
    {
        return $this->belongsTo(Society::class);
    }

    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class);
    }

    public function validator()
    {
        return $this->belongsTo(Validator::class);
    }
}
