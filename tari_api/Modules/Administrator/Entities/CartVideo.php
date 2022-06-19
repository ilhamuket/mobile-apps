<?php

namespace Modules\Administrator\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Plan\Entities\Subscription;
use Modules\Studio\Entities\FormRegisterEnsiklovideo;
use Modules\StudioOwners\Entities\StudioClassVidio;

class CartVideo extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Administrator\Database\factories\CartVideoFactory::new();
    }

    // === Relation ===//
    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }
    public function form()
    {
        return $this->hasOne(FormRegisterEnsiklovideo::class, 'cart_video_id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function video()
    {
        return $this->belongsTo(StudioClassVidio::class, 'video_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,  'user_id');
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
            $query = $query->orderBy('updated_at', 'desc');
        }
        return $query;
    }

    public function scopeSummary($query, $summary)
    {
        if ($summary != '' || $summary != null) {
            $query->where('status', $summary);
        }

        return $query;
    }

    // === getters === //

    public function getImageUrlAttribute()
    {
        if ($this->attributes['image_url'] != null) {
            return  env('IMAGE_URL', ' http://127.0.0.1:8000/app/') . $this->attributes['image_url'];
            // return env('IMAGE_URL', ' https://api.ensiklotari.com/app/') . $this->attributes['image_url'];
        } else {
            return $this->attributes['image_url'];
        }
    }
}
