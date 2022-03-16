<?php

namespace Modules\Plan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Administrator\Entities\CartVideo;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Plan\Database\factories\SubscriptionFactory::new();
    }

    //=== Relation ===//
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function cart()
    {
        return $this->hasOne(CartVideo::class, 'subscription_id');
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
}
