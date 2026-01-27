<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use App\Models\Application;
use App\Models\StudentProfile;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        // Key Statistics
        $totalJobs = JobListing::where('is_active', true)->count();
        $totalStudents = StudentProfile::where('is_verified', true)->count();
        $totalApplications = Application::count();
        $acceptedApplications = Application::where('status', 'Accepted')->count();
        
        $applicationRate = $totalApplications > 0 ? round(($acceptedApplications / $totalApplications) * 100, 1) : 0;
        
        // Recent Applications (last 5)
        $recentApplications = Application::with(['student', 'job'])
            ->orderBy('applied_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function($app) {
                return [
                    'id' => (string)$app->_id,
                    'student_name' => $app->student?->name ?? 'Unknown',
                    'job_title' => $app->job?->title ?? 'Unknown',
                    'status' => $app->status,
                    'applied_at' => $app->applied_at->diffForHumans(),
                    'applied_at_full' => $app->applied_at->format('M d, Y'),
                ];
            });
        
        // Recent Jobs (last 5)
        $recentJobs = JobListing::where('is_active', true)
            ->orderBy('posted_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function($job) {
                return [
                    'id' => (string)$job->_id,
                    'title' => $job->title,
                    'company' => $job->company_name,
                    'location' => $job->location ?? 'Remote',
                    'posted_at' => $job->posted_at?->diffForHumans() ?? 'Recently',
                ];
            });
        
        // Applications by Status
        $applicationsByStatus = Application::raw(function($collection) {
            return $collection->aggregate([
                ['$group' => ['_id' => '$status', 'count' => ['$sum' => 1]]],
                ['$sort' => ['count' => -1]]
            ]);
        });
        
        $statusData = [];
        $statusColors = ['Applied' => '#3B82F6', 'Accepted' => '#10B981', 'Rejected' => '#EF4444'];
        foreach ($applicationsByStatus as $item) {
            $statusData[$item['_id']] = $item['count'];
        }
        
        // Jobs by Source
        $jobsBySource = JobListing::where('is_active', true)
            ->raw(function($collection) {
                return $collection->aggregate([
                    ['$group' => ['_id' => '$source', 'count' => ['$sum' => 1]]],
                    ['$sort' => ['count' => -1]],
                    ['$limit' => 5]
                ]);
            });
        
        $sourceData = [];
        foreach ($jobsBySource as $item) {
            $sourceData[$item['_id']] = $item['count'];
        }
        
        // Top Companies with most job listings
        $topCompanies = JobListing::where('is_active', true)
            ->raw(function($collection) {
                return $collection->aggregate([
                    ['$group' => ['_id' => '$company_name', 'count' => ['$sum' => 1]]],
                    ['$sort' => ['count' => -1]],
                    ['$limit' => 6]
                ]);
            });
        
        $companiesData = [];
        foreach ($topCompanies as $item) {
            if ($item['_id']) {
                $companiesData[] = [
                    'name' => $item['_id'],
                    'count' => $item['count']
                ];
            }
        }
        
        // Students by Branch
        $studentsByBranch = StudentProfile::where('is_verified', true)
            ->raw(function($collection) {
                return $collection->aggregate([
                    ['$group' => ['_id' => '$branch', 'count' => ['$sum' => 1]]],
                    ['$sort' => ['count' => -1]]
                ]);
            });
        
        $branchData = [];
        foreach ($studentsByBranch as $item) {
            if ($item['_id']) {
                $branchData[] = [
                    'name' => $item['_id'],
                    'count' => $item['count']
                ];
            }
        }
        
        // Verified vs Unverified
        $verifiedJobs = JobListing::where('is_verified', true)->where('is_active', true)->count();
        $unverifiedJobs = JobListing::where('is_verified', false)->where('is_active', true)->count();
        
        $verifiedStudents = StudentProfile::where('is_verified', true)->count();
        $unverifiedStudents = StudentProfile::where('is_verified', false)->count();

        return view('admin.dashboard', [
            'totalJobs' => $totalJobs,
            'totalStudents' => $totalStudents,
            'totalApplications' => $totalApplications,
            'acceptedApplications' => $acceptedApplications,
            'applicationRate' => $applicationRate,
            'recentApplications' => $recentApplications,
            'recentJobs' => $recentJobs,
            'applicationsByStatus' => json_encode($statusData),
            'jobsBySource' => json_encode($sourceData),
            'topCompanies' => $companiesData,
            'studentsByBranch' => $branchData,
            'verifiedJobs' => $verifiedJobs,
            'unverifiedJobs' => $unverifiedJobs,
            'verifiedStudents' => $verifiedStudents,
            'unverifiedStudents' => $unverifiedStudents,
        ]);
    }
}
