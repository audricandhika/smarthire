<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skill extends Model
{
    protected $fillable = [
        'applicant_profile_id',
        'skill_name',
        'proficiency_level',
    ];

    public function applicantProfile(): BelongsTo
    {
        return $this->belongsTo(ApplicantProfile::class);
    }
}
