<?php

namespace Modules\Studio\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Administrator\Entities\Bank;
use Modules\Plan\Entities\Subscription;
use Modules\StudioOwners\Entities\StudioClassVidio;

class CartVideo extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Studio\Database\factories\CartVideoFactory::new();
    }

    public function video()
    {
        return $this->belongsTo(StudioClassVidio::class, 'video_id');
    }

    public function form()
    {
        return $this->hasOne(FormRegisterEnsiklovideo::class, 'cart_video_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,  'user_id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
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

    public function getImageUrlAttribute()
    {
        if ($this->attributes['image_url'] != null) {
            return  env('IMAGE_URL', ' http://127.0.0.1:8000/app/') . $this->attributes['image_url'];
            // return env('IMAGE_URL', ' https://api.ensiklotari.com/app/') . $this->attributes['url'];
        } else {
            return $this->attributes['image_url'];
        }
    }
}
