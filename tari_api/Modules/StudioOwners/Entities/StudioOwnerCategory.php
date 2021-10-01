<?php

namespace Modules\StudioOwners\Entities;

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
}