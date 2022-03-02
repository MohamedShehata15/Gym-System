<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gym extends Model
{
    use HasFactory;

    protected $fillable = [
		'name',
         'image',
        //  'city_name',
          'staffs_id',
          'revenue'
	];
}
