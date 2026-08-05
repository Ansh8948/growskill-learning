<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserForgotController;

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;

use App\Http\Controllers\Teacher\AuthController as TeacherAuthController;
use App\Http\Controllers\Teacher\CourseController as TeacherCourseController;
// use App\Http\Controllers\Teacher\ForgotPasswordController;
use App\Http\Controllers\Teacher\TeacherForgotPasswordController;




/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course:slug}', [CourseController::class, 'show'])->name('courses.show');

Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // User Register/Login
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    /*
    |--------------------------------------------------------------------------
    | User Forgot Password (OTP)
    |--------------------------------------------------------------------------
    */

    Route::get('/forgot-password', [UserForgotController::class, 'showLinkRequestForm'])
        ->name('password.request');

    Route::post('/forgot-password', [UserForgotController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    Route::get('/verify-otp', [UserForgotController::class, 'showOtpForm'])
        ->name('password.otp.form');

    Route::post('/verify-otp', [UserForgotController::class, 'verifyOtp'])
        ->name('password.otp.verify');

    Route::get('/reset-password', [UserForgotController::class, 'showResetPasswordForm'])
        ->name('password.reset.form');

    Route::post('/reset-password', [UserForgotController::class, 'updatePassword'])
        ->name('password.update');
});


/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::delete('/dashboard/{enrollment}', [DashboardController::class, 'destroy'])
        ->name('dashboard.destroy');

    Route::post('/courses/{course:slug}/enroll', [EnrollmentController::class, 'store'])
        ->name('courses.enroll');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/courses', [AdminCourseController::class, 'index'])->name('courses.index');

        Route::get('/courses/create', [AdminCourseController::class, 'create'])->name('courses.create');

        Route::post('/courses', [AdminCourseController::class, 'store'])->name('courses.store');

        Route::get('/courses/{course}', [AdminCourseController::class, 'show'])->name('courses.show');

        Route::get('/courses/{course}/edit', [AdminCourseController::class, 'edit'])->name('courses.edit');

        Route::put('/courses/{course}', [AdminCourseController::class, 'update'])->name('courses.update');

        Route::patch('/courses/{course}/toggle-status', [AdminCourseController::class, 'toggleStatus'])
            ->name('courses.toggle-status');

        // Route::delete('/courses/{course}', [AdminCourseController::class, 'destroy'])->name('courses.destroy');
    });



/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
*/

Route::prefix('teacher')->name('teacher.')->group(function () {

    // Authentication
    Route::get('/register', [TeacherAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [TeacherAuthController::class, 'register']);

    Route::get('/login', [TeacherAuthController::class, 'showLogin'])->name('login');
     Route::post('/login', [TeacherAuthController::class, 'login']);

    // Forgot Password (OTP)
    Route::get('/forgot-password', [TeacherForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');

    Route::post('/forgot-password', [TeacherForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    Route::get('/verify-otp', [TeacherForgotPasswordController::class, 'showOtpForm'])
        ->name('password.otp.form');

    Route::post('/verify-otp', [TeacherForgotPasswordController::class, 'verifyOtp'])
        ->name('password.otp.verify');

    Route::get('/reset-password', [TeacherForgotPasswordController::class, 'showResetForm'])
        ->name('password.reset.form');

    Route::post('/reset-password', [TeacherForgotPasswordController::class, 'reset'])
        ->name('password.update');

    // Protected Routes
    Route::middleware('teacher.auth')->group(function () {

        Route::post('/logout', [TeacherAuthController::class, 'logout'])
            ->name('logout');

        Route::get('/courses', [TeacherCourseController::class, 'index'])
            ->name('courses.index');

        Route::get('/courses/create', [TeacherCourseController::class, 'create'])
            ->name('courses.create');

        Route::post('/courses', [TeacherCourseController::class, 'store'])
            ->name('courses.store');

        Route::delete('/courses/{course}', [TeacherCourseController::class, 'destroy'])
            ->name('courses.destroy');

     
    });

});