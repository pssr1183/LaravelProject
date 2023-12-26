<?php

use App\Models\Page;
use App\Models\Course;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CourseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


    //Course related routes
    //(CRUD)
    //Creating the course
    Route::post('/create-course', [CourseController::class, 'createCourse']);
    //Read/Show Courses dashboard 
    Route::get('/dashboard', function () {
     $courses = Course::where('user_id', auth()->id())->get();return view('dashboard',['courses' => $courses]);})->name('dashboard');
    //Update course
    Route::get('/courses/{course}/edit', [CourseController::class, 'courseEditScreen'])->name('course.editScreen');
    Route::put('/courses/{course}/edit', [CourseController::class, 'editCourse'])->name('course.editCourse');
    //Delete course
    Route::delete('/courses/{course}/delete', [CourseController::class, 'deleteCourse'])->name('course.deleteCourse');

    //page routings(CRUD)
    //Creating Page
    Route::post('/courses/{course}/create-page', [PageController::class, 'createPage'])->name('pages.store');
    //Read/show pages of the course 
    Route::get('/courses/{course}/pages', [CourseController::class, 'showPagesForCourse'])->name('courses.pages');
    //Update Page
    Route::get('/courses/{course}/pages/{page}/edit', [PageController::class, 'showEditScreen'])->name('pages.editScreen');
    Route::put('/courses/{course}/pages/{page}/edit', [PageController::class, 'editPage'])->name('pages.editPage');
    //Delete Page
    Route::delete('/courses/{course}/pages/{page}/delete', [PageController::class, 'deletePage'])->name('pages.deletePage');

     // Play the course
    Route::get('/courses/{course}/play/{page?}', [CourseController::class, 'play'])->name('courses.play');
});
