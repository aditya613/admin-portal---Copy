<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class JobListing extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'jobs';
    
    // MongoDB uses _id by default, disable timestamps
    public $timestamps = false;
    protected $primaryKey = '_id';

    /**
     * Values that should be treated as empty placeholders in scraped data.
     */
    protected array $invalidPlaceholders = [
        'nan', 'na', 'n/a', 'n\\a', 'null', 'none', 'nil', 'undefined', '-', '--', '—'
    ];
    
    protected $fillable = [
        'title',
        'company_name',
        'location',
        'description',
        'short_description',
        'employment_type',
        'salary_range',
        'apply_url',
        'source',
        'is_verified',
        'is_active',
        'posted_at',
        'expires_at'
    ];

    protected $casts = [
        'posted_at' => 'datetime',
        'expires_at' => 'datetime',
        'is_verified' => 'boolean',
        'is_active' => 'boolean',
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
            if (in_array($normalized, $this->invalidPlaceholders, true)) {
                return $fallback;
            }

            return $trimmed;
        }

        return $value;
    }
}
