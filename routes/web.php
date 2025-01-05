<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\SignInController;
use Illuminate\Support\Facades\Route;


Route::post('/teachers', [AdminController::class, 'storeTeacher'])->name('teachers.store');
Route::post('/courses', [AdminController::class, 'storeCourse'])->name('courses.store');
Route::post('/groups', [AdminController::class, 'storeGroup'])->name('groups.store');

// Admin routes for managing teachers, courses, and groups
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/teachers', [AdminController::class, 'showTeachers'])->name('admin.teachers');
    Route::get('/courses', [AdminController::class, 'showCourses'])->name('admin.courses');
    Route::get('/groups', [AdminController::class, 'showGroups'])->name('admin.groups');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

// Teacher routes (after sign-in)
Route::prefix('teacher')->middleware('auth:teacher')->group(function () {
    Route::get('/profile', [TeacherController::class, 'showProfile'])->name('teacher.profile');
    Route::get('/courses', [TeacherController::class, 'showCourses'])->name('teacher.courses');
});

// CRUD operations for courses, groups, and teachers
Route::resource('courses', CoursesController::class);
Route::resource('groups', GroupController::class);
Route::resource('teachers', TeacherController::class);

// Sign-up route for teachers
Route::get('/signup', [SignUpController::class, 'showSignUpForm'])->name('signup'); 
Route::post('/signup', [SignUpController::class, 'signUp'])->name('signup.store'); 

// Sign-in route for both teachers and admin


// Admin-specific login page
Route::get('/admin/login', [AdminController::class, 'showLoginPage'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.authenticate');

// Fallback route for unauthenticated users
Route::fallback(function () {
    return redirect('/signin');
});

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/welcome', function () {
    return view('welcome'); 
})->name('welcome');

Route::get('/admin/teachers', [AdminController::class, 'showTeachers'])->name('admin.teachers');
Route::get('/admin/courses', [AdminController::class, 'showCourses'])->name('admin.courses');
Route::get('/admin/groups', [AdminController::class, 'showGroups'])->name('admin.groups');

Route::delete('teachers/{teacher}', [AdminController::class, 'destroyTeacher'])->name('teachers.destroy');
Route::delete('courses/{course}', [AdminController::class, 'destroyCourse'])->name('courses.destroy');
Route::delete('groups/{group}', [AdminController::class, 'destroyGroup'])->name('groups.destroy');

Route::middleware('auth:teacher')->group(function () {
    Route::get('/teacher/courses/{group}', [TeacherController::class, 'filterCourses'])->name('teacher.courses');
    Route::post('/teacher/courses/store', [TeacherController::class, 'storeCourse'])->name('teacher.courses.store');
});

Route::middleware(['auth:teacher'])->group(function () {
    Route::get('teacher/welcome', [TeacherController::class, 'welcome'])->name('teacher.welcome');
});


Route::get('/signin', [SignInController::class, 'showSignInForm'])->name('signin'); 
Route::post('/signin', [SignInController::class, 'signIn'])->name('signin.store'); 
Route::post('/signin', [SignInController::class, 'signIn']);
