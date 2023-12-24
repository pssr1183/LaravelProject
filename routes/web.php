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
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $courses = Course::where('user_id',auth()->id())->get( );
        return view('dashboard', ['courses' => $courses]);
    })->name('dashboard');
    Route::get('/courses/{course}/pages', [CourseController::class, 'showPagesForCourse'])->name('courses.pages');
    // routes/web.php

    Route::get('/courses/{course}/play/{page?}', [CourseController::class, 'play'])->name('courses.play');
    Route::post('/create-course', [CourseController::class, 'createCourse']);
    //page routings
    Route::post('/courses/{course}/create-page', [PageController::class, 'createPage'])->name('pages.store');
    //edit page
    Route::get('/courses/{course}/pages/{page}/edit', [PageController::class, 'showEditScreen'])->name('pages.editScreen');
    Route::put('/courses/{course}/pages/{page}/edit', [PageController::class, 'editPage'])->name('pages.editPage');
    Route::delete('/courses/{course}/pages/{page}/delete', [PageController::class, 'deletePage'])->name('pages.deletePage');
    //edit course
    Route::get('/courses/{course}/edit', [CourseController::class, 'courseEditScreen'])->name('course.editScreen');
    Route::put('/courses/{course}/edit', [CourseController::class, 'editCourse'])->name('course.editCourse');
    Route::delete('/courses/{course}/delete', [CourseController::class, 'deleteCourse'])->name('course.deleteCourse');

});
// Route::get('/page', function () {
//     $pages= null;
//     $courses = Course::where('user_id', auth()->id())->get();

//         $pages = Page::where('course_id', $courses->id)->get();

//     return view('pages',['courses' => $courses, 'pages' => $pages]);
// });
    
// Route::get('/dashboard', function () {
//     $courses = Course::all();
//     return view('dashboard', ['courses' => $courses]);
// });

