<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SmkpIndicator extends Model
{
    protected $fillable = [
        'smkp_criteria_id',
        'indicator',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function criteria(): BelongsTo
    {
        return $this->belongsTo(SmkpCriteria::class, 'smkp_criteria_id');
    }
}