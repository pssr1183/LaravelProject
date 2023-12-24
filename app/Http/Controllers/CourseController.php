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

        $currentPage = $pageId ? Page::findOrFail($pageId) : $pages->first();

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

}
