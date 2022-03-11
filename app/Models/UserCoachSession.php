<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCoachSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'user_id',
        'staff_id'
    ];
}
