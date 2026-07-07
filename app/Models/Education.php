<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Education extends Model
{
    protected $table = 'educations';


    protected $fillable = [
        'applicant_profile_id',
        'institution',
        'degree',
        'major',
        'start_year',
        'end_year',
        'gpa',
    ];

    protected function casts(): array
    {
        return [
            'gpa' => 'decimal:2',
        ];
    }

    public function applicantProfile(): BelongsTo
    {
        return $this->belongsTo(ApplicantProfile::class);
    }
}
