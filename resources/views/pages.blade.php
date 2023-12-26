<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">



<div class="py-12">
    <div class="container mx-auto">

        <div class="flex items-right justify-center mb-6">
            <h1 class="text-2xl font-semibold text-center">Pages in Course the {{$course->name}}</h1>

        </div>
        <div class="flex flex-col items-center"> <!-- Flex container for vertical and horizontal centering -->

            @if(session('page_creation_success'))
            <div id="pageCreateSuccess" class="bg-green-200 text-green-800 p-2 rounded-md mb-4">
                {{ session('page_creation_success') }}
            </div>
            @endif

            @if(session('page_edit_success'))
            <div id="pageEditSuccess" class="bg-green-200 text-green-800 p-2 rounded-md mb-4">
                {{ session('page_edit_success') }}
            </div>
            @endif

        </div>

        <h1 class=" flex items-center justify-between mb-6 text-1xl font-semibold">Total Pages: {{$pages->count()}}</h1>
        <div class="flex justify-between mb-4">
            <button id="prevPage" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md" onclick="goToDashBoard()">Back</button>
        </div>

        <!-- If the course has no pages then place the Add Page button in the middle -->
        @if($pages->count()==0)
        <button class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-1xl font-semibold bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md" onclick="openModal()">Add Page</button>
        @else
        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md" onclick="openModal()">Add Page</button>
        @endif





        
        <div id="modalBackground" class="fixed inset-0 bg-black opacity-50 hidden"></div>

        <!-- Form Modal -->
        <div id="formModal" class="fixed inset-0 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-3/4 lg:w-1/2">
                <h2 class="text-xl mb-4">Add Page to Course</h2>
                <form action="{{ route('pages.store', $course->id) }}" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                    @csrf
                   


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



      
        @foreach($pages as $index => $page)
        <div class="my-8"></div>
        <div class="my-4 flex items-center justify-center"> <!-- Center the card vertically -->
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center w-3/4 font-sans overflow-y-auto max-h-[400px]"> <!-- Adjusted width, added overflow-y-auto and max height -->
                <div class="mr-10">
                    <!-- Media Display -->
                    @if($page->image_path)
                    <img src="{{ asset($page->image_path) }}" alt="{{ $page->title }}" class="rounded-md">
                    @elseif($page->video_path)
                    <video width="320" height="240" controls class="rounded-md">
                        <source src="{{ asset($page->video_path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    @endif
                </div>
                <div>
                    <!-- Title -->
                    <h2 class="text-xl font-semibold mb-2">Page Number: {{ $index+1 }}</h2>
                    <h2 class="text-xl font-semibold mb-2">Page Title: {{ $page->title }}</h2>
                    <!-- Content -->
                    <p class="text-gray-600 mb-4"><strong>Page Content:</strong> {{ $page->content }}</p>
                    <!-- Edit Link -->
                    <p><a href="{{ route('pages.editScreen', ['course' => $course->id,'page' => $page->id]) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md">Edit Page</a></p>
                    <!-- Delete Button -->
                    <div class="mt-4">
                        <form action="{{ route('pages.deletePage', ['course' => $course, 'page' => $page]) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md" onclick=" return confirmDelete()">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach



        <script>
            // Open Modal Function
            function goToDashBoard() {
                window.location.href = "{{ route('dashboard') }}";
            }

            function validateForm() {
                const title = document.getElementById('title').value.trim();
                const content = document.getElementById('content').value.trim();

                if (title === '') {
                    alert('Please enter the page title.');
                    return false;
                }

                if (content === '') {
                    alert('Please enter the page content.');
                    return false;
                }

                return true;
            }


            function openModal() {
                document.getElementById('modalBackground').classList.remove('hidden');
                document.getElementById('formModal').classList.remove('hidden');
            }

            function confirmDelete() {
                if (confirm("Are you sure you want to delete this page?")) {
                    return true;
                } else {
                    return false;
                }
            }
            setTimeout(function() {
                var pageCreateSuccess = document.getElementById('pageCreateSuccess');
                if (pageCreateSuccess) {
                    pageCreateSuccess.style.display = 'none';
                }
            }, 1000);
            setTimeout(function() {
                var pageEditSuccess = document.getElementById('pageEditSuccess');
                if (pageEditSuccess) {
                    pageEditSuccess.style.display = 'none';
                }
            }, 1000);

            // Close Modal Function
            function closeModal() {
                document.getElementById('modalBackground').classList.add('hidden');
                document.getElementById('formModal').classList.add('hidden');
            }
        </script>
    </div>
</div>