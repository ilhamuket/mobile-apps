<?php

namespace Modules\Payment\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Administrator\Entities\CartClass;
use Modules\Studio\Entities\StudioClass;
use Modules\Studio\Entities\StudioVidio;
use Modules\StudioOwners\Entities\CartVideo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Payment\Database\factories\PaymentFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function class()
    {
        return $this->belongsTo(StudioClass::class, 'class_id');
    }

    public function video()
    {
        return $this->belongsTo(StudioVidio::class, 'video_id');
    }

    public function cart()
    {
        return $this->belongsTo(CartClass::class, 'cart_class_id');
    }

    public function cartVideo()
    {
        return $this->belongsTo(CartVideo::class, 'cart_video_id');
    }

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
        if ($summary != null && $summary != '' && $summary != 'new') return $query->where('status', $summary);
        if ($summary == 'new') return $query->whereDate('created_at', now());
        return $query;
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
