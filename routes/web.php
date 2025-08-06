<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MentalHealthAssessmentController;
use App\Http\Controllers\JournalEntryController;
use App\Http\Controllers\AdminController;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Mental Health Assessments
    Route::resource('assessments', MentalHealthAssessmentController::class);
    
    // Journal Entries
    Route::resource('journals', JournalEntryController::class);
    
    // Admin routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/assessments', [AdminController::class, 'assessments'])->name('assessments');
        Route::get('/journals', [AdminController::class, 'journals'])->name('journals');

        // Tambah route CRUD admin
        Route::get('/assessments/{assessment}/edit', [AdminController::class, 'editAssessment'])->name('assessments.edit');
        Route::put('/assessments/{assessment}', [AdminController::class, 'updateAssessment'])->name('assessments.update');
        Route::delete('/assessments/{assessment}', [AdminController::class, 'destroyAssessment'])->name('assessments.destroy');

        Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');

        Route::get('/journals/{journal}/edit', [AdminController::class, 'editJournal'])->name('journals.edit');
        Route::put('/journals/{journal}', [AdminController::class, 'updateJournal'])->name('journals.update');
        Route::delete('/journals/{journal}', [AdminController::class, 'destroyJournal'])->name('journals.destroy');
    });
});
