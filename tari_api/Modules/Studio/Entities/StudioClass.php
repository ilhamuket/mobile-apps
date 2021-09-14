<?php

namespace Modules\Studio\Entities;

use App\Models\User;
use Brryfrmnn\Transformers\Json;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Media\Entities\Category;
use Modules\StudioOwners\Entities\imgClasses;
use Modules\StudioOwners\Entities\StudioTeacher;

class StudioClass extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'studioclasses';

    protected static function newFactory()
    {
        return \Modules\Studio\Database\factories\StudioClassFactory::new();
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // public function instructor()
    // {
    //     return $this->belongsToMany(User::class, 'class_instructor', 'class_id', 'instructor_id');
    // }

    public function instructor_v2()
    {
        return $this->belongsToMany(StudioTeacher::class, 'class_instructor_v2', 'class_id', 'instructor_id');
    }

    public function schedules()
    {
        return $this->hasMany(ClassesScheduleStudio::class, 'class_id');
    }

    public function img()
    {
        return $this->hasOne(imgClasses::class, 'class_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // ==== Scope ==== //

    public function scopeEntities($query, $entities)
    {
        if ($entities != null || $entities != '') {
            $entities = str_replace(' ', '', $entities);
            $entities = explode(',', $entities);

            try {
                return $query = $query->with($entities);
            } catch (\Illuminate\Database\Eloquent\RelationNotFoundException $e) {
                return Json::exception(null, validator()->errors()); //Json::exception(message, error, status=false)
            }
        }
    }

    public function scopeSearch($query, $search)
    {
        if ($search != null || $search != '') {
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $search;
    }

    public function scopeFindSlug($query, $slug)
    {
        if ($slug != '' || $slug != null) {
            $studio_slug = $slug;
            $query->whereHas('studio', function (Builder $query) use ($studio_slug) {
                $query->where('slug', $studio_slug);
            });
        }
    }

    public function scopeFilterBy($query, $filter)
    {
        if ($filter !== null) {
            $query->where('status', $filter);
        }

        return $query;
    }
}