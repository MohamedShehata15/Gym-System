<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTrainingPackage extends Model {
    use HasFactory;

    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }
    public function gyms()
    {
        return $this->belongsTo(Gym::class);
    }

    public function package() {
        return $this->belongsTo(TrainingPackage::class,'training_package_id');
    }
}