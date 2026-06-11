<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Application extends Model
{
    protected $fillable = [
        'applicant_profile_id',
        'job_posting_id',
        'cover_letter',
        'status',
        'applied_at',
    ];

    protected function casts(): array
    {
        return [
            'applied_at' => 'datetime',
        ];
    }

    // ─── Relationships ─────────────────────────────────────────────
    public function applicantProfile(): BelongsTo
    {
        return $this->belongsTo(ApplicantProfile::class);
    }

    public function jobPosting(): BelongsTo
    {
        return $this->belongsTo(JobPosting::class);
    }

    public function aiAnalysis(): HasOne
    {
        return $this->hasOne(AiAnalysis::class);
    }

    // ─── Helpers ──────────────────────────────────────────────────
    public function statusLabel(): string
    {
        return match ($this->status) {
            'pending'   => 'Pending Review',
            'reviewing' => 'Under Review',
            'interview' => 'Interview Stage',
            'accepted'  => 'Accepted',
            'rejected'  => 'Rejected',
            default     => ucfirst($this->status),
        };
    }

    public function statusColor(): string
    {
        return match ($this->status) {
            'pending'   => 'yellow',
            'reviewing' => 'blue',
            'interview' => 'purple',
            'accepted'  => 'green',
            'rejected'  => 'red',
            default     => 'gray',
        };
    }
}
