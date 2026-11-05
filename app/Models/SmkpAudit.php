<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SmkpAudit extends Model
{
    protected $fillable = [
        'title',
        'audit_date',
        'audit_start_date',
        'audit_end_date',
        'auditor_id',
        'status',
        'completed_at',
        'site_id',
    ];

    protected function casts(): array
    {
        return [
            'audit_date' => 'date',
            'audit_start_date' => 'date',
            'audit_end_date' => 'date',
            'completed_at' => 'datetime',
        ];
    }

    public function auditor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'auditor_id');
    }

    public function assessments(): HasMany
    {
        return $this->hasMany(AuditAssessment::class, 'smkp_audit_id');
    }

    public function findings(): HasMany
    {
        return $this->hasMany(Finding::class, 'smkp_audit_id');
    }

    public function site()
    {
        return $this->belongsTo(\App\Models\Site::class, 'site_id');
    }
}
