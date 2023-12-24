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
'image' => 'required|image|max:2048', // Ensure it's an image and within 2MB
'content' => 'required|string',
]);

// Store the uploaded image in the storage directory
$imagePath = $request->file('image')->store('public/images');

// Get the public URL of the stored image
$imageUrl = Storage::url($imagePath);

// Create a new page record
Page::create([
'title' => strip_tags($request->title),
'image_path' => $imageUrl,
'content' => strip_tags($request->content),
'course_id' => $course->id,
]);

// Redirect back to the course page with a success message
return redirect()->route('courses.pages',['course' => $course->id]);
}
}