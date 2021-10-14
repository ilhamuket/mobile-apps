<?php

namespace Modules\Studio\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\StudioOwners\Entities\CategoryImg;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Studio\Database\factories\CategoryFactory::new();
    }

    public function class()
    {
        return $this->hasMany(StudioClass::class, 'category_id');
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id');
    }

    public function img()
    {
        return $this->hasOne(CategoryImg::class, 'category_id');
    }

    public function follow()
    {
        return $this->belongsToMany(User::class, 'category_follow', 'category_id', 'user_id');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'category_like', 'category_id', 'user_id');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($categories) { // before delete() method call this
            $categories->class()->each(function ($items) {
                $items->delete(); // <-- direct deletion
            });
        });
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

    public function scopeFilterStatus($query, $status)
    {
        if ($status != null || $status != '') {
            $query->where('status', $status);
        }

        return $query;
    }
}