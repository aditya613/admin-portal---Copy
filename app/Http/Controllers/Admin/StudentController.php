<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    /**
     * Display all students (admin)
     */
    public function index(Request $request)
    {
        $query = Student::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('university_id', 'like', '%' . $search . '%')
                  ->orWhere('branch', 'like', '%' . $search . '%');
            });
        }

        // Filter by branch
        if ($request->filled('branch')) {
            $query->where('branch', $request->branch);
        }

        // Filter by batch year
        if ($request->filled('batch_year')) {
            $query->where('batch_year', (int)$request->batch_year);
        }

        // Filter by verification status
        if ($request->filled('is_verified')) {
            $query->where('is_verified', $request->is_verified === 'true');
        }

        // Filter by profile completion
        if ($request->filled('profile_complete')) {
            $query->where('profile_complete', $request->profile_complete === 'true');
        }

        // Sort
        $sortBy = $request->get('sort', 'createdAt');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $students = $query->paginate(15);
        
        // Get unique branches for filter dropdown
        $branches = Student::distinct('branch')->pluck('branch');
        
        // Get unique batch years
        $batchYears = Student::distinct('batch_year')->orderBy('batch_year', 'desc')->pluck('batch_year');

        return view('admin.students.index', compact('students', 'branches', 'batchYears'));
    }

    /**
     * Show student details
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.students.show', compact('student'));
    }

    /**
     * Get student statistics
     */
    public function statistics()
    {
        $stats = [
            'total_students' => Student::count(),
            'verified_students' => Student::where('is_verified', true)->count(),
            'profile_complete' => Student::where('profile_complete', true)->count(),
            'by_branch' => Student::raw(function($collection) {
                return $collection->aggregate([
                    ['$group' => ['_id' => '$branch', 'count' => ['$sum' => 1]]],
                    ['$sort' => ['count' => -1]]
                ]);
            }),
            'by_batch' => Student::raw(function($collection) {
                return $collection->aggregate([
                    ['$group' => ['_id' => '$batch_year', 'count' => ['$sum' => 1]]],
                    ['$sort' => ['_id' => -1]]
                ]);
            }),
        ];

        return response()->json($stats);
    }

    /**
     * Analyze student resume using external AI API
     */
    public function analyzeResume(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'cloudinary_url' => 'required|url'
        ]);

        try {
            $studentId = $request->student_id;
            
            // Get the student
            $student = Student::find(new \MongoDB\BSON\ObjectId($studentId));
            if (!$student) {
                return response()->json([
                    'success' => false,
                    'error' => 'Student not found.',
                    'data' => null
                ], 404);
            }

            // Check if we have cached analysis data (cache for 7 days)
            $cacheThreshold = now()->subDays(7);
            if ($student->ai_analysis && $student->ai_analysis_updated_at && $student->ai_analysis_updated_at->isAfter($cacheThreshold)) {
                Log::info('Returning cached resume analysis for student', [
                    'student_id' => $studentId,
                    'cached_at' => $student->ai_analysis_updated_at
                ]);

                return response()->json([
                    'success' => true,
                    'student_id' => $studentId,
                    'data' => $student->ai_analysis,
                    'cached' => true,
                    'cached_at' => $student->ai_analysis_updated_at
                ]);
            }

            Log::info('Analyzing resume for student', [
                'student_id' => $studentId,
                'cloudinary_url' => $request->cloudinary_url
            ]);

            // Call external AI analysis API
            $response = Http::timeout(60)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])
                ->post('https://resume-mp10.onrender.com', [
                    'student_id' => $studentId,
                    'cloudinary_url' => $request->cloudinary_url
                ]);

            if ($response->successful()) {
                $data = $response->json();
                
                // Log the response structure for debugging
                Log::info('Resume analysis response', [
                    'student_id' => $studentId,
                    'success' => $data['success'] ?? false,
                    'has_data' => isset($data['data'])
                ]);

                // If successful, cache the analysis data
                if ($data['success'] ?? false) {
                    $student->ai_analysis = $data['data'] ?? null;
                    $student->ai_analysis_updated_at = now();
                    $student->save();
                    
                    Log::info('Cached resume analysis for student', [
                        'student_id' => $studentId
                    ]);
                }

                // Return the complete response as-is (includes success, data, error fields)
                return response()->json($data);
            }

            Log::error('Resume analysis failed', [
                'student_id' => $studentId,
                'status' => $response->status(),
                'response' => $response->body()
            ]);

            return response()->json([
                'success' => false,
                'error' => 'The resume analysis service returned an error. Please try again later.',
                'data' => null
            ], $response->status());

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Resume analysis connection error', [
                'student_id' => $request->student_id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Unable to connect to the resume analysis service. Please check your internet connection and try again.',
                'data' => null
            ], 503);

        } catch (\Illuminate\Http\Client\RequestException $e) {
            Log::error('Resume analysis request error', [
                'student_id' => $request->student_id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'error' => 'The resume analysis request failed. Please try again.',
                'data' => null
            ], 500);

        } catch (\Exception $e) {
            Log::error('Resume analysis unexpected error', [
                'student_id' => $request->student_id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'error' => config('app.debug') ? $e->getMessage() : 'An unexpected error occurred during resume analysis.',
                'data' => null
            ], 500);
        }
    }

    /**
     * Proxy endpoint to serve resume PDF
     */
    public function getResume($studentId)
    {
        try {
            $student = Student::findOrFail($studentId);
            
            if (!$student->resume_url) {
                return response()->json([
                    'success' => false,
                    'error' => 'No resume URL found for this student'
                ], 404);
            }

            // Fetch the resume from the external URL
            $response = Http::timeout(30)
                ->get($student->resume_url);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Unable to fetch resume from the source'
                ], 502);
            }

            // Return the PDF with appropriate headers
            return response()->stream(function() use ($response) {
                echo $response->body();
            }, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="resume.pdf"',
                'Cache-Control' => 'max-age=3600, public'
            ]);

        } catch (\Exception $e) {
            Log::error('Resume fetch error', [
                'student_id' => $studentId,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Error retrieving resume'
            ], 500);
        }
    }
}
