<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SmkpElement extends Model
{
    protected $fillable = [
        'code',
        'name',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function criteria(): HasMany
    {
        return $this->hasMany(SmkpCriteria::class, 'smkp_element_id')
            ->whereNull('parent_id');
    }
}
