<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

use App\Utils\ShortableInterface;
use App\Utils\Shortable;

class Job extends Model implements ShortableInterface
{
    use Shortable;

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

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function getShortTitleAttribute()
    {
        return $this->short($this->title);
    }
    public function getShortRequirementAttribute()
    {
        return $this->short($this->requirement);
    }
    public function getShortBenefitsAttribute()
    {
        return $this->short($this->benefits);
    }
}
