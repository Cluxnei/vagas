<?php

namespace App;

use App\Models\Course;
use App\Models\Job;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'cpf', 'rg', 'ra', 'course_id', 'approved', 'administrator', 'first_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isApproved(): bool
    {
        return $this->approved == 1;
    }

    public function isAdministrator(): bool
    {
        return $this->administrator == 1;
    }

    public function isFirstLogin()
    {
        return $this->first_login == 1;
    }

    public function unsetFirstLogin()
    {
        $this->update(['first_login' => 0]);
    }

    public function scopeNotAdmistrator($query)
    {
        return $query->where('administrator', 0);
    }

    public function scopeAdministrator($query)
    {
        return $query->where('administrator', 1);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'administrator_id', 'id');
    }
}
