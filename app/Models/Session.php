<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model {
    use HasFactory;

    public function coaches() {
        return $this->belongsToMany(Staff::class, 'coach_sessions', 'session_id', 'staff_id');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_sessions', 'session_id', 'user_id');
    }

}