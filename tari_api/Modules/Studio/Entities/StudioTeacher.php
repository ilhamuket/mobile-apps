<?php

namespace Modules\Studio\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\StudioOwners\Entities\ImgInstructor;

class StudioTeacher extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'studios_teachers';

    protected static function newFactory()
    {
        return \Modules\Studio\Database\factories\StudioTeacherFactory::new();
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id');
    }
    public function img()
    {
        return $this->hasOne(ImgInstructor::class, 'instructor_id');
    }

    public function class()
    {
        return $this->belongsToMany(StudioClass::class, 'class_instructor_v2', 'instructor_id', 'class_id');
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

    public function scopeIsVerified($query, $status)
    {
        if ($status !== '' || $status !== null) {
            $query->where('is_verified', 1);
        }

        return $query;
    }
}
