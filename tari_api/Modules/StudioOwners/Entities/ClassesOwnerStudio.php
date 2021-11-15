<?php

namespace Modules\StudioOwners\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Media\Entities\Category;
use Modules\Studio\Entities\Studio;

class ClassesOwnerStudio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];
    protected $table = 'studioClasses';

    protected static function newFactory()
    {
        return \Modules\StudioOwners\Database\factories\ClassesOwnerStudioFactory::new();
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function subClasses()
    {
        return $this->hasMany(SubClassOwnerStudio::class, 'class_id');
    }

    public function instructor()
    {
        return $this->belongsToMany(StudioTeacher::class, 'class_instructor_v2', 'class_id', 'instructor_id');
    }

    public function img()
    {
        return $this->hasOne(ImgClasses::class, 'class_id');
    }

    public function category()
    {
        return $this->belongsTo(StudioOwnerCategory::class, 'category_id');
    }

    public function listImg()
    {
        return $this->hasMany(ImgListClass::class, 'class_id');
    }

    public function student()
    {
        return $this->belongsToMany(User::class, 'has_class', 'class_id', 'user_id');
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

    public function scopeSummary($query, $summary, $studio_id)
    {
        $studio = $studio_id;

        // dd($studio);
        if ($summary == 'all') {
            $query->whereHas('studio', function (Builder $query) use ($studio) {
                $query->where('id', $studio);
            });
        }
        if ($summary == 'approved') {
            $query->whereHas('studio', function (Builder $query) use ($studio) {
                $query->where('id', $studio);
            })->where('status', 'Publish');
        }
        if ($summary == 'non-approved') {
            $query->whereHas('studio', function (Builder $query) use ($studio) {
                $query->where('id', $studio);
            })->where('status', 'Draft');
        }
        if ($summary == 'new') {
            $query->whereHas('studio', function (Builder $query) use ($studio) {
                $query->where('id', $studio);
            })->whereDate('created_at', now());
        }

        return $query;
    }

    public function getStatusKelasAttribute()
    {
        $status = '';

        if ($this->start_at  <= now()->toDateString() && $this->end_at >= now()->toDateString()) {
            $status = 'ongoing';
        } else if ($this->start_at > now()->toDateString()) {
            $status = 'upcoming';
        } else if ($this->start_at < now()->toDateString()) {
            $status = 'missed';
        }

        return $status;
    }

    public function getTimeStatusAttribute()
    {
        $status = '';

        if ($this->end_at  == now()->toDateString()) {
            $status = 'ongoing';
        } else if ($this->start_at > now()->toDateString()) {
            $status = 'upcoming';
        } else if ($this->start_at < now()->toDateString()) {
            $status = 'missed';
        }

        return $status;
    }
}
