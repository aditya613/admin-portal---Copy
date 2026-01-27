@extends('admin.layout')

@section('title', $student->clean('name', 'Student Details'))

@section('content')
<!-- Back Button -->
<div class="mb-6">
    <a href="{{ route('admin.students.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-600 hover:text-primary-600 transition-colors group">
        <svg class="mr-2 h-5 w-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Students
    </a>
</div>

<!-- Student Profile Header -->
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
    <!-- Profile Banner -->
    <div class="relative h-32 bg-gradient-to-r from-primary-600 via-primary-500 to-blue-600"></div>
    
    <!-- Profile Info -->
    <div class="px-8 pb-6">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between -mt-16 mb-6">
            <div class="flex items-end gap-5">
                <!-- Avatar -->
                <div class="relative">
                    <div class="h-32 w-32 rounded-2xl bg-white ring-4 ring-white shadow-lg flex items-center justify-center">
                        <div class="h-28 w-28 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white font-bold text-4xl">
                            {{ substr($student->clean('name', 'S'), 0, 1) }}
                        </div>
                    </div>
                    @if($student->is_verified)
                        <div class="absolute -bottom-2 -right-2 h-10 w-10 rounded-full bg-blue-500 ring-4 ring-white flex items-center justify-center">
                            <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    @endif
                </div>
                
                <!-- Name & Basic Info -->
                <div class="mb-2">
                    <h1 class="text-3xl font-bold text-slate-900 mb-1">{{ $student->clean('name', 'Unknown Student') }}</h1>
                    <div class="flex flex-wrap items-center gap-3 text-sm text-slate-600">
                      
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            B.Tech {{ $student->clean('branch', 'Computer Science') }}
                        </span>
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Class of {{ $student->batch_year ?? '2024' }}
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex items-center gap-3 mt-4 md:mt-0">
                <!-- Email Card -->
                <div class="flex items-center gap-2 px-4 py-2.5 rounded-lg bg-slate-50 border-2 border-slate-200">
                    <svg class="h-5 w-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <div class="flex flex-col">
                        <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Email</span>
                        <span class="text-sm font-semibold text-slate-900">{{ $student->clean('email', 'N/A') }}</span>
                    </div>
                </div>
                
                <!-- Phone Card -->
                <div class="flex items-center gap-2 px-4 py-2.5 rounded-lg bg-slate-50 border-2 border-slate-200">
                    <svg class="h-5 w-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <div class="flex flex-col">
                        <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Phone</span>
                        <span class="text-sm font-semibold text-slate-900">{{ $student->clean('phone', 'N/A') }}</span>
                    </div>
                </div>
                
                <!-- Resume Preview Button -->
                @if($student->resume_url)
                    <button onclick="openResumePreview()" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-primary-600 text-white font-semibold hover:bg-primary-700 shadow-lg shadow-primary-500/30 transition-all">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        View Resume
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column: CGPA & Skills -->
    <div class="space-y-6">
        <!-- CGPA Card -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider">CGPA / GPA</h3>
                <span class="text-xs font-semibold text-slate-400">Out of 10.0</span>
            </div>
            <div class="flex items-baseline gap-2 mb-4">
                <p class="text-5xl font-bold text-slate-900">{{ number_format($student->cgpa ?? 0, 1) }}</p>
                <p class="text-2xl font-semibold text-slate-400">/ 10.0</p>
            </div>
            <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                <div class="h-full bg-gradient-to-r from-primary-500 to-primary-600 rounded-full transition-all duration-1000" 
                     style="width: {{ (($student->cgpa ?? 0) / 10) * 100 }}%"></div>
            </div>
        </div>

        <!-- Technical Skills Card -->
        <div id="skills-card" class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Technical Skills</h3>
            <div id="skills-loading" class="text-center py-8">
                <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-primary-600 border-r-transparent"></div>
                <p class="text-sm text-slate-500 mt-3">Analyzing resume...</p>
            </div>
            <div id="skills-content" class="hidden">
                <!-- Skills will be dynamically loaded -->
            </div>
        </div>

        <!-- Academic Details -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Academic Details</h3>
            <div class="space-y-4">
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">University ID</p>
                    <p class="text-base font-mono font-semibold text-slate-900">{{ $student->clean('university_id', 'Not provided') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Email Address</p>
                    <p class="text-base text-slate-900">{{ $student->clean('email', 'Not provided') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Branch</p>
                    <p class="text-base font-semibold text-slate-900">{{ $student->clean('branch', 'Not specified') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Batch Year</p>
                    <p class="text-base font-semibold text-slate-900">{{ $student->batch_year ?? 'Not specified' }}</p>
                </div>
            </div>
        </div>

        <!-- Account Status -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Account Status</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 rounded-lg {{ $student->is_verified ? 'bg-green-50 border border-green-200' : 'bg-yellow-50 border border-yellow-200' }}">
                    <div class="flex items-center gap-3">
                        @if($student->is_verified)
                            <svg class="h-5 w-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        @else
                            <svg class="h-5 w-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-11a1 1 0 112 0v4a1 1 0 11-2 0V7zm1 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                            </svg>
                        @endif
                        <div>
                            <p class="text-sm font-semibold {{ $student->is_verified ? 'text-green-900' : 'text-yellow-900' }}">
                                {{ $student->is_verified ? 'Verified Account' : 'Pending Verification' }}
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center justify-between p-3 rounded-lg {{ $student->profile_complete ? 'bg-blue-50 border border-blue-200' : 'bg-slate-50 border border-slate-200' }}">
                    <div class="flex items-center gap-3">
                        @if($student->profile_complete)
                            <svg class="h-5 w-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        @else
                            <svg class="h-5 w-5 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        @endif
                        <div>
                            <p class="text-sm font-semibold {{ $student->profile_complete ? 'text-blue-900' : 'text-slate-700' }}">
                                {{ $student->profile_complete ? 'Profile Complete' : 'Incomplete Profile' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Resume Analysis & Applications -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Resume Analysis Card -->
        <div id="resume-analysis" class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-primary-600 to-blue-600 px-6 py-4">
                <h3 class="text-xl font-bold text-white flex items-center gap-2">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                    AI Resume Analysis
                </h3>
            </div>
            
            <div id="analysis-loading" class="p-8 text-center">
                <div class="inline-block h-12 w-12 animate-spin rounded-full border-4 border-solid border-primary-600 border-r-transparent mb-4"></div>
                <p class="text-lg font-semibold text-slate-900 mb-2">Analyzing Resume with AI</p>
                <p class="text-sm text-slate-500">Extracting skills, evaluating experience, and generating recommendations...</p>
            </div>
            
            <div id="analysis-content" class="hidden p-6">
                <!-- Resume Score -->
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-sm font-bold text-slate-700 uppercase tracking-wider">Overall Resume Score</h4>
                        <span id="score-value" class="text-3xl font-bold text-primary-600">--</span>
                    </div>
                    <div class="relative h-4 bg-slate-100 rounded-full overflow-hidden">
                        <div id="score-bar" class="absolute inset-y-0 left-0 bg-gradient-to-r from-primary-500 to-primary-600 rounded-full transition-all duration-1000" style="width: 0%"></div>
                    </div>
                </div>
                
                <!-- Career Insights Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <!-- Predicted Level -->
                    <div class="p-4 rounded-xl border-2 border-blue-200 bg-blue-50">
                        <p class="text-xs font-semibold text-blue-700 uppercase tracking-wider mb-1.5">Career Level</p>
                        <p id="predicted-level" class="text-lg font-bold text-blue-900">--</p>
                    </div>
                    
                    <!-- Recommended Field -->
                    <div class="p-4 rounded-xl border-2 border-emerald-200 bg-emerald-50">
                        <p class="text-xs font-semibold text-emerald-700 uppercase tracking-wider mb-1.5">Best Fit Role</p>
                        <p id="recommended-field" class="text-lg font-bold text-emerald-900">--</p>
                    </div>
                </div>
                
                <!-- Extracted Skills from Resume -->
                <div class="mb-6">
                    <h4 class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-3">Skills Found in Resume</h4>
                    <div id="extracted-skills" class="flex flex-wrap gap-2">
                        <!-- Dynamically loaded -->
                    </div>
                </div>
                
                <!-- Skill Gap Analysis -->
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-sm font-bold text-slate-700 uppercase tracking-wider">Recommended Skills to Learn</h4>
                        <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2.5 py-1 rounded-full">Skill Gap</span>
                    </div>
                    <div id="recommended-skills" class="flex flex-wrap gap-2">
                        <!-- Dynamically loaded -->
                    </div>
                </div>
            </div>
            
            <div id="analysis-error" class="hidden p-8 text-center">
                <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                    <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-lg font-semibold text-slate-900 mb-2">Analysis Failed</p>
                <p class="text-sm text-slate-500">Unable to analyze resume. Please ensure a valid resume URL is provided.</p>
            </div>
        </div>

        <!-- Applications Section -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                <h3 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                    <svg class="h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Job Applications
                    <span id="app-count-badge" class="ml-auto text-sm font-bold text-white bg-primary-600 px-3 py-1 rounded-full">0</span>
                </h3>
            </div>
            
            <div id="applications-loading" class="p-8 text-center">
                <div class="inline-block h-10 w-10 animate-spin rounded-full border-4 border-solid border-primary-600 border-r-transparent"></div>
                <p class="text-sm text-slate-500 mt-3">Loading applications...</p>
            </div>
            
            <div id="applications-content" class="hidden divide-y divide-slate-200">
                <!-- Dynamically loaded applications -->
            </div>
            
            <div id="applications-empty" class="hidden p-12 text-center">
                <div class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-slate-100 mb-4">
                    <svg class="h-10 w-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <p class="text-lg font-semibold text-slate-900 mb-2">No Applications Yet</p>
                <p class="text-sm text-slate-500">This student hasn't applied to any jobs yet.</p>
            </div>
        </div>
    </div>
</div>

<!-- Scripts for Resume Analysis -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const studentId = "{{ $student->_id }}";
    const resumeUrl = "{{ $student->resume_url ?? '' }}";
    
    console.log('=== PAGE LOADED ===');
    console.log('Student ID:', studentId);
    console.log('Resume URL:', resumeUrl);
    console.log('Applications fetch URL:', `/admin/api/applications/student/${studentId}`);
    // Fetch Resume Analysis
    if (resumeUrl) {
        fetch('/admin/api/analyze-resume', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                student_id: studentId,
                cloudinary_url: resumeUrl
            })
        })
        .then(response => response.json())
        .then(response => {
            // Check if the API call was successful
            if (!response.success || !response.data) {
                throw new Error(response.error || 'Analysis failed');
            }
            
            const data = response.data;
            const isCached = response.cached === true;
            
            console.log('Analysis data received:', { success: response.success, cached: isCached, data: data });
            
            // Hide loading, show content
            document.getElementById('analysis-loading').classList.add('hidden');
            document.getElementById('analysis-content').classList.remove('hidden');
            
            // Show cached indicator if data is from cache
            if (isCached) {
                const cachedBadge = document.createElement('div');
                cachedBadge.className = 'mb-4 inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-blue-50 border border-blue-200';
                cachedBadge.innerHTML = `
                    <svg class="h-4 w-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-xs font-semibold text-blue-700">Cached Analysis</span>
                `;
                document.getElementById('analysis-content').insertBefore(cachedBadge, document.getElementById('analysis-content').firstChild);
            }
            
            // Populate Resume Score
            document.getElementById('score-value').textContent = data.resume_score || '0';
            document.getElementById('score-bar').style.width = (data.resume_score || 0) + '%';
            
            // Populate Career Insights
            document.getElementById('predicted-level').textContent = data.predicted_level || 'Not Available';
            document.getElementById('recommended-field').textContent = data.recommended_field || 'Not Available';
            
            // Populate Extracted Skills
            const extractedSkillsContainer = document.getElementById('extracted-skills');
            if (data.skills && data.skills.length > 0) {
                extractedSkillsContainer.innerHTML = data.skills.map(skill => 
                    `<span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-semibold bg-blue-100 text-blue-700 border border-blue-200">${skill}</span>`
                ).join('');
            } else {
                extractedSkillsContainer.innerHTML = '<p class="text-sm text-slate-500">No skills extracted from resume</p>';
            }
            
            // Populate Recommended Skills
            const recommendedSkillsContainer = document.getElementById('recommended-skills');
            if (data.recommended_skills && data.recommended_skills.length > 0) {
                recommendedSkillsContainer.innerHTML = data.recommended_skills.map(skill => 
                    `<span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-semibold bg-amber-100 text-amber-700 border border-amber-200">
                        <svg class="h-3.5 w-3.5 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                        ${skill}
                    </span>`
                ).join('');
            } else {
                recommendedSkillsContainer.innerHTML = '<p class="text-sm text-slate-500">No skill recommendations available</p>';
            }
            
            // Also update the Technical Skills sidebar
            const skillsContent = document.getElementById('skills-content');
            const skillsLoading = document.getElementById('skills-loading');
            skillsLoading.classList.add('hidden');
            skillsContent.classList.remove('hidden');
            
            if (data.skills && data.skills.length > 0) {
                skillsContent.innerHTML = '<div class="flex flex-wrap gap-2">' + 
                    data.skills.map(skill => 
                        `<span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-semibold bg-primary-100 text-primary-700 border border-primary-200">${skill}</span>`
                    ).join('') + '</div>';
            } else {
                skillsContent.innerHTML = '<p class="text-sm text-slate-500">No technical skills found</p>';
            }
        })
        .catch(error => {
            console.error('Resume analysis error:', error);
            document.getElementById('analysis-loading').classList.add('hidden');
            document.getElementById('analysis-error').classList.remove('hidden');
            
            // Also show empty skills in sidebar
            document.getElementById('skills-loading').classList.add('hidden');
            document.getElementById('skills-content').classList.remove('hidden');
            document.getElementById('skills-content').innerHTML = '<p class="text-sm text-slate-500">Analysis failed</p>';
        });
    } else {
        // No resume URL provided
        document.getElementById('analysis-loading').classList.add('hidden');
        document.getElementById('analysis-error').classList.remove('hidden');
        
        // Show empty skills
        document.getElementById('skills-loading').classList.add('hidden');
        document.getElementById('skills-content').classList.remove('hidden');
        document.getElementById('skills-content').innerHTML = '<p class="text-sm text-slate-500">No resume uploaded</p>';
    }
    
    // Fetch Applications
    fetch(`/admin/api/applications/student/${studentId}`)
        .then(response => {
            console.log('Applications response status:', response.status);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Applications data received:', data);
            document.getElementById('applications-loading').classList.add('hidden');
            
            if (data && Array.isArray(data) && data.length > 0) {
                console.log('Processing', data.length, 'applications');
                document.getElementById('app-count-badge').textContent = data.length;
                document.getElementById('applications-content').classList.remove('hidden');
                
                const applicationsHTML = data.map((app, index) => {
                    console.log('Processing application', index, ':', app);
                    
                    // Format the applied date
                    const appliedDate = app.applied_at 
                        ? new Date(app.applied_at).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' })
                        : 'Unknown date';
                    
                    // Determine status color
                    let statusColor = 'bg-yellow-100 text-yellow-700';
                    if (app.status === 'Accepted' || app.status === 'accepted') {
                        statusColor = 'bg-green-100 text-green-700';
                    } else if (app.status === 'Rejected' || app.status === 'rejected') {
                        statusColor = 'bg-red-100 text-red-700';
                    } else if (app.status === 'Withdrawn' || app.status === 'withdrawn') {
                        statusColor = 'bg-slate-100 text-slate-700';
                    }
                    
                    // Get job title and company
                    const jobTitle = app.job && app.job.title ? app.job.title : 'Position Not Found';
                    const companyName = app.job && app.job.company_name ? app.job.company_name : 'Company Information Not Available';
                    
                    return `
                        <div class="p-5 hover:bg-slate-50 transition-colors">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1">
                                    <h4 class="text-lg font-bold text-slate-900 mb-1">${jobTitle}</h4>
                                    <p class="text-sm text-slate-600">${companyName}</p>
                                </div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap ml-3 ${statusColor}">
                                    ${app.status ? app.status.charAt(0).toUpperCase() + app.status.slice(1).toLowerCase() : 'Pending'}
                                </span>
                            </div>
                            <div class="flex items-center gap-4 text-xs text-slate-500">
                                <span class="inline-flex items-center gap-1">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Applied ${appliedDate}
                                </span>
                                ${app.resume_snapshot_url ? `
                                    <span class="inline-flex items-center gap-1">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                        Resume Submitted
                                    </span>
                                ` : ''}
                            </div>
                        </div>
                    `;
                }).join('');
                
                console.log('Setting applications HTML');
                document.getElementById('applications-content').innerHTML = applicationsHTML;
            } else {
                console.log('No applications found or data is not an array');
                document.getElementById('applications-empty').classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error('Applications fetch error:', error);
            document.getElementById('applications-loading').classList.add('hidden');
            document.getElementById('applications-empty').classList.remove('hidden');
        });
});
</script>

<!-- Resume Preview Modal -->
<div id="resumeModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] flex flex-col">
        <!-- Modal Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
            <h3 class="text-xl font-bold text-slate-900">Resume Preview</h3>
            <button onclick="closeResumePreview()" class="text-slate-500 hover:text-slate-700 transition-colors">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <!-- Modal Content -->
        <div class="flex-1 overflow-auto">
            <iframe id="resumeFrame" src="" class="w-full h-full" style="min-height: 500px;"></iframe>
        </div>
        
        <!-- Modal Footer -->
        <div class="flex items-center justify-between px-6 py-4 border-t border-slate-200 bg-slate-50">
            <a id="downloadResume" href="" download class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-primary-600 text-white font-semibold hover:bg-primary-700 transition-all">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Download Resume
            </a>
            <button onclick="closeResumePreview()" class="px-4 py-2.5 rounded-lg bg-slate-200 text-slate-900 font-semibold hover:bg-slate-300 transition-all">
                Close
            </button>
        </div>
    </div>
</div>

<script>
function openResumePreview() {
    const studentId = "{{ $student->_id }}";
    
    if (!studentId) {
        alert('Student ID not found');
        return;
    }
    
    // Use the backend proxy endpoint to serve the resume
    const proxyUrl = `/admin/api/resume/${studentId}`;
    
    // Set iframe src to display the PDF through backend proxy
    document.getElementById('resumeFrame').src = proxyUrl;
    
    // Set download link to the proxy endpoint
    document.getElementById('downloadResume').href = proxyUrl;
    document.getElementById('downloadResume').setAttribute('download', 'resume.pdf');
    
    // Show modal
    document.getElementById('resumeModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeResumePreview() {
    document.getElementById('resumeModal').classList.add('hidden');
    document.getElementById('resumeFrame').src = '';
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.getElementById('resumeModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeResumePreview();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !document.getElementById('resumeModal').classList.contains('hidden')) {
        closeResumePreview();
    }
});
</script>

@endsection