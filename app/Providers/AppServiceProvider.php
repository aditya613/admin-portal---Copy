<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\JobListing;
use App\Models\StudentProfile;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share sidebar data with all views
        View::composer('admin.partials.sidebar', function($view) {
            $view->with([
                'jobCount' => JobListing::count(),
                'studentCount' => StudentProfile::count(),
                'applicationCount' => \App\Models\Application::count(),
            ]);
        });
    }
}
