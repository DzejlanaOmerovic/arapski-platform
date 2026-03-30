<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kontakt', function () {
    return view('kontakt');
})->name('kontakt');

Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'teacher') {
        return redirect()->route('teacher.dashboard');
    } else {
        return redirect()->route('student.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/obavjestenja', function () {
    $notifications = \App\Models\Notification::where('is_active', true)->latest()->get();
    return view('obavjestenja', compact('notifications'));
})->name('obavjestenja');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

use App\Http\Controllers\AdminController;

// Admin rute
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/pending-users', [AdminController::class, 'pendingUsers'])->name('pending-users');
    Route::post('/approve/{user}', [AdminController::class, 'approveUser'])->name('approve-user');
    Route::post('/reject/{user}', [AdminController::class, 'rejectUser'])->name('reject-user');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('delete-user');
    Route::post('/warn/{user}', [AdminController::class, 'warnUser'])->name('warn-user');
    Route::get('/reviews', [AdminController::class, 'reviews'])->name('reviews');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('update-settings');
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');
Route::post('/notifications', [AdminController::class, 'storeNotification'])->name('store-notification');
Route::delete('/notifications/{notification}', [AdminController::class, 'deleteNotification'])->name('delete-notification');
});

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;

// Teacher rute
Route::middleware(['auth'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [TeacherController::class, 'index'])->name('dashboard');
    Route::get('/courses', [TeacherController::class, 'courses'])->name('courses');
    Route::get('/courses/create', [TeacherController::class, 'createCourse'])->name('create-course');
    Route::post('/courses', [TeacherController::class, 'storeCourse'])->name('store-course');
    Route::get('/courses/{course}/edit', [TeacherController::class, 'editCourse'])->name('edit-course');
    Route::put('/courses/{course}', [TeacherController::class, 'updateCourse'])->name('update-course');
    Route::delete('/courses/{course}', [TeacherController::class, 'deleteCourse'])->name('delete-course');
    Route::get('/reservations', [TeacherController::class, 'reservations'])->name('reservations');
    Route::post('/reservations/{reservation}/approve', [TeacherController::class, 'approveReservation'])->name('approve-reservation');
    Route::post('/reservations/{reservation}/reject', [TeacherController::class, 'rejectReservation'])->name('reject-reservation');
    Route::get('/reviews', [TeacherController::class, 'reviews'])->name('reviews');
    Route::get('/profile', [TeacherController::class, 'profile'])->name('profile');
    Route::post('/profile', [TeacherController::class, 'updateProfile'])->name('update-profile');
    Route::post('/reservations/{reservation}/complete', [TeacherController::class, 'completeReservation'])->name('complete-reservation');
    });

// Student rute
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');
    Route::get('/search', [StudentController::class, 'search'])->name('search');
    Route::get('/courses/{course}', [StudentController::class, 'courseDetail'])->name('course-detail');
    Route::post('/courses/{course}/reserve', [StudentController::class, 'reserve'])->name('reserve');
    Route::get('/reservations', [StudentController::class, 'reservations'])->name('reservations');
    Route::post('/reservations/{reservation}/review', [StudentController::class, 'storeReview'])->name('store-review');
});