<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Application extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'applications';
    
    // MongoDB uses _id by default, disable timestamps
    public $timestamps = false;
    protected $primaryKey = '_id';
    
    protected $fillable = [
        'student_id',
        'job_id',
        'resume_snapshot_url',
        'status',
        'applied_at',
        'updated_at'
    ];

    protected $casts = [
        'student_id' => 'string',
        'job_id' => 'string',
        'applied_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the student who made this application
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', '_id');
    }

    /**
     * Get the job listing for this application
     */
    public function job()
    {
        return $this->belongsTo(JobListing::class, 'job_id', '_id');
    }

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

            return $trimmed;
        }

        return $value;
    }
}
