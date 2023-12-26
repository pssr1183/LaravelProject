 <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
 <div id="formModal" class="fixed inset-0 flex items-center justify-center ">
     <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-3/4 lg:w-1/2">
         <h2 class="text-xl mb-4">Course Edit Form</h2>
         <form action="{{ route('course.editCourse', ['course' => $course->id]) }}" method="post">
             @csrf
             @method("PUT")
             <div class="mb-4">
                 <label for="name" class="block text-sm font-medium text-gray-600">Course Name</label>
                 <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded-md" value="{{$course->name}}">
             </div>
             <div class="mb-4">
                 <label for="description" class="block text-sm font-medium text-gray-600">Course Description</label>
                 <textarea id="description" name="description" rows="4" class="mt-1 p-2 w-full border rounded-md">{{$course->description}}</textarea>
             </div>
             <div class="flex justify-end">
                 <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Edit</button>
                 <button type="button" class="ml-4 bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-md" onclick="redirectToDashboard()">Cancel</button>
             </div>
         </form>
     </div>
 </div>
 <script>
     function redirectToDashboard() {
         window.location.href = "{{ route('dashboard') }}";
     }
 </script>