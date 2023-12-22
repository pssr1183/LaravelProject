<?php

namespace App\Http\Controllers;

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
}
