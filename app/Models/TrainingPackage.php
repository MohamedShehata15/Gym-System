<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingPackage extends Model {
    use HasFactory;

    public function trainingPackageGym() {
        return $this->belongsTo(Gym::class, 'gym_id');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_training_packages', 'training_package_id', 'user_id');
    }
}