<x-web-layout>


    <div>

        <p class="p-8 flex items-center justify-center text-3xl font-bold"><span id="greeting"></span>, [full
            name]
        </p>
    </div>

    <div id="dashboard-grid" class="grid grid-cols-3 gap-4 mb-4">
        <!-- Students -->
        <div class="dashboard-card bg-white shadow-lg rounded-lg border border-gray-200 p-4 flex items-center">
            <div class="flex-1">
                <h2 class="text-gray-600 text-sm font-semibold">Students</h2>
                <p class="text-2xl font-bold text-gray-900">1052</p>
                <p class="text-xs text-gray-500">Total Students number</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-lg">
                <img src="icon1.png" class="w-6 h-6" />
            </div>
        </div>

        <!-- Active Student A/c -->
        <div class="dashboard-card bg-white shadow-lg rounded-lg border border-gray-200 p-4 flex items-center">
            <div class="flex-1">
                <h2 class="text-gray-600 text-sm font-semibold">Active Student A/c</h2>
                <p class="text-2xl font-bold text-gray-900">54</p>
                <p class="text-xs text-gray-500">Logged-in Students</p>
            </div>
            <div class="bg-orange-100 p-3 rounded-lg">
                <img src="icon2.png" class="w-6 h-6" />
            </div>
        </div>

        <!-- Bus Students -->
        <div class="dashboard-card bg-white shadow-lg rounded-lg border border-gray-200 p-4 flex items-center">
            <div class="flex-1">
                <h2 class="text-gray-600 text-sm font-semibold">Bus Students</h2>
                <p class="text-2xl font-bold text-gray-900">381</p>
                <p class="text-xs text-gray-500">Total Bus Students number</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-lg">
                <img src="icon3.png" class="w-6 h-6" />
            </div>
        </div>

        <!-- iOS Device -->
        <div class="dashboard-card bg-white shadow-lg rounded-lg border border-gray-200 p-4 flex items-center">
            <div class="flex-1">
                <h2 class="text-gray-600 text-sm font-semibold">iOS Device</h2>
                <p class="text-2xl font-bold text-gray-900">21</p>
                <p class="text-xs text-gray-500">Number of iOS User</p>
            </div>
            <div class="bg-yellow-100 text-white p-3 rounded-lg">
                <img src="icon4.png" class="w-6 h-6" />
            </div>
        </div>

        <!-- Staff -->
        <div class="dashboard-card bg-white shadow-lg rounded-lg border border-gray-200 p-4 flex items-center">
            <div class="flex-1">
                <h2 class="text-gray-600 text-sm font-semibold">Staff</h2>
                <p class="text-2xl font-bold text-gray-900">26</p>
                <p class="text-xs text-gray-500">Number of Staff</p>
            </div>
            <div class="bg-purple-100 p-3 rounded-lg">
                <img src="icon5.png" class="w-6 h-6" />
            </div>
        </div>

        <!-- General Notification -->
        <div class="dashboard-card bg-white shadow-lg rounded-lg border border-gray-200 p-4 flex items-center">
            <div class="flex-1">
                <h2 class="text-gray-600 text-sm font-semibold">General Notification</h2>
                <p class="text-2xl font-bold text-gray-900">58</p>
                <p class="text-xs text-gray-500">Public Notification</p>
            </div>
            <div class="bg-pink-100 p-3 rounded-lg">
                <img src="icon6.png" class="w-6 h-6" />
            </div>
        </div>

        <!-- Staff Notification -->
        <div class="dashboard-card bg-white shadow-lg rounded-lg border border-gray-200 p-4 flex items-center">
            <div class="flex-1">
                <h2 class="text-gray-600 text-sm font-semibold">Staff Notification</h2>
                <p class="text-2xl font-bold text-gray-900">812</p>
                <p class="text-xs text-gray-500">Number of Notifications</p>
            </div>
            <div class="bg-green-100 p-3 rounded-lg">
                <img src="icon7.png" class="w-6 h-6" />
            </div>
        </div>

        <!-- SMS Left -->
        <div class="dashboard-card bg-white shadow-lg rounded-lg border border-gray-200 p-4 flex items-center">
            <div class="flex-1">
                <h2 class="text-gray-600 text-sm font-semibold">SMS Left</h2>
                <p class="text-2xl font-bold text-gray-900">0</p>
                <p class="text-xs text-gray-500">Remaining SMS</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-lg">
                <img src="icon8.png" class="w-6 h-6" />
            </div>
        </div>

        <!-- Custom Notification -->
        <div class="dashboard-card bg-white shadow-lg rounded-lg border border-gray-200 p-4 flex items-center">
            <div class="flex-1">
                <h2 class="text-gray-600 text-sm font-semibold">Custom Notification</h2>
                <p class="text-2xl font-bold text-gray-900">7064</p>
                <p class="text-xs text-gray-500">User Specific Notification</p>
            </div>
            <div class="bg-blue-300 p-3 rounded-lg">
                <img src="icon9.png" class="w-6 h-6" />
            </div>
        </div>
    </div>


    <div class="bg-white shadow-lg rounded-lg border border-gray-200 p-4">
        <!-- <p class="text-[#1d1b16] font-medium">Attendance</p> -->

        <h2 class="text-xl font-semibold text-gray-700 mb-4">📊 Attendance Report</h2>

        <div class="flex gap-4">


            <div class="max-w-lg bg-white shadow-lg rounded-lg border border-gray-200 p-6">
                <canvas id="attendanceChart"></canvas>
            </div>

            <div class="w-full bg-white shadow-lg rounded-lg border border-gray-200 p-6">

                <!-- Tabs -->
                <div class="border-b flex space-x-4">
                    <button
                        class="tab-button active-tab font-semibold text-[#1d1b16] hover:text-[#1d1b16] border-b-2 border-black pb-2"
                        data-target="attendanceTab">Attendance</button>
                    <button class="tab-button text-[#1d1b16] hover:text-[#1d1b16]"
                        data-target="groupAttendanceTab">Group Attendance</button>
                </div>



                <!-- Attendance Content -->
                <div id="attendanceTab" class="tab-content mt-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-[#5f5e5b] font-semibold">Total Attendance Taken: <span
                                id="attendanceCount" class="text-[#1d1b16]">1</span></span>

                        <div class="flex gap-2 items-center px-2 py-1 border rounded">
                            <img src="{{ asset('storage/assets/' . 'icons8-calendar-96.png') }}" alt="calendar-img" class="w-6">
                            <button class="text-sm"> 2023-11-30</button>
                        </div>
                    </div>

                    <table class="w-full border-collapse border border-gray-300 mt-4">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2 text-left">Teacher</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Class</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Present/Late</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Absent</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2 text-blue-600 cursor-pointer">Sabin
                                    Tako</td>
                                <td class="border border-gray-300 px-4 py-2">1, A</td>
                                <td class="border border-gray-300 px-4 py-2">15</td>
                                <td class="border border-gray-300 px-4 py-2">3</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Group Attendance Content -->
                <div id="groupAttendanceTab" class="tab-content mt-4 hidden">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-[#5f5e5b] font-semibold">Total Group: <span id="groupCount"
                                class="text-[#1d1b16]">2</span></span>

                        <div class="flex gap-2 items-center px-2 py-1 border rounded">
                            <img src="./assets/icons8-calendar-96.png" alt="calendar-img" class="w-6">
                            <button class="text-sm"> 2023-11-30</button>
                        </div>
                    </div>

                    <table class="w-full border-collapse border border-gray-300 mt-4">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2 text-left">Group Name</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Students</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Present</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Absent</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">Group A</td>
                                <td class="border border-gray-300 px-4 py-2">20</td>
                                <td class="border border-gray-300 px-4 py-2">18</td>
                                <td class="border border-gray-300 px-4 py-2">2</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">Group B</td>
                                <td class="border border-gray-300 px-4 py-2">15</td>
                                <td class="border border-gray-300 px-4 py-2">12</td>
                                <td class="border border-gray-300 px-4 py-2">3</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- jQuery for Tab Switching -->
            <script>
                $(document).ready(function () {
                    $(".tab-button").click(function () {
                        $(".tab-button").removeClass(
                            "active-tab font-semibold text-gray-700 border-b-2 border-black").addClass(
                                "text-gray-500");
                        $(this).addClass("active-tab font-semibold text-gray-700 border-b-2 border-black")
                            .removeClass("text-gray-500");

                        $(".tab-content").addClass("hidden");
                        $("#" + $(this).data("target")).removeClass("hidden");
                    });
                });
            </script>


        </div>
    </div>



</x-web-layout>
