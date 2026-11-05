<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SmkpCriteriaRubric extends Model
{
    protected $table = 'smkp_criteria_rubrics';

    protected $fillable = [
        'smkp_criteria_id',
        'score_level',
        'description',
        'sort_order',
        'permit_type',
    ];

    public function criteria(): BelongsTo
    {
        return $this->belongsTo(
            SmkpCriteria::class,
            'smkp_criteria_id'
        );
    }
}
