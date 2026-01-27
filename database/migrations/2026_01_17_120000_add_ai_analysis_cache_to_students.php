<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * MongoDB is schema-less, so we don't need to explicitly add fields.
     * Fields will be created automatically when documents are first saved with them.
     * This migration just documents the schema change.
     */
    public function up(): void
    {
        // No action needed - MongoDB creates fields on first write
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No action needed - fields will remain for backwards compatibility
    }
};
