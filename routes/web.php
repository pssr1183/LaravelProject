<?php

use App\Models\Course;
use Illuminate\Support\Facades\Route;
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
});
// Route::get('/dashboard', function () {
//     $courses = Course::all();
//     return view('dashboard', ['courses' => $courses]);
// });

Route::post('/create-course', [CourseController::class, 'createCourse']);
