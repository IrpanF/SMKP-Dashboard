<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditAssessment extends Model
{
    protected $fillable = [
        'smkp_audit_id',
        'smkp_criteria_id',
        'score',
        'is_na',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'score' => 'integer',
            'is_na' => 'boolean',
        ];
    }

    public function audit(): BelongsTo
    {
        return $this->belongsTo(SmkpAudit::class, 'smkp_audit_id');
    }

    public function criteria(): BelongsTo
    {
        return $this->belongsTo(SmkpCriteria::class, 'smkp_criteria_id');
    }
}
