<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiAnalysis extends Model
{
    protected $fillable = [
        'application_id',
        'match_score',
        'strengths',
        'weaknesses',
        'summary',
        'recommendation',
        'interview_questions',
        'model_used',
        'analyzed_at',
    ];

    protected function casts(): array
    {
        return [
            'strengths'           => 'array',
            'weaknesses'          => 'array',
            'interview_questions' => 'array',
            'analyzed_at'         => 'datetime',
        ];
    }

    // ─── Relationships ─────────────────────────────────────────────
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    // ─── Helpers ──────────────────────────────────────────────────
    public function scoreLabel(): string
    {
        return match (true) {
            $this->match_score >= 80 => 'Excellent',
            $this->match_score >= 60 => 'Good',
            $this->match_score >= 40 => 'Fair',
            default                  => 'Poor',
        };
    }

    public function scoreColor(): string
    {
        return match (true) {
            $this->match_score >= 80 => 'green',
            $this->match_score >= 60 => 'blue',
            $this->match_score >= 40 => 'yellow',
            default                  => 'red',
        };
    }
}
