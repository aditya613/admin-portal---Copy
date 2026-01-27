<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_verifications', function (Blueprint $table) {
    $table->id();
    $table->foreignId('job_listing_id')->constrained()->cascadeOnDelete();
    $table->foreignId('verifier_id')->constrained('users');
    $table->text('notes')->nullable();
    $table->timestamp('verified_at')->nullable();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_verifications');
    }
};
