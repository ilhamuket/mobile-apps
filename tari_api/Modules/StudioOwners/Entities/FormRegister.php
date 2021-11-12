<?php

namespace Modules\StudioOwners\Entities;

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
}
