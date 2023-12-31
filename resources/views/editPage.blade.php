<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div >
    <div id="formModal" class="fixed inset-0 flex items-center justify-center ">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/6 lg:w-2/5 overflow-y-auto max-h-[80vh]"
            <h2 class="text-xl mb-4">Edit Page: {{$page->title}}</h2>
            <form action="{{ route('pages.editPage', ['course' => $course->id, 'page' => $page->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")
               


                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-600">Page Title</label>
                    <input type="text" id="title" name="title" class="mt-1 p-2 w-full border rounded-md" value="{{$page->title}}">
                </div>

                <div class="mb-4">
                    <label for="media" class="block text-sm font-medium text-gray-600">Media</label>

                    <!-- Show existing media for reference -->
                    @if($page->image_path)
                    <img src="{{ $page->image_path }}" alt="{{ $page->title }}" class="mt-2 mb-2">
                    @elseif($page->video_path)
                    <video controls width="250" class="mt-2 mb-2">
                        <source src="{{ $page->video_path }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    @endif

                    <!-- Input field for new media -->
                    <input type="file" id="media" name="media" class="mt-1 p-2 w-full border rounded-md">
                    </small>
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-600">Page Content</label>
                    <textarea id="content" name="content" rows="4" class="mt-1 p-2 w-full border rounded-md">{{$page->content}}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Edit</button>
                    <button type="button" class="ml-4 bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-md" onclick="redirectToPages()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function redirectToPages() {
        window.location.href = "{{ route('courses.pages',['course' => $page->course_id]) }}";
    }
</script>