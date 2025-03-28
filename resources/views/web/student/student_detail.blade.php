<x-web-layout>

    <div class="student-detail p-4 space-y-4 hidden" id="student-detail">

        <h2 class="text-2xl font-bold mb-4">Student Profile</h2>

        <div class="flex gap-4">

            <div class="flex flex-col gap-4">
                <div class="profile-card flex flex-col align-items border border-gray-200 rounded p-4 w-80">

                    <div class="flex justify-center">
                        <img src="https://pembattech.github.io/digital-resume/assets/profile_pic.jpg" alt="profile"
                            class="w-40 h-40 object-cover rounded-full">
                    </div>

                    <div>

                        <h2 class="text-2xl font-semibold mt-4 text-center">
                            <span class="std-first_name"></span>
                            <span class="std-last_name"></span>
                        </h2>

                    </div>


                </div>

                <div class="border border-gray-200 rounded p-4 w-80 space-y-4">

                    <p class="text-black flex justify-between"><strong>Class:</strong> <span
                            class="std-class_name"></span></p>
                    <p class="text-black flex justify-between"><strong>Section:</strong> <span
                            class="std-section_name"></span></p>
                    <p class="text-black flex justify-between"><strong>Roll Number:</strong> <span
                            class="std-roll_number"></span></p>

                </div>


                <button
                    class="edit-student-button w-full bg-black text-white py-2 px-4 rounded-md hover:rounded-none hover:pl-4 transition-all relative group">
                    <span
                        class="absolute inset-y-0 left-20 flex items-center opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24" aria-hidden="true" class="btn-builtin-icon css-bni7vm">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M12.522 4.25 20 12l-7.478 7.75-.733-.709 6.302-6.531H4v-1.02h14.09L11.79 4.959z"
                                clip-rule="evenodd"></path>
                        </svg></span>
                    <span class="group-hover:ml-4 transition-all">Edit Student</span>
                </button>

                <button id="assign-class-button"
                    class="assign-class-button w-full bg-black text-white py-2 px-4 rounded-md hover:rounded-none hover:pl-4 transition-all relative group">
                    <span
                        class="absolute inset-y-0 left-14 flex items-center opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24" aria-hidden="true" class="btn-builtin-icon css-bni7vm">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M12.522 4.25 20 12l-7.478 7.75-.733-.709 6.302-6.531H4v-1.02h14.09L11.79 4.959z"
                                clip-rule="evenodd"></path>
                        </svg></span>
                    <span class="group-hover:ml-4 transition-all">Assign Class Student</span>
                </button>

            </div>


            <div class="border border-gray-200 rounded w-full">

                <!-- Tabs Navigation -->
                <div class="mb-4 border-b border-gray-200">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="tab-list" role="tablist">
                        <li class="me-2" role="presentation">
                            <button class="tab-btn inline-block p-4 border-b-2 rounded-t-lg text-black border-black"
                                data-target="profile-content">Basic Details</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button
                                class="tab-btn inline-block p-4 border-b-2 rounded-t-lg text-gray-500 hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                data-target="parents-detail-content">Parents/Guardian Details</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button
                                class="tab-btn inline-block p-4 border-b-2 rounded-t-lg text-gray-500 hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                data-target="documents-content">Documents</button>
                        </li>
                    </ul>
                </div>

                <!-- Tabs Content -->
                <div id="tab-content">
                    <div class="tab-content p-4 space-y-4" id="profile-content">
                        <p class="text-black"><strong>First Name:</strong> <span class="std-first_name"></span></p>
                        <p class="text-black"><strong>Last Name:</strong> <span class="std-last_name"></span></p>
                        <p class="text-black"><strong>Date of Birth:</strong> <span class="std-date_of_birth"></span>
                        </p>
                        <p class="text-black"><strong>Address:</strong> <span class="std-address"></span></p>
                        <p class="text-black"><strong>Phone:</strong> <span class="std-phone"></span></p>
                        <p class="text-black"><strong>Gender:</strong> <span class="std-gender"></span></p>
                        <p class="text-black"><strong>Admission Date:</strong> <span class="std-admission_date"></span>
                        </p>
                        <p class="text-black"><strong>Status:</strong> <span class="std-status"></span></p>

                    </div>
                    <div class="tab-content hidden p-4" id="parents-detail-content">
                        <p class="text-sm text-gray-500">This is the <strong class="font-medium text-gray-800">Parents
                                or Guardian</strong> tab content.</p>
                    </div>
                    <div class="tab-content hidden p-4" id="documents-content">
                        <p class="text-sm text-gray-500">This is the <strong
                                class="font-medium text-gray-800">Documents</strong> tab content.</p>
                    </div>
                </div>

                <!-- Sliding Form Container -->
                <div id="assignclass-form" class="fixed top-1/12 right-0 w-96 h-fit bg-white shadow-lg p-6 hidden">
                    <h2 class="text-xl font-semibold mb-4">Assign Student to Class</h2>
                    <form class="space-y-4" id="assign-class-form" novalidate>

                        <input type="hidden" name="id" class="std-id">

                        <div>

                            <label for="class_name" class="block text-sm font-medium text-gray-700">Class</label>
                            <select id="class_name" name="class_name" class="border p-2 w-full rounded">
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
                            <label for="section_name" class="block text-sm font-medium text-gray-700">Section</label>
                            <select id="section_name" name="section_name" class="border p-2 w-full rounded">
                                <option value="">Select Section</option>
                                <option value="1">Section A</option>
                                <option value="2">Section B</option>
                            </select>
                            <span class="section-error error hidden text-red-500 text-sm">Section is required</span>
                        </div>

                        <button type="submit"
                            class="w-full bg-black text-white py-2 px-4 rounded-md hover:bg-gray-800">Submit</button>
                    </form>

                    <!-- Close Button -->
                    <button id="closeForm" class="absolute top-4 right-4 text-gray-500 hover:text-black">✖</button>
                </div>
            </div>

            <!-- jQuery for Tabs -->
            <script>
                $(document).ready(function() {
                    $(".tab-btn").click(function() {
                        // Remove active styles from all tabs
                        $(".tab-btn").removeClass("text-black border-black").addClass("text-gray-500");

                        // Hide all tab content
                        $(".tab-content").addClass("hidden");

                        // Add active styles to clicked tab
                        $(this).addClass("text-black border-black").removeClass("text-gray-500");

                        // Show the corresponding content
                        $("#" + $(this).data("target")).removeClass("hidden");
                    });
                });
            </script>

        </div>
    </div>

    @include('web.student.edit')

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

            const slug = window.location.href.split("/student/detail/")[1];
            let baseUrl = window.location.origin;

            $.ajax({
                url: `/api/v1/students/${slug}`,
                method: 'GET',
                success: function(data) {
                    if (data.success) {

                        $('.std-first_name').text(data.student.firstName || 'Null');
                        $('.std-last_name').text(data.student.lastName || 'Null');
                        $('.std-date_of_birth').text(
                            data.student.dateOfBirth ? new Date(data.student.dateOfBirth)
                            .toLocaleDateString(
                                'en-US', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                }) : 'Null'
                        );
                        $('.std-class_name').text(data.student.class || 'Null');
                        $('.std-section_name').text(numberToAlphabet(data.student.section) || 'Null');
                        $('.std-roll_number').text(data.student.rollNumber || 'Null');
                        $('.std-address').text(data.student.address || 'Null');
                        $('.std-phone').text(data.student.phone || 'Null');
                        $('.std-gender').text(data.student.gender || 'Null');
                        $('.std-admission_date').text(data.student.admissionDate || 'Null');
                        $('.std-status').text(data.student.status || 'Null');

                        // appending slug to the form
                        $('.std-id').val(slug);

                        $(".edit-student-button").attr("data-std-id", slug);

                        $('#student-detail').removeClass('hidden');

                    }
                    // TODO: show message when the response return success false.
                },
                error: function(error) {
                    console.log('Error fetching student data:', error);
                }
            });

            $("#assign-class-button").click(function() {
                $("#assignclass-form").css({
                    right: "-100%"
                }).show().animate({
                    right: "0"
                }, 300);

                $("#editstudent-form").removeClass('translate-x-0').addClass('translate-x-full');
            });

            $("#closeForm").click(function() {
                $("#assignclass-form").animate({
                    right: "-100%"
                }, 300, function() {
                    $(this).hide();
                });
            });

            $("#assign-class-form").submit(function(event) {
                event.preventDefault();

                let formData = {
                    id: $(".std-id").val(),
                    class_name: $("#class_name").val(),
                    section_name: $("#section_name").val(),
                    status: 'approved'
                };

                $(".error").addClass("hidden");

                // Client-side validation
                let isValid = true;
                if (!formData.class_name) {
                    $(".class-error").removeClass("hidden");
                    isValid = false;
                }
                if (!formData.section_name) {
                    $(".section-error").removeClass("hidden");
                    isValid = false;
                }
                if (!isValid) return;

                console.table(formData);
                // AJAX request
                $.ajax({
                    url: `${baseUrl}/api/v1/students/${formData.id}`,
                    type: "patch",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {

                            $(".std-class_name").text(response.data.class);
                            $(".std-section_name").text(numberToAlphabet(response.data
                                .section));
                            $(".std-status").text(response.data.status);

                            $("#assignclass-form").animate({
                                right: "-100%"
                            }, 300, function() {
                                $(this).hide();
                            });
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON?.errors;
                        if (errors) {
                            if (errors.class_name) $(".class-error").text(errors.class_name[0])
                                .removeClass("hidden");
                            if (errors.section_name) $(".section-error").text(errors
                                .section_name[
                                    0]).removeClass("hidden");
                        } else {
                            alert("Server error. Please try again.");
                        }
                    }
                });
            });
        });
    </script>
</x-web-layout>
