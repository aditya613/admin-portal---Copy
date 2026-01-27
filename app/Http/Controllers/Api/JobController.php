<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Fetch verified & active jobs for students
     */
    public function index()
    {
        $jobs = JobListing::with('company')
            ->where('verified', true)
            ->where('active', true)
            ->whereDate('expires_at', '>=', now())
            ->latest()
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $jobs
        ]);
    }
}
