<?php

namespace App;

use App\Models\Course;
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
        'name', 'email', 'password', 'cpf', 'rg', 'ra', 'course_id', 'approved', 'administrator',
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
}
