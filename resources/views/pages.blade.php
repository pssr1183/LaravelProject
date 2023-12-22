<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div class="py-12">
    <div class="">
        <div class="">
            <div class="bg-gray-100 min-h-screen flex flex-col items-center justify-center">
                <!-- Flex container for aligning items -->
                <div class="w-full md:w-3/4 lg:w-1/2 p-4 bg-white rounded-lg shadow-md flex items-center justify-between mb-4">
                    <p class="text-lg">Pages in courses</p>
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md" onclick="openModal()">Add Pages</button>
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
                <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
                    <div class="md:flex">
                        <div class="md:flex-shrink-0">
                            <!-- Add your image here -->
                            <img class="h-48 w-full object-cover md:w-48" src="https://www.investopedia.com/thmb/RaxzKE6Bgmh1uzjH6EOFhMMHYX0=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/excel_ms-5bfc379146e0fb00511cdefe.jpg" alt="Excel logo">
                        </div>
                        <div class="p-8">
                            <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Page Number: 1</div>
                            <h2 class="block mt-1 text-lg leading-tight font-medium text-black">Page Title: Getting Started with Excel</h2>
                            <p class="mt-2 text-gray-500">Page Content: This lesson introduces participants to the Excel interface, covering the ribbon, cells, columns, and rows. Students will learn how to navigate the spreadsheet, understand cell references, and get hands-on experience with basic data entry and formatting.</p>
                        </div>
                    </div>
                </div>
                <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
                    <div class="md:flex">
                        <div class="md:flex-shrink-0">
                            <!-- Add your image here -->
                            <img class="h-48 w-full object-cover md:w-48" src="https://www.investopedia.com/thmb/RaxzKE6Bgmh1uzjH6EOFhMMHYX0=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/excel_ms-5bfc379146e0fb00511cdefe.jpg" alt="Excel logo">
                        </div>
                        <div class="p-8">
                            <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Page Number: 1</div>
                            <h2 class="block mt-1 text-lg leading-tight font-medium text-black">Page Title: Getting Started with Excel</h2>
                            <p class="mt-2 text-gray-500">Page Content: This lesson introduces participants to the Excel interface, covering the ribbon, cells, columns, and rows. Students will learn how to navigate the spreadsheet, understand cell references, and get hands-on experience with basic data entry and formatting.</p>
                        </div>
                    </div>
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
        </div>
    </div>
</div>