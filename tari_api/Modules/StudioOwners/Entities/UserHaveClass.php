<?php

namespace Modules\StudioOwners\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Studio\Entities\CartClass;
use Modules\Studio\Entities\StudioClass;

class UserHaveClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\StudioOwners\Database\factories\UserHaveClassFactory::new();
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function classes()
    {
        return $this->belongsTo(ClassesOwnerStudio::class, 'class_id');
    }

    public function form()
    {
        return $this->belongsTo(FormRegister::class, 'form_id');
    }

    public function cart()
    {
        return $this->hasOne(CartClass::class, 'cart_id');
    }

    // ==== Scope ==== \\

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
        if ($summary == 'present') {
            $query->where('absent', true);
        } else if ($summary == 'miss_absent') {
            $query->where('absent', false);
        }

        return $query;
    }

    public function scopeSummaryStudioHasUser($query, $summary, $studio_id)
    {
        if ($summary == 'paid') {
            $query->whereHas("classes", function (Builder $query) use ($studio_id) {
                $query->where('studio_id', $studio_id);
            })->whereHas("form.cart", function (Builder $query) use ($summary) {
                $query->where('status', 'paid');
            });
        }
        if ($summary == 'pending') {
            $query->whereHas("classes", function (Builder $query) use ($studio_id) {
                $query->where('studio_id', $studio_id);
            })->whereHas("form.cart", function (Builder $query) use ($summary) {
                $query->where('status', 'pending');
            });
        }
        if ($summary == 'new') {
            $query->whereHas('classes', function (Builder $query) use ($studio_id) {
                $query->where('studio_id', $studio_id);
            })->whereDate('created_at', now());
        }

        return $query;
    }
}
