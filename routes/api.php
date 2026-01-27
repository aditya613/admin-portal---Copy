<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JobController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| These routes are loaded by RouteServiceProvider
| and are prefixed with /api
*/

Route::get('/jobs', [JobController::class, 'index']);
?>