<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymCoach extends Model
{
    use HasFactory;
    protected $fillable= [
        'name',
        'session_id',
        'staffs_id',
       ]; //array 
}
