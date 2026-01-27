<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Student extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'students';
    
    // MongoDB uses _id by default, disable timestamps
    public $timestamps = false;
    protected $primaryKey = '_id';
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'university_id',
        'branch',
        'batch_year',
        'cgpa',
        'skills',
        'is_verified',
        'profile_complete',
        'resume_url',
        'phone',
        'ai_analysis',
        'ai_analysis_updated_at',
        'createdAt',
        'updatedAt',
    ];

    protected $casts = [
        'batch_year' => 'integer',
        'cgpa' => 'float',
        'is_verified' => 'boolean',
        'profile_complete' => 'boolean',
        'ai_analysis' => 'array',
        'ai_analysis_updated_at' => 'datetime',
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime',
    ];

    /**
     * Return a sanitized attribute value, coercing placeholder noise to the provided fallback.
     */
    public function clean(string $field, $fallback = null)
    {
        return $this->sanitizeValue($this->getAttribute($field), $fallback);
    }

    protected function sanitizeValue($value, $fallback = null)
    {
        if ($value === null) {
            return $fallback;
        }

        if (is_string($value)) {
            $trimmed = trim($value);
            if ($trimmed === '') {
                return $fallback;
            }

            $normalized = strtolower($trimmed);
            if (in_array($normalized, ['nan', 'na', 'n/a', 'n\\a', 'null', 'none', 'nil', 'undefined', '-', '--', '—'], true)) {
                return $fallback;
            }

            return $trimmed;
        }

        return $value;
    }
}

