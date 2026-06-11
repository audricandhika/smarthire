<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_profile_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_posting_id')->constrained()->onDelete('cascade');
            $table->text('cover_letter')->nullable();
            $table->enum('status', ['pending', 'reviewing', 'interview', 'accepted', 'rejected'])->default('pending');
            $table->timestamp('applied_at')->useCurrent();
            $table->timestamps();

            $table->unique(['applicant_profile_id', 'job_posting_id']); // prevent duplicate applications
        });

        Schema::create('ai_analyses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('match_score')->default(0); // 0-100
            $table->json('strengths')->nullable();
            $table->json('weaknesses')->nullable();
            $table->text('summary')->nullable();
            $table->string('recommendation')->nullable(); // "Highly Recommended", "Recommended", "Not Recommended"
            $table->json('interview_questions')->nullable();
            $table->string('model_used')->nullable();
            $table->timestamp('analyzed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_analyses');
        Schema::dropIfExists('applications');
    }
};
