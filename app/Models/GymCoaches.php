<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymCoaches extends Model
{
    use HasFactory;
    protected $fillable= [
        'name',
        'session_id',
        'staffs_id',
       ]; //array 
}
