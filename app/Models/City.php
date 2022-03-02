<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'staff_id' //city_manager_id
    ];

    public function gyms() {
        return $this->hasMany(Gym::class);
    }

    public function cityManager() {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
