<?php

namespace Modules\Studio\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
}
