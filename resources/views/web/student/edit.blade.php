<!-- Modal or Form for Editing a Student -->
<div id="editstudent-form"
    class="fixed inset-y-0 right-0 w-96 bg-white shadow-xl p-6 transform translate-x-full transition-transform duration-300">
    {{-- <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 max-h-dvh overflow-auto md:w-96"> --}}
    <h2 class="text-lg font-semibold mb-4 text-center">Edit Student</h2>
    <form id="editStudentForm" class="grid grid-cols-1 md:grid-cols-2 gap-4" novalidate>
        <input type="hidden" name="id" class="std-id">

        <div>
            <label for="edit_first_name" class="block text-sm font-medium text-gray-700">First Name</label>
            <input type="text" id="edit_first_name" name="first_name" class="border p-2 w-full rounded" required>
            <span class="firstname-error error hidden text-red-500 text-sm">First name is required</span>
        </div>

        <div>
            <label for="edit_last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
            <input type="text" id="edit_last_name" name="last_name" class="border p-2 w-full rounded" required>
            <span class="lastname-error error hidden text-red-500 text-sm">Last name is required</span>
        </div>

        <div>
            <label for="edit_date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
            <input type="date" id="edit_date_of_birth" name="date_of_birth" class="border p-2 w-full rounded"
                required>
            <span class="dob-error error hidden text-red-500 text-sm">Date of birth is required</span>
        </div>

        <div>
            <label for="edit_class_id" class="block text-sm font-medium text-gray-700">Class</label>
            <select id="edit_class_id" name="class_id" class="border p-2 w-full rounded">
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
            <span class="class-error error hidden text-red-500 text-sm">Class is required</span>
        </div>

        <div>
            <label for="edit_section_id" class="block text-sm font-medium text-gray-700">Section</label>
            <select id="edit_section_id" name="section_id" class="border p-2 w-full rounded">
                <option value="">Select Section</option>
                <option value="1">Section A</option>
                <option value="2">Section B</option>
            </select>
            <span class="section-error error hidden text-red-500 text-sm">Section is required</span>
        </div>

        <div>
            <label for="edit_roll_number" class="block text-sm font-medium text-gray-700">Roll Number</label>
            <input type="text" id="edit_roll_number" name="roll_number" class="border p-2 w-full rounded">
            <span class="roll-error error hidden text-red-500 text-sm">Roll number is required</span>
        </div>

        <div>
            <label for="edit_address" class="block text-sm font-medium text-gray-700">Address</label>
            <input type="text" id="edit_address" name="address" class="border p-2 w-full rounded" required>
            <span class="address-error error hidden text-red-500 text-sm">Address is required</span>
        </div>

        <div>
            <label for="edit_phone" class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" id="edit_phone" name="phone" class="border p-2 w-full rounded" required>
            <span class="phone-error error hidden text-red-500 text-sm">Phone number is required</span>
            <span class="phone10-error error hidden text-red-500 text-sm">Phone number must be exactly 10
                digits</span>
        </div>

        <div>
            <label for="edit_gender" class="block text-sm font-medium text-gray-700">Gender</label>
            <select id="edit_gender" name="gender" class="border p-2 w-full rounded" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            <span class="gender-error error hidden text-red-500 text-sm">Gender is required</span>
        </div>

        <div>
            <label for="edit_admission_date" class="block text-sm font-medium text-gray-700">Admission Date</label>
            <input type="date" id="edit_admission_date" name="admission_date" class="border p-2 w-full rounded"
                required>
            <span class="admission-error error hidden text-red-500 text-sm">Admission date is required</span>
        </div>

        <div class="flex justify-end gap-4 md:col-span-2">
            <button type="button" class="bg-gray-400 text-white p-2 rounded"
                id="cancelEditStudentButton">Cancel</button>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Update</button>
        </div>
    </form>
    {{-- </div> --}}
</div>

<script>
    $(document).ready(function() {

        function numberToAlphabet(number) {
            let mapping = {
                1: 'A',
                2: 'B',
                3: 'C',
                4: 'D'
            };
            return mapping[number] || null; // Returns null if the number is out of range
        }

        $('.edit-student-button').on('click', function() {
            let student_id = $(this).data('std-id');

            $.ajax({
                url: `/api/v1/students/${student_id}`,
                method: 'GET',
                success: function(response) {
                    if (response.success) {

                        $("#edit_first_name").val(response.student.firstName);
                        $("#edit_last_name").val(response.student.lastName);
                        $("#edit_date_of_birth").val(response.student.dateOfBirth.split(
                            "T")[
                            0]); // Formatting date
                        $("#edit_class_id").val(response.student.class);
                        $("#edit_section_id").val(response.student.section);
                        $("#edit_roll_number").val(response.student.rollNumber);
                        $("#edit_address").val(response.student.address);
                        $("#edit_phone").val(response.student.phone);
                        $("#edit_gender").val(response.student.gender);
                        $("#edit_admission_date").val(response.student.admissionDate);

                    }
                    // TODO: show message when the response return success false.

                    $("#assignclass-form").animate({
                        right: "-100%"
                    }, 300, function() {
                        $(this).hide();
                    });

                    $("#editstudent-form").removeClass('translate-x-full').addClass(
                        'translate-x-0');
                },
                error: function(xhr) {
                    console.log(xhr.responseJSON.errors);
                }
            })

        });

        $('#cancelEditStudentButton').on('click', function() {
            $("#editstudent-form").removeClass('translate-x-0').addClass('translate-x-full');
        });

        $('#editStudentForm').on('submit', function(e) {
            e.preventDefault();
            $('.error').addClass('hidden');

            let isValid = true;

            let formData = {
                id: $('.std-id').val().trim(),
                first_name: $('#edit_first_name').val().trim(),
                last_name: $('#edit_last_name').val().trim(),
                date_of_birth: $('#edit_date_of_birth').val().trim(),
                class_name: $('#edit_class_id').val(),
                section_name: $('#edit_section_id').val(),
                roll_number: $('#edit_roll_number').val().trim(),
                address: $('#edit_address').val().trim(),
                phone: $('#edit_phone').val().trim(),
                gender: $('#edit_gender').val(),
                admission_date: $('#edit_admission_date').val().trim()
            };

            // Validation rules
            if (!formData.first_name) $('.firstname-error').removeClass('hidden'), isValid = false;
            if (!formData.last_name) $('.lastname-error').removeClass('hidden'), isValid = false;
            if (!formData.date_of_birth) $('.dob-error').removeClass('hidden'), isValid = false;
            if (!formData.class_name) $('.class-error').removeClass('hidden'), isValid = false;
            if (!formData.section_name) $('.section-error').removeClass('hidden'), isValid = false;
            if (!formData.roll_number) $('.roll-error').removeClass('hidden'), isValid = false;
            if (!formData.address) $('.address-error').removeClass('hidden'), isValid = false;
            if (!formData.phone) $('.phone-error').removeClass('hidden'), isValid = false;
            else if (!/^\d{10}$/.test(formData.phone)) $('.phone10-error').removeClass('hidden'),
                isValid = false;
            if (!formData.gender) {
                $('.gender-error').removeClass('hidden');
                isValid = false;
            }
            if (!formData.admission_date) $('.admission-error').removeClass('hidden'), isValid = false;

            if (isValid) {
                $.ajax({
                    url: `/api/v1/students/${formData.id}`,
                    method: 'PATCH',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {

                            $('.std-first_name').text(response.data.firstName || 'Null');
                            $('.std-last_name').text(response.data.lastName || 'Null');
                            $('.std-date_of_birth').text(
                                response.data.dateOfBirth ? new Date(response.data
                                    .dateOfBirth)
                                .toLocaleDateString(
                                    'en-US', {
                                        year: 'numeric',
                                        month: 'long',
                                        day: 'numeric'
                                    }) : 'Null'
                            );
                            $('.std-class_name').text(response.data.class || 'Null');
                            $('.std-section_name').text(numberToAlphabet(response.data
                                .section) || 'Null');
                            $('.std-roll_number').text(response.data.rollNumber || 'Null');
                            $('.std-address').text(response.data.address || 'Null');
                            $('.std-phone').text(response.data.phone || 'Null');
                            $('.std-gender').text(response.data.gender || 'Null');
                            $('.std-admission_date').text(response.data.admissionDate ||
                                'Null');
                            $('.std-status').text(response.data.status || 'Null');

                            $("#editstudent-form").removeClass('translate-x-0').addClass(
                                'translate-x-full');
                        }
                        // TODO: show message when the response return success false.
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON.errors;
                        if (errors) {
                            Object.keys(errors).forEach(field => {
                                $('#' + field).closest('div').append(
                                    `<span class="error text-red-500 text-sm">${errors[field][0]}</span>`
                                );
                            });
                        }
                    }
                });
            }
        });
    });
</script>
