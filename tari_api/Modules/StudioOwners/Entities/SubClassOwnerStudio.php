<?php

namespace Modules\StudioOwners\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubClassOwnerStudio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];
    protected $table = 'classes_schedule_studio';
    protected static function newFactory()
    {
        return \Modules\StudioOwners\Database\factories\SubClassOwnerStudioFactory::new();
    }
    public function classes()
    {
        return $this->belongsTo(ClassesOwnerStudio::class, 'class_id');
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

    public function getDurationAttribute()
    {
        $startTime = Carbon::parse('2020-02-11 04:04:26');
        $endTime = Carbon::parse('2020-02-11 04:36:56');

        $duration =  $startTime->diff($endTime)->format('%H:%I:%S') . " Minutes";
    }

    public function scopeSummary($query, $summary, $studio_id)
    {
        if ($summary == 'all') {
            $query
                ->where('studioClasses.studio_id', $studio_id);
        }
        if ($summary == 'approved') {
            $query
                ->where('studioClasses.studio_id', $studio_id)
                ->where('classes_schedule_studio.is_verified', 1);
        }
        if ($summary == 'non_approved') {
            $query
                ->where('studioClasses.studio_id', $studio_id)
                ->where('classes_schedule_studio.is_verified', 0);
        }
        if ($summary == 'new') {
            $query
                ->where('studioClasses.studio_id', $studio_id)
                ->whereDate('classes_schedule_studio.created_at', now());
        }
    }
}