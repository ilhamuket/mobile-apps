<?php

namespace Modules\StudioOwners\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Studio\Entities\Studio;

class ClassesOwnerStudio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];
    protected $table = 'studioclasses';

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
            })->where('status', 1);
        }
        if ($summary == 'non-approved') {
            $query->whereHas('studio', function (Builder $query) use ($studio) {
                $query->where('id', $studio);
            })->where('status', 0);
        }
        if ($summary == 'new') {
            $query->whereHas('studio', function (Builder $query) use ($studio) {
                $query->where('id', $studio);
            })->whereDate('created_at', now());
        }

        return $query;
    }
}