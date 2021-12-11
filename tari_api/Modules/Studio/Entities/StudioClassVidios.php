<?php

namespace Modules\Studio\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudioClassVidios extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];
    protected $table = 'studio_class_vidios';

    protected static function newFactory()
    {
        return \Modules\Studio\Database\factories\StudioClassVidiosFactory::new();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id');
    }

    // === Scope === //

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

    public function scopeFilterLevel($query, $level)
    {
        if ($level != null || $level != '') {
            $query->where('levels', $level);
        }

        return $query;
    }

    public function scopeCategory($query, $category, $studio_slug)
    {
        if ($category != '' || $category != null) {
            $query->whereHas('category', function (Builder $query) use ($category) {
                $query->where('slug', $category);
            })->whereHas('studio', function (Builder $query) use ($studio_slug) {
                $query->where('slug', $studio_slug);
            });
        }

        return $query;
    }

    public function scopeFilterStatus($query, $status)
    {
        if ($status != null || $status != '') {
            $query->where('status', $status);
        }

        return $query;
    }
}
