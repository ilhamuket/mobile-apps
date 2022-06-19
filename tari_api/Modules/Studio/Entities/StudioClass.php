<?php

namespace Modules\Studio\Entities;

use App\Models\User;
use Brryfrmnn\Transformers\Json;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Schema\Blueprint;
use Modules\Media\Entities\Category;
use Modules\StudioOwners\Entities\ImgClasses;
use Modules\StudioOwners\Entities\ImgListClass;
use Modules\StudioOwners\Entities\StudioTeacher;
use Illuminate\Support\Str;

class StudioClass extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'studioClasses';

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
        return $this->hasOne(ImgClasses::class, 'class_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function listImg()
    {
        return $this->hasMany(ImgListClass::class, 'class_id');
    }

    public function review()
    {
        return $this->hasMany(Reviews::class, 'class_id');
    }

    public function lastSee()
    {
        return $this->belongsToMany(User::class, 'classes_user_activity', 'class_id', 'user_activity_id');
    }

    public function wishlist()
    {
        return $this->belongsToMany(User::class, 'user_wishlist_live', "class_id", "user_id");
    }

    // ==== Scope ==== //

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

        if ($this->end_at > Carbon::today()) {
            $status = 'upcoming';
        } else if ($this->end_at < Carbon::today()) {
            $status = 'missed';
        } else if ($this->end_at == Carbon::today()) {
            $status = 'ongoing';
        }

        return $status;
    }

    public function scopeGenerateSlug($q, $title)
    {
        $new_slug = Str::slug($title);
        $slug_check = $this->where('slug', $new_slug)->count();
        if ($slug_check == 0) {
            $slug = $new_slug;
        } else {
            $check = 0;
            $unique = false;
            while ($unique == false) {
                $inc_id = ++$check;
                $check = $this->where('slug', $new_slug . '-' . $inc_id)->count();
                if ($check > 0) {
                    $unique = false;
                } else {
                    $unique = true;
                }
            }
            $slug = $new_slug . '-' . $inc_id;
        }

        return $slug;
    }

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

        return $query;
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

    public function scopeSort($query, $sorts)
    {
        if ($sorts != null || $sorts != '') {
            $sorts = explode(',', str_replace(' ', '', $sorts));
            foreach ($sorts as $sort) {
                $field = preg_replace('/[-]/', '', $sort);
                if (substr($sort, 0, 1) == '-') {
                    $query = $query->orderBy($field, 'desc');
                } else {
                    $query = $query->orderBy($field, 'asc');
                }
            }
        } else {
            $query = $query->orderBy('id', 'asc');
        }

        return $query;
    }

    public function scopeStatusClass($query, $status)
    {
        if ($status == 'upcoming') {
            $query->whereDate('start_at', '>', now());
        }
        if ($status == 'ongoing') {
            $query->whereDate('start_at', '<=', now())->whereDate('end_at', '>=', now());
        }
        if ($status == 'missed') {
            $query->whereDate('start_at', '<', now());
        }

        return $query->orderBy('start_at', 'desc');
    }

    public function scopeFilterByDate($query, $date)
    {
        if ($date != null && $date != '') {
            $query->whereDate('start_at', $date);
        }

        return $query;
    }

    public function scopeCategory($query, $categoryName, $studioSlug)
    {
        if ($categoryName != null && $categoryName != '') {
            $query->whereHas('category', function (Builder $query) use ($categoryName) {
                $query->where('slug', $categoryName);
            })->whereHas('studio', function (Builder $query) use ($studioSlug) {
                $query->where('slug', $studioSlug);
            });
        }

        return $query;
    }

    public function scopeInstructor($query, $instructor_slug)
    {
        if ($instructor_slug != null && $instructor_slug != '') {
            $query->whereHas('instructor_v2', function (Builder $query) use ($instructor_slug) {
                $query->where('slug', $instructor_slug);
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
