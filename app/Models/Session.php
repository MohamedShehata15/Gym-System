<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $fillable= [

        'name',
        'start_at',
        'finish_at',
       ]; //array of columns which allowed to change
}
