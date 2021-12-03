<?php

namespace Modules\Studio\Entities;

use App\Models\User;
use Brryfrmnn\Transformers\Json;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\StudioOwners\Entities\BankAccount;

class Studio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Studio\Database\factories\StudioFactory::new();
    }

    // public function member()
    // {
    //     return $this->hasMany(User::class, 'studio_id');
    // }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
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



    // ==== Scope ==== //

    public function scopeSearch($query, $search)
    {
        if ($search !== null) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        }

        return $query;
    }

    public function scopeSort($query, $sorts)
    {
        if ($sorts != null || $sorts != '') {
            $sorts = explode(',', str_replace(' ', '', $sorts));
            foreach ($sorts as $sort) {
                $field = preg_replace('/[-]/', '', $sort);
                if (substr($sort, 0, 1) == '-') {
                    $query = $query->orderBy($field, 'desc');
                } else {
                    $query = $query->orderBy($field, 'asc');
                }
            }
        } else {
            $query = $query->orderBy('id', 'asc');
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

    // Value

    public function getValueAttribute()
    {
        $avarage = Reviews::where('studio_id', 1)->pluck('ratings')->avg();
        // dd($avarage);
        $this->attributes["value"] = 2;
    }
    public function getLinkAttribute()
    {
        if ($this->attributes["link"] == null) {
            return  env('IMAGE_URL', ' http://127.0.0.1:8000/app/') . $this->attributes['slug'] . '/home';
            // return  env('IMAGE_URL', ' https://api.ensiklotari.com/app/') . $this->attributes['slug'];
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
