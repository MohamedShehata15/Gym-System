<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable {
    use HasFactory, Notifiable;

    protected $guard = 'staff';

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'national_id',
        'is_baned',
        'role'
    ];

    protected $hidden = [
        'password', 'remember_token'
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
}