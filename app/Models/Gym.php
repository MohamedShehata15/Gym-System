<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class Gym extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'revenue',
        'city_id',
        'staff_id',
    ];

    // Managers
    public function gymManager() {
        return $this->belongsToMany(Staff::class, 'gym_managers', 'gym_id', 'staff_id');
    }

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function gymCoaches() {
        return $this->belongsToMany(Staff::class, 'gym_coaches', 'gym_id', 'staff_id');
    }

    public function trainingPackages() {
        return $this->hasMany(TrainingPackage::class);
    }
}

