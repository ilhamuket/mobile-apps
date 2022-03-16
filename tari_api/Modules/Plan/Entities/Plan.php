<?php

namespace Modules\Plan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Plan\Database\factories\PlanFactory::new();
    }

    // === Relation === //
    public function subscription()
    {
        return $this->hasMany(Subscription::class, 'plan_id');
    }
    // === scope === //
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

    public function scopeSummary($query, $summary)
    {
        if ($summary != null || $summary != '') {
            $query->where('status', $summary);
        } else return $query;
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

    public function scopeActive($query, $status)
    {
        if ($status === 'active') {
            return $query->where('status', 'active');
        } elseif ($status === 'inactive') {
            return $query->where('status', 'inactive');
        } else {
            return $query;
        }
    }
}
