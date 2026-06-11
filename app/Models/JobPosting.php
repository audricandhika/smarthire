<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobPosting extends Model
{
    protected $fillable = [
        'company_id',
        'title',
        'department',
        'location',
        'type',
        'description',
        'requirements',
        'responsibilities',
        'min_salary',
        'max_salary',
        'experience_required',
        'status',
        'deadline',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'date',
        ];
    }

    // ─── Relationships ─────────────────────────────────────────────
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    // ─── Helpers ──────────────────────────────────────────────────
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function salaryRange(): string
    {
        if (! $this->min_salary && ! $this->max_salary) {
            return 'Negotiable';
        }

        $format = fn ($n) => 'Rp ' . number_format($n, 0, ',', '.');

        if ($this->min_salary && $this->max_salary) {
            return $format($this->min_salary) . ' – ' . $format($this->max_salary);
        }

        return $this->min_salary
            ? 'From ' . $format($this->min_salary)
            : 'Up to ' . $format($this->max_salary);
    }
}
