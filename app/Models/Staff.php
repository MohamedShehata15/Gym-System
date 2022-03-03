<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'national_id',
        'is_baned'
    ];

    // City Manager
    public function city() {
        return $this->hasOne(City::class);
    }

    // Gym Manager
    public function gymManger() {
        return $this->belongsToMany(Gym::class, 'gym_managers', 'staff_id', 'gym_id');
    }

    public function coachGyms() {
        return $this->belongsToMany(Gym::class, 'gym_coaches', 'staff_id', 'gym_id');
    }

    public function coachSessions() {
        return $this->belongsToMany(Session::class, 'coach_sessions', 'staff_id', 'session_id');
    }

    public function session()
    {
        return $this->belongsToMany(Session::class);
    }
}