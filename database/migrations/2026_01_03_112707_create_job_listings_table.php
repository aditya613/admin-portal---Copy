<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_listings', function (Blueprint $table) {
    $table->id();
    $table->foreignId('company_id')->constrained();
    $table->foreignId('source_id')->constrained('job_sources');
    $table->string('title');
    $table->longText('description');
    $table->enum('employment_type', ['internship','full_time']);
    $table->decimal('min_cgpa', 3, 2)->nullable();
    $table->json('allowed_branches')->nullable();
    $table->string('apply_url');
    $table->timestamp('expires_at');
    $table->boolean('verified')->default(false);
    $table->boolean('active')->default(true);
    $table->timestamps();

    $table->index(['verified','active','expires_at']);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
