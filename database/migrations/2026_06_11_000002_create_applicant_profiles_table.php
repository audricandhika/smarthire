<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applicant_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('current_position')->nullable();
            $table->unsignedTinyInteger('years_of_experience')->default(0);
            $table->string('linkedin_url')->nullable();
            $table->string('portfolio_url')->nullable();
            $table->text('bio')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('cv_path')->nullable();
            $table->json('cv_parsed_data')->nullable(); // parsed text & skills from PDF
            $table->timestamps();
        });

        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_profile_id')->constrained()->onDelete('cascade');
            $table->string('skill_name');
            $table->unsignedTinyInteger('proficiency_level')->default(3); // 1-5
            $table->timestamps();
        });

        Schema::create('work_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_profile_id')->constrained()->onDelete('cascade');
            $table->string('company');
            $table->string('position');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(false);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_profile_id')->constrained()->onDelete('cascade');
            $table->string('institution');
            $table->string('degree');
            $table->string('major')->nullable();
            $table->year('start_year');
            $table->year('end_year')->nullable();
            $table->decimal('gpa', 3, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('educations');
        Schema::dropIfExists('work_experiences');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('applicant_profiles');
    }
};
