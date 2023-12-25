<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="py-12">
    <div class="container mx-auto">
        <!-- Course Header -->
        <div class="flex items-right justify-between mb-6">
            <h1 class="text-2xl font-semibold">Pages in Course the {{$course->name}}</h1>

        </div>

        <h1 class=" flex items-center justify-between mb-6 text-2xl font-semibold">Total Pages {{$pages->count()}}</h1>
        <div class="flex justify-between mb-4">
            <button id="prevPage" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md" onclick="goToPreviousPage()">Previous</button>
            <button id="nextPage" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md" onclick="goToNextPage()">Next</button>
        </div>
        <div class="flex items-center justify-between mb-6">

            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md" onclick="openModal()">Add Page</button>
        </div>


        <!-- Modal Background -->
        <div id="modalBackground" class="fixed inset-0 bg-black opacity-50 hidden"></div>

        <!-- Form Modal -->
        <div id="formModal" class="fixed inset-0 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-3/4 lg:w-1/2">
                <h2 class="text-xl mb-4">Add Page to Course</h2>
                <form action="{{ route('pages.store', $course->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Course ID if needed -->


                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-600">Page Title</label>
                        <input type="text" id="title" name="title" class="mt-1 p-2 w-full border rounded-md">
                    </div>

                    <div class="mb-4">
                        <label for="media" class="block text-sm font-medium text-gray-600">Media</label>
                        <input type="file" id="media" name="media" class="mt-1 p-2 w-full border rounded-md">
                    </div>

                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-600">Page Content</label>
                        <textarea id="content" name="content" rows="4" class="mt-1 p-2 w-full border rounded-md"></textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Create</button>
                        <button type="button" class="ml-4 bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-md" onclick="closeModal()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Example Pages (You can loop through your pages here) -->
        <!-- Example Pages (You can loop through your pages here) -->
        @foreach($pages as $page)
        <div class="my-4 flex items-center justify-center"> <!-- Center the card vertically -->
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center w-3/4"> <!-- Adjusted width here -->
                @if($page->image_path)
                <img src="{{ asset($page->image_path) }}" alt="{{ $page->title }}">
                @elseif($page->video_path)
                <video width="320" height="240" controls>
                    <source src="{{ asset($page->video_path) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                @endif
                <div>
                    <div class="text-xl font-semibold">{{ $page->title }}</div>
                    <p class="text-gray-600">{{ $page->content }}</p>
                    <p><a href="{{ route('pages.editScreen', ['course' => $course->id,'page' => $page->id]) }}">Edit Page</a></p>

                    <br>
                    <div class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                        <form action="{{ route('pages.deletePage', ['course' => $course, 'page' => $page]) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach


        <script>
            // Open Modal Function
            function goToPreviousPage() {
                window.history.back();
            }

            function goToNextPage() {
                window.history.forward();
            }

            function openModal() {
                document.getElementById('modalBackground').classList.remove('hidden');
                document.getElementById('formModal').classList.remove('hidden');
            }

            // Close Modal Function
            function closeModal() {
                document.getElementById('modalBackground').classList.add('hidden');
                document.getElementById('formModal').classList.add('hidden');
            }
        </script>
    </div>
</div>