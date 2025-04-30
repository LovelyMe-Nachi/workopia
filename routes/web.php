<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ApplicantController;


// This is the main route file for the application.
Route::get('/', [HomeController::class,'index'])->name('home');

// Applicant Routes
Route::middleware('auth')->group(function () {
    Route::post('/jobs/{job}/apply', [ApplicantController::class, 'store'])->name('applicants.store');
    Route::delete('/applicants/{applicant}', [ApplicantController::class, 'destroy'])->name('applicants.destroy');
});


// Job Routes
Route::controller(JobController::class)
    ->prefix('jobs')
    ->name('jobs.')
    ->group(function () {

        // List all jobs
        Route::get('/', 'index')->name('index'); 

        // Search jobs
        Route::get('/search', 'search')->name('search');

        Route::post('/store', 'store')->name('store');

        // Routes that require authentication
        Route::middleware('auth')->group(function () {
            // Create job form
            Route::get('/create', 'create')->name('create'); 

            // Edit job form
            Route::get('/{job}/edit', 'edit')->name('edit');
            
            // Update job
            Route::put('/{job}', 'update')->name('update'); 

            // Delete job
            Route::delete('/{job}', 'destroy')->name('destroy'); 
        });
    
        // Show a single job
        Route::get('/{job}', 'show')->name('show');
});


// Authentication Routes
// These routes are for user registration and login
// They are grouped under the 'guest' middleware to ensure that only unauthenticated users can access them.
// This prevents authenticated users from accessing the registration and login pages.
// The 'guest' middleware checks if the user is not authenticated.
Route::middleware('guest')->group(function () {
    Route::controller(RegisterController::class)
    ->prefix('register')
    ->group(function(){
        
        Route::get('/', 'register')->name('register');

        Route::post('/', 'store')->name('register.store');
    });


    Route::controller(LoginController::class)
    ->prefix('login')
    ->group(function(){
        
        Route::get('/', 'login')->name('login');

        Route::post('/', 'authenticate')->name('login.authenticate');
    });
});

// Logout route
// This route is for the home page of the application.
// It is accessible to all users, regardless of their authentication status.
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dasboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');

// Profile routes
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

// Bookmark routes
Route::middleware('auth')->group(function () {
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index'); 
    Route::post('/bookmarks/{job}', [BookmarkController::class, 'store'])->name('bookmarks.store');
    Route::delete('/bookmarks/{job}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');
});

