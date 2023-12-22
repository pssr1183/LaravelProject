<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div class="bg-gray-100 min-h-screen flex flex-col items-center justify-center">

    <!-- Flex container for aligning items -->
    <div class="w-full md:w-3/4 lg:w-1/2 p-4 bg-white rounded-lg shadow-md flex items-center justify-between mb-4">
        <p class="text-lg">Showing all available courses</p>
        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md" onclick="openModal()">Create Form</button>
    </div>

    <div id="modalBackground" class="fixed inset-0 bg-black opacity-50 hidden"></div>

    <!-- Form Modal -->
    <div id="formModal" class="fixed inset-0 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-3/4 lg:w-1/2">
            <h2 class="text-xl mb-4">Course Form</h2>
            <form>
                <div class="mb-4">
                    <label for="courseName" class="block text-sm font-medium text-gray-600">Course Name</label>
                    <input type="text" id="courseName" name="courseName" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="courseDescription" class="block text-sm font-medium text-gray-600">Course Description</label>
                    <textarea id="courseDescription" name="courseDescription" rows="4" class="mt-1 p-2 w-full border rounded-md"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Create</button>
                    <button type="button" class="ml-4 bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-md" onclick="closeModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Table of Courses -->
    <div class="w-full md:w-3/4 lg:w-1/2 p-4 bg-white rounded-lg shadow-md">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Course Name</th>
                    <th class="px-4 py-2">Course Description</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border px-4 py-2">Course 1</td>
                    <td class="border px-4 py-2">Description 1</td>
                    <td class="border px-4 py-2 md:w-3/4 lg:w-1/2 p-4  justify-between ">
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-md">Add Page</button>
                        <button class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded-md">Play</button>
                    </td>
                </tr>
                <!-- Add more rows as needed -->
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
    </script>
</div>