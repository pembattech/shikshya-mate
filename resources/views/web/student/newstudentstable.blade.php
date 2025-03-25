<div id="newStudentsTableContainer" class="hidden border border-gray-200 rounded p-4 shadow-md mt-4 min-h-96">
    <h2 class="font-semibold text-lg mb-3">
        New Student List
    </h2>

    <div class="border border-gray-200 rounded overflow-hidden">
        <div class="max-h-96 overflow-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-gray-100 sticky top-0">
                    <tr>
                        <th class="border border-gray-300 p-2">S.N</th>
                        <th class="border border-gray-300 p-2">Name</th>
                        <th class="border border-gray-300 p-2">Status</th>
                        <th class="border border-gray-300 p-2">Action</th>
                    </tr>
                </thead>
                <tbody id="newstudentsTableBody"></tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        function displayNewStudents() {
            $.ajax({
                url: `/api/v1/students/pending`,
                method: "GET",
                dataType: "json",
                success: function(response) {
                    console.log(response.data);
                    students = response.data;

                    $("#newStudentsTableContainer").removeClass("hidden");
                    $("#studentTableContainer").addClass("hidden");

                    $("#viewcancelNewStudentButton .viewcancel").text("Cancel New Students");

                    let order = $("#sortOrder").val('name-asc');

                    let searchTerm = $("#searchInput").val().toLowerCase();

                    // Sorting Logic
                    let sortedData = [...students].sort((a, b) => {
                        return a.firstName.localeCompare(b.firstName);
                    });

                    let filteredData = sortedData.filter(student =>
                        student.firstName.toLowerCase().includes(searchTerm)
                    );

                    $("#newstudentsTableBody").html("");
                    filteredData.forEach((student, index) => {
                        $("#newstudentsTableBody").append(`
                            <tr>
                                <td class="border border-gray-300 p-2">${index + 1}</td>
                                <td class="border border-gray-300 p-2">${student.firstName} ${student.lastName}</td>
                                <td class="border border-gray-300 p-2">${student.status}</td>
                                <td class="border border-gray-300 p-2">
                                      <button data-id=${student.slug} class="view-student-button bg-black text-white py-2 px-4 rounded-md hover:rounded-none hover:pl-4 transition-all relative group w-20">
                                        <span class="absolute inset-y-0 left-0 flex items-center opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" aria-hidden="true" class="btn-builtin-icon css-bni7vm"><path fill="currentColor" fill-rule="evenodd" d="M12.522 4.25 20 12l-7.478 7.75-.733-.709 6.302-6.531H4v-1.02h14.09L11.79 4.959z" clip-rule="evenodd"></path></svg></span>
                                        <span class="group-hover:ml-4 transition-all">View</span>
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                },
                error: function(error) {
                    console.error("Error fetching students:", error);
                }
            });
        }


        $('#viewNewStudentButton').on('click', function() {
            displayNewStudents();
            $('#hideNewStudentButton').removeClass('hidden');
            $('#viewNewStudentButton').addClass('hidden');

        });

        $('#hideNewStudentButton').on('click', function() {
            $("#newStudentsTableContainer").addClass("hidden");
            $('#viewNewStudentButton').removeClass('hidden');
            $('#hideNewStudentButton').addClass('hidden');
        });

        $(document).on('click', '.view-student-button', function() {
            let studentId = $(this).data('id');

            window.location.href = `/student/detail/${studentId}`;
        });


    });
</script>
