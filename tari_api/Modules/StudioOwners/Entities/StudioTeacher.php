<?php

namespace Modules\StudioOwners\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Studio\Entities\Studio;

class StudioTeacher extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'studios_teachers';

    protected static function newFactory()
    {
        return \Modules\StudioOwners\Database\factories\StudioTeacherFactory::new();
    }

    public function studio()
    {
        return $this->belongsTo(OwnerStudio::class, 'studio_id');
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