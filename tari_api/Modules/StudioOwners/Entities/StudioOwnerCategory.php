<?php

namespace Modules\StudioOwners\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudioOwnerCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];
    protected $table = 'categories';

    protected static function newFactory()
    {
        return \Modules\StudioOwners\Database\factories\StudioOwnerCategoryFactory::new();
    }

    public function class()
    {
        return $this->hasMany(ClassesOwnerStudio::class, 'category_id');
    }

    public function studio()
    {
        return $this->belongsTo(OwnerStudio::class, 'studio_id');
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
            $categories->img()->each(function ($items) {
                dd($items->url);
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

    public function scopeBySummary($query, $summary)
    {
        if ($summary != '' && $summary != null) {
            $query->where('status', $summary);
        }

        return $query;
    }
}
