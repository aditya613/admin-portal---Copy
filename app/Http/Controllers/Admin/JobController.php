<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Show all jobs (admin)
     */
    public function index(Request $request)
    {
        $query = JobListing::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('company_name', 'like', '%' . $search . '%')
                  ->orWhere('location', 'like', '%' . $search . '%');
            });
        }

        // Filter by source
        if ($request->filled('source')) {
            $query->where('source', $request->source);
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Sort
        $sortBy = $request->get('sort', 'posted_at');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $jobs = $query->paginate(15);
        
        // Get unique sources for filter dropdown - using raw query for MongoDB distinct
        $sources = JobListing::raw(function($collection) {
            return $collection->distinct('source');
        });
        sort($sources); // Sort alphabetically
        
        // Get unique locations for filter dropdown
        $locations = JobListing::raw(function($collection) {
            return $collection->distinct('location');
        });
        sort($locations);

        return view('admin.jobs.index', compact('jobs', 'sources', 'locations'));
    }

    /**
     * Show job details
     */
    public function show($id)
    {
        $job = JobListing::findOrFail($id);
        return view('admin.jobs.show', compact('job'));
    }

    /**
     * Get job statistics
     */
    public function statistics()
    {
        $stats = [
            'total_jobs' => JobListing::count(),
            'active_jobs' => JobListing::where('is_active', true)->count(),
            'verified_jobs' => JobListing::where('is_verified', true)->count(),
            'jobs_by_source' => JobListing::raw(function($collection) {
                return $collection->aggregate([
                    ['$group' => ['_id' => '$source', 'count' => ['$sum' => 1]]],
                    ['$sort' => ['count' => -1]]
                ]);
            }),
            'recent_jobs' => JobListing::orderBy('posted_at', 'desc')->limit(5)->get(),
        ];

        return response()->json($stats);
    }

    /**
     * Update job verification status
     */
    public function updateVerificationStatus($id)
    {
        $job = JobListing::findOrFail($id);
        $job->is_verified = !$job->is_verified;
        $job->save();

        return response()->json([
            'success' => true,
            'message' => 'Job verification status updated',
            'is_verified' => $job->is_verified
        ]);
    }

    /**
     * Delete job listing
     */
    public function destroy($id)
    {
        $job = JobListing::findOrFail($id);
        $jobTitle = $job->title;
        $job->delete();

        return response()->json([
            'success' => true,
            'message' => "Job listing '$jobTitle' has been deleted successfully."
        ]);
    }
}
