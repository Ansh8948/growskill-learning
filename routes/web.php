<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Teacher\AuthController as TeacherAuthController;
use App\Http\Controllers\Teacher\CourseController as TeacherCourseController;
use App\Http\Controllers\Teacher\ForgotPasswordController;

// use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course:slug}', [CourseController::class, 'show'])->name('courses.show');

Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Guest-only auth routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

});

// Auth-only routes
    Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::delete('/dashboard/{enrollment}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/courses/{course:slug}/enroll', [EnrollmentController::class, 'store'])->name('courses.enroll');
});
// auth-login
    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
     Route::get('/courses', [AdminCourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/create', [AdminCourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [AdminCourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{course}', [AdminCourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{course}/edit', [AdminCourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{course}', [AdminCourseController::class, 'update'])->name('courses.update');
    Route::patch('/courses/{course}/toggle-status', [AdminCourseController::class, 'toggleStatus'])->name('courses.toggle-status');
    // Route::delete('/courses/{course}', [AdminCourseController::class, 'destroy'])->name('courses.destroy');
});

// teacher all routes 
Route::prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/register', [TeacherAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [TeacherAuthController::class, 'register']);
    Route::get('/login', [TeacherAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [TeacherAuthController::class, 'login']);
     Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

    Route::middleware('teacher.auth')->group(function () {
        Route::post('/logout', [TeacherAuthController::class, 'logout'])->name('logout');
        Route::get('/courses', [TeacherCourseController::class, 'index'])->name('courses.index');
        Route::get('/courses/create', [TeacherCourseController::class, 'create'])->name('courses.create');
        Route::post('/courses', [TeacherCourseController::class, 'store'])->name('courses.store');
        Route::delete('/courses/{course}', [TeacherCourseController::class, 'destroy'])->name('courses.destroy');
    });
});


