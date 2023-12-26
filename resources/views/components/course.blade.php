<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<body>
    <div class="py-12">
        <div class="top-0 left-10 mt-20 ml-10">
            <a href="{{ route('welcome') }}" class="py-2 px-4 bg-blue-500 text-white rounded">Home</a>
        </div>
        <div class="bg-gray-100 min-h-screen flex flex-col items-center justify-center mt--4 ml--4">
            <div class="">
                <div class="bg-gray-100 min-h-screen flex flex-col items-center justify-center">
                    @if($courses->count()==0)
                    <button class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-1xl font-semibold bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md" onclick="openModal()">Create Course</button>
                    @else
                    <div class="w-full md:w-5/6 lg:w-2/3 p-4 bg-white rounded-lg shadow-md flex items-center justify-between mb-4">
                        <p class="text-lg font-bold">Showing all the available courses</p>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md" onclick="openModal()">Create Course</button>
                    </div>
                    @endif

                    <div id="modalBackground" class="fixed inset-0 bg-black opacity-50 hidden"></div>

                    <div id="formModal" class="fixed inset-0 flex items-center justify-center hidden">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-3/4 lg:w-1/2">
                            <h2 class="text-xl mb-4">Course Form</h2>
                            <form action="/create-course" method="post" onsubmit="return validateForm()">
                                @csrf
                                <div class=" mb-4">
                                    <label for="name" class="block text-sm font-medium text-gray-600">Course Name</label>
                                    <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded-md">
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="block text-sm font-medium text-gray-600">Course Description</label>
                                    <textarea id="description" name="description" rows="4" class="mt-1 p-2 w-full border rounded-md"></textarea>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Create</button>
                                    <button type="button" class="ml-4 bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-md" onclick="closeModal()">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if(session('course_creation_success'))
                    <div id="courseCreateSuccess" class="bg-green-200 text-green-800 p-4 rounded-md mb-4">
                        {{ session('course_creation_success') }}
                    </div>
                    @endif
                    @if(session('course_edit_success'))
                    <div id="courseEditSuccess" class="bg-green-200 text-green-800 p-4 rounded-md mb-4">
                        {{ session('course_edit_success') }}
                    </div>
                    @endif
                    @if($courses->count()>0)
                    <div class="w-full md:w-10/8 lg:w-5/2 p-6 bg-white rounded-lg shadow-md overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 w-1/3">Course Name</th>
                                    <th class="px-4 py-2 w-1/3">Course Description</th>
                                    <th class="px-4 py-2 w-1/3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                <tr>
                                    <td class="border px-4 py-2 text-1xl font-semibold whitespace-nowrap">{{ $course['name'] }}</td>
                                    <td class="border px-4 py-2 font-medium whitespace-normal">{{ $course['description'] }}</td>
                                    <td class="border px-4 py-2 font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('courses.pages', ['course' => $course->id]) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-md">Addpage</a>
                                            <a href="{{ route('courses.play', ['course' => $course->id, 'page' => session("course_{$course->id}_user_" . auth()->id())]) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-md">Play</a>
                                            <a href="{{ route('course.editScreen', ['course' => $course->id]) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-md">Edit</a>
                                            <div class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-md">
                                                <form action="{{ route('course.deleteCourse', ['course' => $course]) }}" method="POST">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-danger" onclick=" return confirmDelete()">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    <script>
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

                        function validateForm() {
                            const name = document.getElementById('name').value.trim();
                            const description = document.getElementById('description').value.trim();

                            if (name === '') {
                                alert('Please enter the course name.');
                                return false;
                            }

                            if (description === '') {
                                alert('Please enter the course description.');
                                return false;
                            }

                            return true;
                        }
                        setTimeout(function() {
                            var courseCreateSuccess = document.getElementById('courseCreateSuccess');
                            if (courseCreateSuccess) {
                                courseCreateSuccess.style.display = 'none';
                            }
                        }, 1000);
                        setTimeout(function() {
                            var courseEditSuccess = document.getElementById('courseEditSuccess');
                            if (courseEditSuccess) {
                                courseEditSuccess.style.display = 'none';
                            }
                        }, 1000);

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
</body>