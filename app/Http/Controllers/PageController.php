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
            'media' => 'required|file|mimes:jpg,jpeg,png,mp4|max:4096',
            'content' => 'required|string',
        ]);

       //stores in the public/image
        $isImage = $request->file('media')->isValid() && in_array($request->file('media')->getClientOriginalExtension(), ['jpg', 'jpeg', 'png']);
        //stores in the public/video
        $mediaPath = $isImage ? $request->file('media')->store('public/images') : $request->file('media')->store('public/videos');

        // Gets the public url to store and retrive the media data
        $mediaUrl = Storage::url($mediaPath);

        // Page creation
        Page::create([
            'title' => strip_tags($request->title),
            'image_path' => $isImage ? $mediaUrl : null, // Store image URL if it's an image, otherwise null
            'video_path' => !$isImage ? $mediaUrl : null, // Store video URL if it's a video, otherwise null
            'content' => strip_tags($request->content),
            'course_id' => $course->id,
        ]);

        //return to course pages with the success message
        return redirect()->route('courses.pages', ['course' => $course->id])->with('page_creation_success', 'page created successfully!');
    }
    public function showEditScreen(Course $course, Page $page)
    {
        return view('editPage', ['course' => $course, 'page' => $page]);
    }
    public function editPage(Course $course, Page $page, Request $request)
    {
       //validation
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,mp4|max:4096', 
            'content' => 'required|string',
        ]);

        // Check if a media file is provided in the request
        if ($request->hasFile('media') && $request->file('media')->isValid()) {
            // Determine if the uploaded file is an image or video
            $isImage = in_array($request->file('media')->getClientOriginalExtension(), ['jpg', 'jpeg', 'png']);

            
            $mediaPath = $isImage ? $request->file('media')->store('public/images') : $request->file('media')->store('public/videos');

            // Get the public URL of the stored media
            $mediaUrl = Storage::url($mediaPath);

            // Update the media paths 
            $data['image_path'] = $isImage ? $mediaUrl : null;
            $data['video_path'] = !$isImage ? $mediaUrl : null;
        }

        // Update the page 
        $page->update($data);

        // Redirect to the course pages with a success message
        return redirect()->route('courses.pages', ['course' => $course->id])->with('page_edit_success', 'Page updated successfully!');
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
        //delete the media file in respective folders by using Storage facade
        if ($page->image_path) {
            Storage::delete(str_replace('/storage', 'public', $page->image_path));
        }

        if ($page->video_path) {
            Storage::delete(str_replace('/storage', 'public', $page->video_path));
        }

        // Delete the page
        $page->delete();


        return redirect()->route('courses.pages', ['course' => $course->id]);
    }
}
