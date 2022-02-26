<?php

namespace Modules\Administrator\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Administrator\Database\factories\BankFactory::new();
    }

    // === scope === //

    public function scopeEntities($query, $entities)
    {
        if ($entities != null) {
            return $query->whereIn('id', $entities);
        }
    }

    public function scopeSummary($query, $summary)
    {
        if ($summary != null) {
            return $query->where('summary', $summary);
        }
    }
}
