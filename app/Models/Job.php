<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Job extends Model
{
    protected $guarded = [];

    public function administrator()
    {
        return $this->belongsTo(User::class, 'administrator_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'courses_jobs');
    }

    public function isPendent()
    {
        return $this->status == 'pendent';
    }

    public function isPublished()
    {
        return $this->status == 'published';
    }

    public function isArchived()
    {
        return $this->status == 'archived';
    }
}
