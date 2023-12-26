<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function createPage(Request $request, Course $course)
    {
        // Validate incoming fields from the request
        $request->validate([
            'title' => 'required|string|max:255',
            'media' => 'required|file|mimes:jpg,jpeg,png,mp4|max:4096', // Ensure it's an image and within 2MB
            'content' => 'required|string',
        ]);

        // Store the uploaded image in the storage directory
        $isImage = $request->file('media')->isValid() && in_array($request->file('media')->getClientOriginalExtension(), ['jpg', 'jpeg', 'png']);

        // Store the uploaded file in the appropriate storage directory
        $mediaPath = $isImage ? $request->file('media')->store('public/images') : $request->file('media')->store('public/videos');

        // Get the public URL of the stored media
        $mediaUrl = Storage::url($mediaPath);

        // Create a new page record
        Page::create([
            'title' => strip_tags($request->title),
            'image_path' => $isImage ? $mediaUrl : null, // Store image URL if it's an image, otherwise null
            'video_path' => !$isImage ? $mediaUrl : null, // Store video URL if it's a video, otherwise null
            'content' => strip_tags($request->content),
            'course_id' => $course->id,
        ]);

        // Redirect back to the course page with a success message
        return redirect()->route('courses.pages', ['course' => $course->id]);
    }
    public function showEditScreen(Course $course, Page $page)
    {
        return view('editPage', ['course' => $course, 'page' => $page]);
    }
    public function editPage(Course $course, Page $page, Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'media' => 'required|file|mimes:jpg,jpeg,png,mp4|max:4096',
            'content' => 'required|string',

            // Add other validation rules as needed
        ]);
        $isImage = $request->file('media')->isValid() && in_array($request->file('media')->getClientOriginalExtension(), ['jpg', 'jpeg', 'png']);

        // Store the uploaded file in the appropriate storage directory
        $mediaPath = $isImage ? $request->file('media')->store('public/images') : $request->file('media')->store('public/videos');

        // Get the public URL of the stored media
        $mediaUrl = Storage::url($mediaPath);

        $data = array_merge($data, ['image_path' => $isImage ? $mediaUrl : null, 'video_path' => !$isImage ? $mediaUrl : null]);
        $page->update($data);

        return redirect()->route('courses.pages', ['course' => $course->id]);
    }
    public function deletePage(Course $course, Page $page)
    {
        $userCurrentPage = session("course_{$course->id}_user_" . auth()->id());

        if ($userCurrentPage == $page->id) {
            // Fetch the first page of the course
            $firstPage = Page::where('course_id', $course->id)->orderBy('id', 'asc')->first();

            // Update user's session to point to the first page
            session(["course_{$course->id}_user_" . auth()->id() => $firstPage->id]);
        }

        // Delete the page
        $page->delete();


        return redirect()->route('courses.pages', ['course' => $course->id]);
    }
}
