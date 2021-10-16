<?php

namespace Modules\Studio\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudioClassVidios extends Model
{
    use HasFactory;

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
        return $this->belongsTo(Category::class, 'studio_id');
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
}