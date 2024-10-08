<?php

namespace Modules\StudioOwners\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\StudioOwners\Database\factories\BankAccountFactory::new();
    }

    public function studio()
    {
        return $this->belongsTo(OwnerStudio::class, 'studio_id');
    }
}