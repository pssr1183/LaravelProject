<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="p-10 bg-gray-100">
    <div class="flex justify-center items-center h-screen relative">
        <div class="absolute top-0 left-0 mt-5 ml-5">
            <a href="{{ route('dashboard') }}" class="py-2 px-4 bg-red-500 text-white rounded">Exit Course</a>
        </div>

        <div class="flex w-full max-w-10xl">

            <!-- Left Sidebar for Pages List -->
            <div class="w-1/4 p-5 bg-white rounded shadow">
                <h2 class="text-xl font-bold mb-5">Pages</h2>
                @foreach($pages as $index => $page)
                <div class="mb-2 flex justify-between items-center">
                    <h3 class="font-bold text-sm">Page: {{ $index + 1 }}: {{ $page->title }}</h3>
                    <a href="{{ route('courses.play', ['course' => $course->id, 'page' => $page->id]) }}" class="ml-auto py-2 px-4 bg-blue-500 text-white rounded">View</a>
                </div>
                @endforeach
            </div>

            <!-- Main Content Area -->
            <div class="w-3/4 ml-5 p-5 bg-white rounded shadow overflow-y-auto max-h-screen">
                <div class="flex justify-between mb-5">
                    @if($previousPage)
                    <a href="{{ route('courses.play', ['course' => $course->id, 'page' => $previousPage->id]) }}" class="py-2 px-4 bg-blue-500 text-white rounded">Previous Page</a>
                    @endif

                    @if($nextPage)
                    <a href="{{ route('courses.play', ['course' => $course->id, 'page' => $nextPage->id]) }}" class="py-2 px-4 bg-blue-500 text-white rounded">Next Page</a>
                    @endif
                </div>

                <!-- Displaying the Current Page Content -->
                <div>
                    <h1 class="text-2xl font-bold mb-5 flex justify-center items-center">{{ $currentPage->title }}</h1>
                    @if($currentPage->image_path)
                    <img class="object-cover rounded-md mr-4" src="{{ $currentPage->image_path }}" alt="{{ $currentPage->title }}">
                    @elseif($currentPage->video_path)
                    <video class="rounded-md mr-4" controls>
                        <source src="{{ $currentPage->video_path }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    @endif
                    <div class="p-5 bg-grey-200 rounded">
                        <p class = "text-xl font-medium">Description: {{ $currentPage->content }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>