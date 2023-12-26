<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div class="py-12">
    <div class=" top-0 left-10 mt-20 ml-10">
        <a href="{{ route('welcome') }}" class="py-2 px-4 bg-blue-500 text-white rounded">Home</a>
    </div>
    <div class="bg-gray-100 min-h-screen flex flex-col items-center justify-center mt --4 ml--4">
        <div class="">
            <div class="bg-gray-100 min-h-screen flex flex-col items-center justify-center ">
                <!-- Flex container for aligning items -->
                <div class="w-full md:w-5/6 lg:w-2/3 p-4 bg-white rounded-lg shadow-md flex items-center justify-between mb-4">
                    <p class="text-lg">Showing all the available courses</p>
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md" onclick="openModal()">Create Course</button>
                </div>

                <div id="modalBackground" class="fixed inset-0 bg-black opacity-50 hidden"></div>

                <!-- Form Modal -->
                <div id="formModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-3/4 lg:w-1/2">
                        <h2 class="text-xl mb-4">Course Form</h2>
                        <form action="/create-course" method="post">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-600">Course Name</label>
                                <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded-md">
                            </div>
                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-600">Course Description</label>
                                <textarea id="description" name="description" rows="4" class="mt-1 p-2 w-full border rounded-md"></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Create</button>
                                <button type="button" class="ml-4 bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-md" onclick="closeModal()">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Table of Courses -->
                <div class="w-full md:w-5/6 lg:w-2/3 p-4 bg-white rounded-lg shadow-md">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Course Name</th>
                                <th class="px-4 py-2">Course Description</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                            <tr>
                                <td class="border px-4 py-2">{{ $course['name'] }}</td>
                                <td class="border px-4 py-2">{{ $course['description'] }}</td>
                                <td class="border px-4 py-2">
                                    <div class="flex items-center space-x-2"> <!-- Using flexbox with horizontal direction -->
                                        <a href="{{ route('courses.pages', ['course' => $course->id]) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-md">Addpage</a>
                                        <a href="{{ route('courses.play', ['course' => $course->id, 'page' => session("course_{$course->id}_user_" . auth()->id())]) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-md">Play</a>
                                        <a href="{{ route('course.editScreen', ['course' => $course->id]) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-md">Edit</a>
                                        <div class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-md">
                                            <form action="{{ route('course.deleteCourse', ['course' => $course]) }}" method="POST">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <script>
                    // Open Modal Function
                    function openModal() {
                        document.getElementById('modalBackground').classList.remove('hidden');
                        document.getElementById('formModal').classList.remove('hidden');
                    }

                    // Close Modal Function
                    function closeModal() {
                        document.getElementById('modalBackground').classList.add('hidden');
                        document.getElementById('formModal').classList.add('hidden');
                    }
                    let errorMessage = '{{ session("error") }}';

                    if (errorMessage) {
                        alert(errorMessage);
                    }
                </script>

            </div>
        </div>
    </div>
</div>