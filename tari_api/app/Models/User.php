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
use Modules\Room\Entities\Room;
use Modules\Studio\Entities\CartClass;
use Modules\Studio\Entities\CartVideo;
use Modules\Studio\Entities\ClassesScheduleStudio;
use Modules\Studio\Entities\Studio;
use Modules\Studio\Entities\StudioClass;
use Modules\StudioOwners\Entities\ClassesOwnerStudio;
use Modules\StudioOwners\Entities\OwnerStudio;
use Modules\User\Entities\ImageUser;
use Modules\User\Entities\Otp;
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

    // public function myClass()
    // {
    //     return $this->belongsToMany(ClassesScheduleStudio::class, 'room_student', 'user_id', 'sub_class_id');
    // }

    public function cart()
    {
        return $this->hasMany(CartClass::class, 'user_id');
    }

    public function cartEnsikloVideo()
    {
        return $this->hasMany(CartVideo::class, 'user_id');
    }

    // public function saveTheories()
    // {
    //     return $this->hasMany(Theory::class, 'user_id');
    // }

    public function studio()
    {
        return $this->hasOne(Studio::class, 'author_id');
    }

    public function img()
    {
        return $this->hasOne(ImageUser::class, 'user_id');
    }

    // public function ownerStudio()
    // {
    //     return $this->belongsTo(Studio::class, 'author_id');
    // }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'student_id');
    }

    public function last()
    {
        return $this->belongsToMany(StudioClass::class, 'classes_user_activity', 'user_activity_id', 'class_id');
    }

    public function followingStudio()
    {
        return $this->belongsToMany(Studio::class, 'follow_studio', 'user_id', 'studio_id');
    }

    public function wishlist()
    {
        return $this->belongsToMany(StudioClass::class, 'user_wishlist_live', "user_id", "class_id");
    }

    public function myClass()
    {
        return $this->belongsToMany(ClassesOwnerStudio::class, 'has_class', 'user_id', 'class_id');
    }

    public function otp()
    {
        return $this->hasOne(Otp::class, 'user_id');
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
        } else if ($summary == 'student') {
            $query->whereHas('roles', function (Builder $query) {
                $query->where('id', 2);
            });
        } else if ($summary == 'owner') {
            $query->whereHas('roles', function (Builder $query) {
                $query->where('id', 3);
            });
        }

        return $query;
    }

    public function scopeEntities($query, $entities)
    {
        if ($entities != null || $entities != '') {
            $entities = str_replace(' ', '', $entities);
            $entities = explode(',', $entities);

            try {
                return $query = $query->with($entities);
            } catch (\Throwable $th) {
                return Json::exception(null, validator()->errors());
            }
        }
    }


    public function geturlIgAttribute()
    {
        if ($this->attributes['username_ig'] != null) {
            return  'https://www.instagram.com/' . $this->attributes['username_ig'];
        } else {
            return $this->attributes['username_ig'];
        }
    }
    public function getUrlFbAttribute()
    {
        if ($this->attributes['username_fb'] != null) {
            return  'https://www.facebook.com/' . $this->attributes['username_fb'];
        } else {
            return $this->attributes['username_fb'];
        }
    }
    public function getUrlTwAttribute()
    {
        if ($this->attributes['username_tw'] != null) {
            return  'https://www.twitter.com/' . $this->attributes['username_tw'];
        } else {
            return $this->attributes['username_tw'];
        }
    }
}
