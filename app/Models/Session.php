<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model {
    use HasFactory;
    protected $fillable = [

        'name',
        'start_at',
        'finish_at',
        'gym_id'
    ]; //array of columns which allowed to change



    public function users()   //relationship between sessions & users
    {
        return $this->belongsToMany(User::class, 'session_user', 'session_id', 'user_id');
    }

    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }

    public function coaches() {
        return $this->belongsToMany(Staff::class, 'session_staff','session_id', 'staff_id');
    }
    public function gym()   //relationship between sessions & users
    {
        return $this->belongsTo(Gym::class);
    }
}