<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Student;
use App\Models\JobListing;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Show all applications (admin)
     */
    public function index(Request $request)
    {
        $query = Application::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('student', function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })->orWhereHas('job', function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%');
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by student
        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }

        // Sort
        $sortBy = $request->get('sort', 'applied_at');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $applications = $query->with(['student', 'job'])->paginate(15);
        
        // Get unique statuses for filter dropdown
        $statuses = Application::distinct('status')->pluck('status');
        
        // Get all students for filter
        $students = Student::select('_id', 'name')->get();

        return view('admin.applications.index', compact('applications', 'statuses', 'students'));
    }

    /**
     * Show application details
     */
    public function show($id)
    {
        $application = Application::with(['student', 'job'])->findOrFail($id);
        return view('admin.applications.show', compact('application'));
    }

    /**
     * Get application statistics
     */
    public function statistics()
    {
        $stats = [
            'total_applications' => Application::count(),
            'applied_applications' => Application::where('status', 'Applied')->count(),
            'accepted_applications' => Application::where('status', 'Accepted')->count(),
            'rejected_applications' => Application::where('status', 'Rejected')->count(),
            'applications_by_status' => Application::raw(function($collection) {
                return $collection->aggregate([
                    ['$group' => ['_id' => '$status', 'count' => ['$sum' => 1]]],
                    ['$sort' => ['count' => -1]]
                ]);
            }),
            'recent_applications' => Application::with(['student', 'job'])->orderBy('applied_at', 'desc')->limit(10)->get(),
        ];

        return response()->json($stats);
    }

    /**
     * Get applications for a specific student
     */
    public function studentApplications($studentId)
    {
        try {
            \Log::debug('Fetching applications for student', ['student_id' => $studentId]);
            
            // Convert string ID to MongoDB ObjectId for proper matching
            $applications = Application::where('student_id', new \MongoDB\BSON\ObjectId($studentId))
                ->with('job')
                ->orderBy('applied_at', 'desc')
                ->get();
            
            \Log::debug('Applications found for student', [
                'student_id' => $studentId,
                'count' => count($applications),
            ]);
            
            return response()->json($applications);
        } catch (\Exception $e) {
            \Log::error('Error fetching applications for student', [
                'student_id' => $studentId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get applications for a specific job
     */
    public function jobApplications($jobId)
    {
        $applications = Application::where('job_id', new \MongoDB\BSON\ObjectId($jobId))
            ->with('student')
            ->orderBy('applied_at', 'desc')
            ->get();
        
        return response()->json($applications);
    }
}
