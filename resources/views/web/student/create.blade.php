<!-- Modal or Form for Adding a Student -->
<div id="addStudentModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 max-h-dvh overflow-auto md:w-96">
        <h2 class="text-lg font-semibold mb-4 text-center">Add New Student</h2>
        <form id="addStudentForm" class="grid grid-cols-1 md:grid-cols-2 gap-4" novalidate>

            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" id="first_name" name="first_name" class="border p-2 w-full rounded" required>
                <span class="firstname-error error hidden text-red-500 text-sm">First name is required</span>
            </div>

            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" id="last_name" name="last_name" class="border p-2 w-full rounded" required>
                <span class="lastname-error error hidden text-red-500 text-sm">Last name is required</span>
            </div>

            <div>
                <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" id="date_of_birth" name="date_of_birth" class="border p-2 w-full rounded"
                    required>
                <span class="dob-error error hidden text-red-500 text-sm">Date of birth is required</span>
            </div>

            {{-- <div>
                <label for="class_id" class="block text-sm font-medium text-gray-700">Class</label>
                <select id="class_id" name="class_id" class="border p-2 w-full rounded">
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
                <label for="section_id" class="block text-sm font-medium text-gray-700">Section</label>
                <select id="section_id" name="section_id" class="border p-2 w-full rounded">
                    <option value="">Select Section</option>
                    <option value="A">Section A</option>
                    <option value="B">Section B</option>
                </select>
                <span class="section-error error hidden text-red-500 text-sm">Section is required</span>
            </div>

            <div>
                <label for="roll_number" class="block text-sm font-medium text-gray-700">Roll Number</label>
                <input type="text" id="roll_number" name="roll_number" class="border p-2 w-full rounded">
                <span class="roll-error error hidden text-red-500 text-sm">Roll number is required</span>
            </div> --}}

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" id="address" name="address" class="border p-2 w-full rounded" required>
                <span class="address-error error hidden text-red-500 text-sm">Address is required</span>
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" id="phone" name="phone" class="border p-2 w-full rounded" required>
                <span class="phone-error error hidden text-red-500 text-sm">Phone number is required</span>
                <span class="phone10-error error hidden text-red-500 text-sm">Phone number must be exactly 10
                    digits</span>
            </div>

            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                <select id="gender" name="gender" class="border p-2 w-full rounded" required>
                    <option value="" disabled selected>Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                <span class="gender-error error hidden text-red-500 text-sm">Gender is required</span>
            </div>

            <div>
                <label for="admission_date" class="block text-sm font-medium text-gray-700">Admission Date</label>
                <input type="date" id="admission_date" name="admission_date" class="border p-2 w-full rounded"
                    required>
                <span class="admission-error error hidden text-red-500 text-sm">Admission date is required</span>
            </div>

            <div class="flex justify-end gap-4 md:col-span-2">
                <button type="button" class="bg-gray-400 text-white p-2 rounded"
                    id="cancelAddStudentButton">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#addStudentButton').on('click', function() {
            $('#addStudentModal').removeClass('hidden');
            $('.error').addClass('hidden'); // Reset errors
        });

        $('#cancelAddStudentButton').on('click', function() {
            $('#addStudentModal').addClass('hidden');
        });

        $('#addStudentForm').on('submit', function(e) {
            e.preventDefault();

            $('.error').addClass('hidden');

            let isValid = true;
            const formData = {
                first_name: $('#first_name').val().trim(),
                last_name: $('#last_name').val().trim(),
                date_of_birth: $('#date_of_birth').val().trim(),
                // class_id: $('#class_id').val(),
                // section_id: $('#section_id').val(),
                // roll_number: $('#roll_number').val().trim(),
                address: $('#address').val().trim(),
                phone: $('#phone').val().trim(),
                gender: $('#gender').val(),
                admission_date: $('#admission_date').val().trim(),
                status: 'pending'
            };

            // Validation rules
            if (!formData.first_name) $('.firstname-error').removeClass('hidden'), isValid = false;
            if (!formData.last_name) $('.lastname-error').removeClass('hidden'), isValid = false;
            if (!formData.date_of_birth) $('.dob-error').removeClass('hidden'), isValid = false;
            // if (!formData.class_id) $('.class-error').removeClass('hidden'), isValid = false;
            // if (!formData.section_id) $('.section-error').removeClass('hidden'), isValid = false;
            // if (!formData.roll_number) $('.roll-error').removeClass('hidden'), isValid = false;
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
                    url: '/api/v1/students',
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    success: function(response) {
                        if (response.success) {

                            console.log(response);
                            $('#addStudentModal').addClass('hidden');

                            // Reset form
                            $('#addStudentForm').trigger('reset');

                            window.location.href = `/student/detail/${response.student.slug}`;

                        }

                        // TODO: Handle success == false case
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON.errors;
                        if (errors) {
                            Object.keys(errors).forEach(field => {
                                $('#' + field)
                                    .closest('div')
                                    .append(
                                        `<span class="error text-red-500 text-sm">${errors[field][0]}</span>`
                                    );
                            });
                        }
                    }
                });
            }
        });

        // Clear error on input change
        $('#addStudentForm input, #addStudentForm select').on('input', function() {
            $(this).siblings('.error').addClass('hidden');
        });
    });
</script>
