<?php

namespace Modules\StudioOwners\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubClassOwnerStudio extends Model
{
    use HasFactory;

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
}