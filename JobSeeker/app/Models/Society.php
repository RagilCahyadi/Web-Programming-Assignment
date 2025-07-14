<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Society extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'id_card_number',
        'password',
        'name',
        'born_date',
        'gender',
        'address',
        'regional_id',
        'login_tokens'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'born_date' => 'date',
    ];

    public function regional()
    {
        return $this->belongsTo(Regional::class);
    }

    public function validation()
    {
        return $this->hasOne(Validation::class);
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplySociety::class);
    }

    public function jobApplyPositions()
    {
        return $this->hasMany(JobApplyPosition::class);
    }

    public function generateToken()
    {
        return md5($this->id_card_number . time());
    }

    // Override username field untuk login
    public function getAuthIdentifierName()
    {
        return 'id_card_number';
    }
}
