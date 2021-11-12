<?php

namespace Modules\StudioOwners\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Studio\Entities\CartClass;

class FormRegister extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];
    protected $table = 'form-registers';

    protected static function newFactory()
    {
        return \Modules\StudioOwners\Database\factories\FormRegisterFactory::new();
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function class()
    {
        return $this->belongsTo(ClassesOwnerStudio::class, 'class_id');
    }

    public function cart()
    {
        return $this->belongsTo(CartClass::class, 'cart_id');
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
