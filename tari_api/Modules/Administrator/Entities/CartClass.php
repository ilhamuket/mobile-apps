<?php

namespace Modules\Administrator\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Studio\Entities\StudioClass;
use Modules\StudioOwners\Entities\FormRegister;

class CartClass extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Administrator\Database\factories\CartClassFactory::new();
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

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
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
        if ($summary == 'paid') return $query->Where('status', 'paid')->where('isPaid', true);
        if ($summary == 'waiting') return $query->where("status", 'waiting')->where("isPaid", false);
        if ($summary == 'new') return $query->whereDate("created_at", now());
        return $query;
    }
}
