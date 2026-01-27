<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class StudentProfile extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'students';
    
    // MongoDB uses _id by default, disable timestamps
    public $timestamps = false;
    protected $primaryKey = '_id';
    
    protected $fillable = [
        'name',
        'email',
        'branch',
        'batch_year',
        'cgpa',
        'skills',
        'is_verified',
        'profile_complete'
    ];
    
    protected $casts = [
        'skills' => 'array',
        'is_verified' => 'boolean',
        'profile_complete' => 'boolean',
    ];
    
    /**
     * Get all applications for this student
     */
    public function applications()
    {
        return $this->hasMany(Application::class, 'student_id', '_id');
    }
}
