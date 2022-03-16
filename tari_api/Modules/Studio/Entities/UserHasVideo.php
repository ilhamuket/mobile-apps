<?php

namespace Modules\Studio\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserHasVideo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Studio\Database\factories\UserHasVideoFactory::new();
    }

    public function video()
    {
        return $this->belongsTo(StudioClassVidios::class, 'video_id');
    }

    public function getStatusAttribute()
    {
        $status = '';

        if ($this->start_subscription != null && $this->end_subscription != null) {
            if ($this->start_subscription >= now()->toDateString() && $this->end_subscription >= now()->toDateString()) {
                return $status = 'active';
            } else if ($this->end_subscripton < now()->toDateString()) {
                return $status = 'non_active';
            }
        }

        return $status;
    }

    // === scopee === //

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
