<?php

namespace Modules\Studio\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\StudioOwners\Entities\FormRegister;

class CartClass extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Studio\Database\factories\CartClassFactory::new();
    }

    public function class()
    {
        return $this->belongsTo(StudioClass::class, 'class_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,  'user_id');
    }

    public function form()
    {
        return $this->hasOne(FormRegister::class, 'cart_id');
    }

    // === Scope === //

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

    public function scopeType($query, $type)
    {
        if ($type != null || $type != '') {
            $query->where('type', $type);
        }

        return $query;
    }

    public function scopeSummary($query, $status)
    {
        if ($status != null || $status != '') {
            $query->where("status", $status);
        }

        return $query;
    }
}
