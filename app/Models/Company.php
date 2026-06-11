<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'industry',
        'location',
        'website',
        'size',
        'description',
        'logo_path',
    ];

    // ─── Relationships ─────────────────────────────────────────────
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jobPostings(): HasMany
    {
        return $this->hasMany(JobPosting::class);
    }

    public function activeJobPostings(): HasMany
    {
        return $this->hasMany(JobPosting::class)->where('status', 'active');
    }
}
