<?php

namespace Modules\StudioOwners\Entities;

use App\Models\User;
use Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Studio\Entities\ImagesStudio;
use Modules\Studio\Entities\Reviews;

class OwnerStudio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];
    protected $table = 'studios';

    protected static function newFactory()
    {
        return \Modules\StudioOwners\Database\factories\OwnerStudioFactory::new();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }


    public function member()
    {
        return $this->hasMany(User::class, 'studio_id');
    }

    // public function author()
    // {
    //     return $this->belongsTo(User::class, 'author_id');
    // }
    public function img()
    {
        return $this->hasOne(ImagesStudio::class, 'studio_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follow_studio', 'studio_id', 'user_id');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'like_studio', 'studio_id', 'user_id');
    }

    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'studio_id');
    }

    public function bank()
    {
        return $this->hasMany(BankAccount::class, 'studio_id');
    }

    // ==== Scope === //
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
    public function getLinkAttribute()
    {
        if ($this->attributes["link"] == null) {
            // return  env('FRONTEND_URL_PRODUCTION_MAIN_APP', ' http://127.0.0.1:8081/') . $this->attributes['slug'] . '/home?created_at=' . now();
            return  env('FRONTEND_URL_PRODUCTION_MAIN_APP', ' https://app.ensiklotari.com/') . $this->attributes['slug'];
        }
    }
}
