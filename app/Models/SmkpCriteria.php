<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SmkpCriteria extends Model
{
    protected $table = 'smkp_criteria';

    protected $fillable = [
        'smkp_element_id',
        'parent_id',
        'code',
        'name',
        'description',
        'sort_order',
        'is_active',
        'max_score',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function element(): BelongsTo
    {
        return $this->belongsTo(SmkpElement::class, 'smkp_element_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(SmkpCriteria::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(SmkpCriteria::class, 'parent_id');
    }

    public function indicators(): HasMany
    {
        return $this->hasMany(SmkpIndicator::class);
    }

    public function auditAssessments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AuditAssessment::class, 'smkp_criteria_id');
    }

    public function rubrics(): HasMany
    {
        return $this->hasMany(
            SmkpCriteriaRubric::class,
            'smkp_criteria_id'
        )->orderBy('sort_order');
    }
}
