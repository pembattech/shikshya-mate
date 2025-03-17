<x-web-layout>

    <div class="bg-white shadow-lg rounded-lg border border-gray-200 p-4">
        <div class="space-y-4">
            <!-- Filters and Inputs -->
            <div class="flex flex-wrap gap-4 items-center">
                <select id="classSelect" class="border p-2 rounded w-40">
                    <option value="">Select Class</option>
                    <option value="10">Class 10</option>
                    <option value="11">Class 11</option>
                    <option value="12">Class 12</option>
                </select>

                <select id="sectionSelect" class="border p-2 rounded w-40">
                    <option value="">Select Section</option>
                    <option value="A">Section A</option>
                    <option value="B">Section B</option>
                    <option value="C">Section C</option>
                </select>

                <input type="text" id="searchInput" placeholder="Search by name or roll"
                    class="border p-2 rounded w-40">

                <select id="sortOrder" class="border p-2 rounded">
                    <option value="name-asc">Order By Name (A-Z)</option>
                    <option value="name-desc">Order By Name (Z-A)</option>
                    <option value="roll-asc">Order By Roll No (Ascending)</option>
                    <option value="roll-desc">Order By Roll No (Descending)</option>
                    <option value="status-asc">Order By Status (Active First)</option>
                    <option value="status-desc">Order By Status (Inactive First)</option>
                </select>
            </div>

            <!-- Table Container -->
            <div id="studentTableContainer" class="hidden border rounded p-4 shadow-md mt-4">
                <h2 class="font-semibold text-lg mb-3">
                    Student List - Class <span id="selectedClass"></span>, Section <span id="selectedSection"></span>
                </h2>

                <!-- Table Wrapper -->
                <div class="border rounded overflow-hidden">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border border-gray-300 p-2">ID</th>
                                <th class="border border-gray-300 p-2">Name</th>
                                <th class="border border-gray-300 p-2">Roll No</th>
                                <th class="border border-gray-300 p-2">Status</th>
                            </tr>
                        </thead>
                    </table>

                    <!-- Scrollable tbody -->
                    <div class="max-h-96 overflow-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <tbody id="studentTableBody"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery Script -->
    <script>
        $(document).ready(function() {
            let students = Array.from({
                length: 100
            }, (_, index) => {
                return {
                    id: index + 1,
                    name: `Student ${index + 1}`,
                    roll: index + 1,
                    status: (index % 2 === 0) ? "Active" : "Inactive"
                };
            });

            function updateTable() {
                let selectedClass = $("#classSelect").val();
                let selectedSection = $("#sectionSelect").val();

                if (selectedClass && selectedSection) {
                    $("#selectedClass").text(selectedClass);
                    $("#selectedSection").text(selectedSection);
                    $("#studentTableContainer").removeClass("hidden");
                    renderTable(students);
                } else {
                    $("#studentTableContainer").addClass("hidden");
                }
            }

            function renderTable(data) {
                let order = $("#sortOrder").val();
                let searchTerm = $("#searchInput").val().toLowerCase();

                // Sorting Logic
                let sortedData = [...data].sort((a, b) => {
                    if (order.includes("name")) {
                        return order === "name-asc" ? a.name.localeCompare(b.name) : b.name.localeCompare(a
                            .name);
                    } else if (order.includes("roll")) {
                        return order === "roll-asc" ? a.roll - b.roll : b.roll - a.roll;
                    } else if (order.includes("status")) {
                        return order === "status-asc" ? (a.status === "Active" ? -1 : 1) : (a.status ===
                            "Active" ? 1 : -1);
                    }
                    return 0;
                });

                // Search Filter (by Name or Roll No)
                let filteredData = sortedData.filter(student =>
                    student.name.toLowerCase().includes(searchTerm) ||
                    student.roll.toString().includes(searchTerm)
                );

                $("#studentTableBody").html("");
                filteredData.forEach(student => {
                    $("#studentTableBody").append(`
                            <tr>
                                <td class="border border-gray-300 p-2">${student.id}</td>
                                <td class="border border-gray-300 p-2">${student.name}</td>
                                <td class="border border-gray-300 p-2">${student.roll}</td>
                                <td class="border border-gray-300 p-2">${student.status}</td>
                            </tr>
                        `);
                });
            }

            // Event Listeners
            $("#classSelect, #sectionSelect").change(updateTable);
            $("#searchInput").on("input", () => renderTable(students));
            $("#sortOrder").change(() => renderTable(students));
        });
    </script>

</x-web-layout>
