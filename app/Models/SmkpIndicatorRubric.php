<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SmkpIndicatorRubric extends Model
{
    protected $table = 'smkp_indicator_rubrics';

    protected $fillable = [
        'smkp_indicator_id',
        'score_level',
        'description',
        'sort_order',
    ];

    public function indicator(): BelongsTo
    {
        return $this->belongsTo(
            SmkpIndicator::class,
            'smkp_indicator_id'
        );
    }
}
