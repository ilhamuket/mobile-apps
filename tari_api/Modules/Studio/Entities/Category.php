<?php

namespace Modules\Studio\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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