<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('department')->nullable();
            $table->string('location');
            $table->enum('type', ['full-time', 'part-time', 'contract', 'internship', 'remote'])->default('full-time');
            $table->text('description');
            $table->text('requirements');
            $table->text('responsibilities')->nullable();
            $table->unsignedInteger('min_salary')->nullable();
            $table->unsignedInteger('max_salary')->nullable();
            $table->unsignedTinyInteger('experience_required')->default(0); // in years
            $table->enum('status', ['draft', 'active', 'closed'])->default('active');
            $table->date('deadline')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
