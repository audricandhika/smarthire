<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ApplicantProfile extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'date_of_birth',
        'current_position',
        'years_of_experience',
        'linkedin_url',
        'portfolio_url',
        'bio',
        'photo_path',
        'cv_path',
        'cv_parsed_data',
    ];

    protected function casts(): array
    {
        return [
            'cv_parsed_data' => 'array',
            'date_of_birth'  => 'date',
        ];
    }

    // ─── Relationships ─────────────────────────────────────────────
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }

    public function workExperiences(): HasMany
    {
        return $this->hasMany(WorkExperience::class)->orderByDesc('start_date');
    }

    public function educations(): HasMany
    {
        return $this->hasMany(Education::class)->orderByDesc('start_year');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    // ─── Helper ───────────────────────────────────────────────────
    public function hasCV(): bool
    {
        return ! is_null($this->cv_path);
    }

    public function isComplete(): bool
    {
        return ! is_null($this->phone)
            && ! is_null($this->current_position)
            && $this->skills()->exists()
            && $this->hasCV();
    }
}
