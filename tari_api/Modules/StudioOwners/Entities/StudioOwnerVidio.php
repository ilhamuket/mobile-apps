<?php

namespace Modules\StudioOwners\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudioOwnerVidio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];
    protected $table = 'studiovidios';

    protected static function newFactory()
    {
        return \Modules\StudioOwners\Database\factories\StudioOwnerVidioFactory::new();
    }

    public function studio()
    {
        return $this->belongsTo(OwnerStudio::class, 'studio_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
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

    public function scopeSummary($query, $summary, $studio_id)
    {
        if ($summary === 'all') {
            $query->where('studio_id', $studio_id);
        }
        if ($summary === 'publish') return $query->where([
            ['studio_id', $studio_id],
            ['status', 'publish']
        ]);
        if ($summary === 'new') return $query->where('studio_id', $studio_id)->whereDate('created_at', now());

        return $query;
    }
}