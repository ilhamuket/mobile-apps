<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Classes\Entities\Schedule;
use Modules\Classes\Entities\Theory;
use Modules\Studio\Entities\Studio;
use Modules\User\Entities\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;
// use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles, HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id');
    }

    // public function saveTheories()
    // {
    //     return $this->hasMany(Theory::class, 'user_id');
    // }

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'student_id');
    }

    public function scopeByRole($query, $role_id)
    {
        if ($role_id != null) {
            $query->where('id', $role_id);
        }

        return $query;
    }

    public function scopeSummary($query, $summary)
    {
        if ($summary == 'superadministrator') {
            $query->whereHas('roles', function (Builder $query) {
                $query->where('id', 1);
            });
        } else if ($summary == 'administrator') {
            $query->whereHas('roles', function (Builder $query) {
                $query->where('id', 2);
            });
        } else if ($summary == 'instructor') {
            $query->whereHas('roles', function (Builder $query) {
                $query->where('id', 3);
            });
        }

        return $query;
    }
}