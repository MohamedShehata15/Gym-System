<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymCoach extends Model
{
    use HasFactory;
    protected $table = 'gym_coaches';
    protected $fillable = [
        'gym_id','staff_id'
    ];
}
