<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'courses_jobs');
    }
}
