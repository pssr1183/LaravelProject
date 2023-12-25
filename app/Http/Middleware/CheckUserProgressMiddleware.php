<?php

namespace App\Http\Middleware;

use id;
use Closure;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserProgressMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $courseId = $request->route('course');

        // Check if the authenticated user has saved progress for this course
        $progress = UserProgress::where('user_id', Auth::id())
            ->where('course_id', $courseId)
            ->first();

        // If the user has saved progress, redirect to the last visited page
        if ($progress && $progress->page_id) {
            return redirect()->route('courses.play', ['course' => $courseId, 'page' => $progress->page_id]);
        }

        // Continue to the next middleware or controller action
        return $next($request);
    }
}
