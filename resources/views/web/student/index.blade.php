<x-web-layout>
    <div class="p-4">
        <div class="space-y-4">
            <!-- Filters and Inputs -->
            <div class="flex flex-wrap justify-between">
                <div class="flex flex-wrap gap-4">

                    <select id="classSelect" class="border p-2 rounded w-40 border-gray-200">
                        <option value="">Select Class</option>
                        <option value="1">Class 1</option>
                        <option value="2">Class 2</option>
                        <option value="3">Class 3</option>
                        <option value="4">Class 4</option>
                        <option value="5">Class 5</option>
                        <option value="6">Class 6</option>
                        <option value="7">Class 7</option>
                        <option value="8">Class 8</option>
                        <option value="9">Class 9</option>
                        <option value="10">Class 10</option>
                    </select>

                    <select id="sectionSelect" class="border p-2 rounded w-40 border-gray-200">
                        <option value="">Select Section</option>
                        <option value="1">Section A</option>
                        <option value="2">Section B</option>
                        <option value="3">Section C</option>
                        <option value="4">Section D</option>
                    </select>

                    <select id="sortOrder" class="border p-2 rounded border-gray-200">
                        <option value="name-asc">Order By Name (A-Z)</option>
                        <option value="name-desc">Order By Name (Z-A)</option>
                        <option value="roll-asc">Order By Roll No (Ascending)</option>
                        <option value="roll-desc">Order By Roll No (Descending)</option>
                        <option value="status-asc">Order By Status (Active First)</option>
                        <option value="status-desc">Order By Status (Inactive First)</option>
                    </select>
                </div>

                <input type="text" id="searchInput" placeholder="Search by name or roll"
                    class="border p-2 rounded w-62 border-gray-200">

            </div>

            <div class="mt-4">
                <button id="addStudentButton"
                    class="bg-black text-white py-2 px-4 rounded-md hover:rounded-none hover:pl-4 transition-all relative group w-40">
                    <span
                        class="absolute inset-y-0 left-0 flex items-center opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24" aria-hidden="true" class="btn-builtin-icon css-bni7vm">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M12.522 4.25 20 12l-7.478 7.75-.733-.709 6.302-6.531H4v-1.02h14.09L11.79 4.959z"
                                clip-rule="evenodd"></path>
                        </svg></span>
                    <span class="group-hover:ml-4 transition-all">Add Student</span>
                </button>

                <button id="viewNewStudentButton"
                    class="bg-black text-white py-2 px-4 rounded-md hover:rounded-none hover:pl-4 transition-all relative group w-50">
                    <span
                        class="absolute inset-y-0 left-0 flex items-center opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24" aria-hidden="true" class="btn-builtin-icon css-bni7vm">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M12.522 4.25 20 12l-7.478 7.75-.733-.709 6.302-6.531H4v-1.02h14.09L11.79 4.959z"
                                clip-rule="evenodd"></path>
                        </svg></span>
                    <span class="viewcancel group-hover:ml-4 transition-all">View New Students</span>
                </button>

                <button id="hideNewStudentButton"
                    class="hidden bg-black text-white py-2 px-4 rounded-md hover:rounded-none hover:pl-4 transition-all relative group w-50">
                    <span
                        class="absolute inset-y-0 left-0 flex items-center opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24" aria-hidden="true" class="btn-builtin-icon css-bni7vm">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M12.522 4.25 20 12l-7.478 7.75-.733-.709 6.302-6.531H4v-1.02h14.09L11.79 4.959z"
                                clip-rule="evenodd"></path>
                        </svg></span>
                    <span class="viewcancel group-hover:ml-4 transition-all">Hide New Students</span>
                </button>


            </div>

            <!-- Table Container -->
            <div id="studentTableContainer" class="hidden border border-gray-200 rounded p-4 shadow-md mt-4 min-h-96">
                <h2 class="font-semibold text-lg mb-3">
                    Student List - Class <span id="selectedClass"></span>, Section <span id="selectedSection"></span>
                </h2>

                <div class="border border-gray-200 rounded overflow-hidden">
                    <div class="max-h-96 overflow-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead class="bg-gray-100 sticky top-0">
                                <tr>
                                    <th class="border border-gray-300 p-2">S.N</th>
                                    <th class="border border-gray-300 p-2">Name</th>
                                    <th class="border border-gray-300 p-2">Roll No</th>
                                    <th class="border border-gray-300 p-2">Status</th>
                                </tr>
                            </thead>
                            <tbody id="studentTableBody"></tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('web.student.newstudentstable')
    @include('web.student.create')

    <script>
        $(document).ready(function() {
            let students = [];

            // Function to load students based on filters
            function loadStudents(selectedClass, selectedSection) {
                $.ajax({
                    url: `/api/v1/students`,
                    method: "GET",
                    data: {
                        'class[eq]': selectedClass,
                        'section[eq]': selectedSection
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response.data);
                        students = response.data;
                        renderTable(students);
                    },
                    error: function(error) {
                        console.error("Error fetching students:", error);
                    }
                });
            }


            // Update the table when the class or section changes
            function updateTable() {
                let selectedClass = $("#classSelect").val();
                let selectedSection = $("#sectionSelect").val();

                if (selectedClass && selectedSection) {
                    $("#selectedClass").text(selectedClass);
                    $("#selectedSection").text(selectedSection);
                    $("#studentTableContainer").removeClass("hidden");
                    loadStudents(selectedClass, selectedSection); // Reload students with filters
                } else {
                    $("#studentTableContainer").addClass("hidden");
                }
            }

            // Render the student table
            function renderTable(data) {
                let order = $("#sortOrder").val();
                let searchTerm = $("#searchInput").val().toLowerCase();

                // Sorting Logic
                let sortedData = [...data].sort((a, b) => {
                    if (order.includes("name")) {
                        return order === "name-asc" ? a.firstName.localeCompare(b.firstName) : b.firstName
                            .localeCompare(a
                                .firstName);
                    } else if (order.includes("class")) {
                        return order === "class-asc" ? a.class - b.class : b.class - a.class;
                    } else if (order.includes("status")) {
                        return order === "status-asc" ? (a.status === "Active" ? -1 : 1) : (a.status ===
                            "Active" ? 1 : -1);
                    }
                    return 0;
                });

                // Search Filter (by Name or Roll No)
                let filteredData = sortedData.filter(student =>
                    student.firstName.toLowerCase().includes(searchTerm) ||
                    student.class.toString().includes(searchTerm)
                );

                $("#studentTableBody").html("");
                filteredData.forEach((student, index) => {
                    $("#studentTableBody").append(`
                            <tr>
                                <td class="border border-gray-300 p-2">${index + 1}</td>
                                <td class="border border-gray-300 p-2">${student.firstName} ${student.secondName}</td>
                                <td class="border border-gray-300 p-2">${student.rollNumber}</td>
                                <td class="border border-gray-300 p-2">${student.status}</td>
                            </tr>
                        `);
                });
            }

            // Event Listeners
            $("#classSelect").change(function() {
                const selectedClass = $(this).val();
                if (selectedClass) {
                    $("#sectionSelect").prop("disabled",
                        false); // Enable section dropdown when class is selected
                } else {
                    $("#sectionSelect").prop("disabled",
                        true); // Disable section dropdown when no class is selected
                }
                updateTable();
            });

            $("#sectionSelect").change(updateTable);
            $("#searchInput").on("input", function() {
                renderTable(students);
            });
            $("#sortOrder").change(function() {
                renderTable(students);
            });
        });
    </script>

</x-web-layout>
