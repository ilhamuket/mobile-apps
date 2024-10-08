<?php

namespace Modules\StudioOwners\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Studio\Entities\Studio;

class StudioTeacher extends Model
{
    use HasFactory, SoftDeletes;

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
    public function img()
    {
        return $this->hasOne(ImgInstructor::class, 'instructor_id');
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

    public function scopeSummary($query, $summary, $studio)
    {
        // dd($studio->id);
        if ($summary == 'all') {
            $query->where('studio_id', $studio->id);
        }
        if ($summary == 'approved') {
            $query->where([
                ['studio_id', $studio->id],
                ['is_verified', 1]
            ]);
        }
        if ($summary == 'non_approved') {
            $query->where([
                ['studio_id', $studio->id],
                ['is_verified', 0]
            ]);
        }
        if ($summary == 'new') {
            $query->where([
                ['studio_id', $studio->id],
            ])->whereDate('created_at', now());
        }

        return $query;
    }
    public function scopeSlug($query, $name)
    {
        if ($name != null || $name != '') {
            $query->where('slug', $name);
        }

        return $name;
    }

    public function geturlIgAttribute()
    {
        if ($this->attributes['username_ig'] != null) {
            return  'https://www.instagram.com/' . $this->attributes['username_ig'];
        } else {
            return $this->attributes['username_ig'];
        }
    }
    public function getUrlFbAttribute()
    {
        if ($this->attributes['username_fb'] != null) {
            return  'https://www.facebook.com/' . $this->attributes['username_fb'];
        } else {
            return $this->attributes['username_fb'];
        }
    }
    public function getUrlTwAttribute()
    {
        if ($this->attributes['username_tw'] != null) {
            return  'https://www.twitter.com/' . $this->attributes['username_tw'];
        } else {
            return $this->attributes['username_tw'];
        }
    }
}
