<?php

namespace Modules\StudioOwners\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

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