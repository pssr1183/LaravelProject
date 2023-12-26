<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
    public function createCourse(Request $request)
    {
        $incomingFields = $request->validate(
            [
                'name' => 'required',
                'description' => 'required',
            ]
        );
        $incomingFields['name'] = strip_tags($incomingFields['name']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);
        $incomingFields['user_id'] = auth()->id();
        Course::create($incomingFields);
        return redirect('/');
    }
    public function showPagesForCourse(Course $course)
    {
        // Fetch all pages associated with the selected course
        $pages = Page::where('course_id', $course->id)->get();

        // Return the view with the pages for the selected course
        return view('pages', ['course' => $course, 'pages' => $pages]);
    }
    public function play($courseId, $pageId = null)
    {
        $course = Course::findOrFail($courseId);

        // Fetch pages related to this course
        $pages = Page::where('course_id', $courseId)->get();
        if($pages->count()===0)
        return redirect('/dashboard')->with('error', 'No pages available for this course.');;
        session(["course_{$courseId}_user_" . auth()->id() => $pageId]);
        $lastVisitedPage = session("course_{$courseId}_user_" . auth()->id());
        if ($lastVisitedPage) {
            $currentPage = Page::findOrFail($lastVisitedPage);
        } else {
            $currentPage = $pageId ? Page::findOrFail($pageId) : $pages->first();
        }

        $previousPage = $pages->where('id', '<', $currentPage->id)->last(); // Get the previous page
        $nextPage = $pages->where('id', '>', $currentPage->id)->first(); // Get the next page

        return view('play', [
            'course' => $course,
            'pages' => $pages,
            'currentPage' => $currentPage,
            'previousPage' => $previousPage,
            'nextPage' => $nextPage
        ]);
    }
    public function courseEditScreen(Course $course){
        return view('editCourse',['course' => $course]);
    }
    public function editCourse(Course $course, Request $request){
        $data = $request->validate(
            [
                'name' => 'required',
                'description' => 'required',
            ]
        );
        $course->update($data);
        return redirect('/dashboard');
    }
    public function deleteCourse(Course $course)
    {
        $course->delete();
        return redirect('/dashboard');
    }

}
