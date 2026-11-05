<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Finding extends Model
{
    protected $fillable = [
        'smkp_audit_id',
        'finding_criteria',
        'finding_category',
        'status',
        'form_no',
        'audit_date',
        'revision',
        'finding_no',
        'page',
        'location_name',
        'auditee_user_id',
        'standard',

        // PLOR
        'problem',
        'area_temuan',
        'description',
        'matriks',
        'evidence_files',
        'evidence_captions',

        // RTL
        'rtl_response',
        'rtl_files',
        'auditee',
        'action_days',
        'root_cause',
        'function_name',
        'rtl_file_captions',

        // Verifikasi
        'verified_detail',
        'verified_date',
    ];

    protected function casts(): array
    {
        return [
            'audit_date' => 'date',
            'verified_date' => 'date',
            'page' => 'integer',
            'action_days' => 'integer',
            'evidence_files' => 'array',
            'evidence_captions' => 'array',
            'rtl_files' => 'array',
            'rtl_file_captions' => 'array',
        ];
    }

    public function audit(): BelongsTo
    {
        return $this->belongsTo(
            SmkpAudit::class,
            'smkp_audit_id'
        );
    }

    public function assignedAuditee(): BelongsTo
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'auditee_user_id'
        );
    }
}
