<head>
    <title>Students List</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h1>Students List</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody id="students-table">
            <!-- Students will be populated here by AJAX -->
        </tbody>
    </table>

    <div id="student-details"></div>

    <script>
        $(document).ready(function() {
            // Fetch all students and populate the table
            $.ajax({
                url: '/api/v1/students',
                method: 'GET',
                success: function(response) {
                    var studentsTable = $('#students-table');
                    studentsTable.empty();
                    response.data.forEach(function(student) {
                        studentsTable.append(
                            '<tr>' +
                            '<td>' + student.id + '</td>' +
                            '<td>' + student.firstName + ' ' + student.lastName + '</td>' +
                            '<td><button class="details-button" data-id="' + student.id +
                            '">View Details</button></td>' +
                            '</tr>'
                        );
                    });

                    // Attach click event to the new buttons
                    $('.details-button').click(function() {
                        var studentId = $(this).data('id');
                        $.ajax({
                            url: '/api/v1/students/' + studentId,
                            method: 'GET',
                            success: function(response) {
                                // console.log(data)
                                $('#student-details').html(
                                    '<h2>Student Details</h2>' +
                                    '<p>ID: ' + response.data.id + '</p>' +
                                    '<p>Name: ' + response.data.firstName + ' ' + response.data
                                    .lastName + '</p>' +
                                    '<p>Email: ' + response.data.email + '</p>'
                                );
                            }
                        });
                    });
                }
            });
        });
    </script>
</body>
