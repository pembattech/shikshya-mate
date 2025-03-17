<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #D3D1CB;
        }
    </style>
</head>

<body>
    <div class="min-h-screen bg-white font-sans">
        <div class="flex">

            <div class="bg-white text-[#5f5e5b] text-base w-52 relative">
                <div class="top-14 absolute border-t border-r border-b rounded-tr-lg rounded-br-lg border-gray-200 w-full p-4">

                        <div id="dashboard-btn" class="parent-menu p-2 hover:bg-gray-100 hover:text-[#1d1b16] rounded-lg">
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                        </div>

                        <div class="mb-2">
                            <button id="student-menu-btn"
                                class="parent-menu w-full text-left p-2 hover:bg-gray-100 hover:text-[#1d1b16] rounded-lg">
                                Student <span id="student-arrow" class="inline-block ml-2">▼</span>
                            </button>
                            <div id="student-menu" class="sub-menu-container ml-4 hidden">
                                <div class="p-1 hover:bg-gray-100 hover:text-[#1d1b16] rounded-lg submenu"><a
                                        href="{{ route('student.index') }}">Student List</a></div>
                                <div class="p-1 hover:bg-gray-100 hover:text-[#1d1b16] rounded-lg submenu">Print Data</div>
                                <div class="p-1 hover:bg-gray-100 hover:text-[#1d1b16] rounded-lg submenu">Bulk Edit</div>
                                <div class="p-1 hover:bg-gray-100 hover:text-[#1d1b16] rounded-lg submenu">Bus Student</div>
                                <div class="p-1 hover:bg-gray-100 hover:text-[#1d1b16] rounded-lg submenu">Admin Card</div>
                                <div class="p-1 hover:bg-gray-100 hover:text-[#1d1b16] rounded-lg submenu">ID Card</div>
                                <div class="p-1 hover:bg-gray-100 hover:text-[#1d1b16] rounded-lg submenu">Certificate</div>
                                <div class="p-1 hover:bg-gray-100 hover:text-[#1d1b16] rounded-lg submenu">Routine</div>
                            </div>
                        </div>
                        <div id="attendance-btn" class="parent-menu p-2 hover:bg-gray-100 hover:text-[#1d1b16] rounded-lg">
                            Attendance
                        </div>
                        <di class="mb-2">
                            <button id="notification-menu-btn"
                                class="parent-menu w-full text-left p-2 hover:bg-gray-100 hover:text-[#1d1b16] rounded-lg">
                                Notification <span id="notification-arrow" class="inline-block ml-2">▼</span>
                            </button>
                            <div id="notification-menu" class="sub-menu-container ml-4 hidden">
                                <div class="p-1 hover:bg-gray-100 hover:text-[#1d1b16] rounded-lg submenu">Push Notification</div>
                                <div class="p-1 hover:bger:text-[#1d1b16] submenu" gray-100 ho>SMS Notification</div>
                            </div>
                        </di shadow-lg rounded-lg border border-gray-200 gray-100 ho">
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {

                    $('[id$="-btn"]').click(function() {
                        let targetMenu = '#' + $(this).attr('id').replace('-btn', '');
                        console.log(targetMenu);

                        let arrow = $(this).find('span');
                        console.log(arrow)
                        if (arrow.length) {
                            $(targetMenu).toggleClass('hidden');
                            arrow.text(arrow.text() === '▼' ? '▲' : '▼');
                        } else {
                            $('.submenu').removeClass('bg-gray-100 text-[#1d1b16]');
                            $('.parent-menu').removeClass('bg-gray-100 text-[#1d1b16]');
                            $(this).addClass('bg-gray-100 text-[#1d1b16]');
                        }
                    });

                    // Toggle submenu active state
                    $('.submenu').click(function() {
                        $('.submenu').removeClass('bg-gray-100 text-[#1d1b16]');
                        $(this).addClass('bg-gray-100 text-[#1d1b16]');

                        // Find the closest parent button and mark it as active
                        let parentBtn = $(this).closest('.sub-menu-container').prev();
                        $('.parent-menu').removeClass('bg-gray-100 text-[#1d1b16]');
                        parentBtn.addClass('bg-gray-100 text-[#1d1b16]');

                    });
                });
            </script>

            <div class="main-container w-full p-4 min-h-screen">

                {{ $slot }}

            </div>

        </div>

    </div>


    <script>
        $(document).ready(function() {
            let currentHour = new Date().getHours();
            let greeting;

            if (currentHour < 12) {
                greeting = "Good morning";
            } else if (currentHour < 18) {
                greeting = "Good afternoon";
            } else {
                greeting = "Good evening";
            }

            $("#greeting").text(greeting);

            // Attendance Data
            let attendanceData = {
                present: 80, // Example values
                absent: 15,
                late: 5
            };


            let chart = $("#attendanceChart");
            if (chart.length) {

                // Get Context for Chart
                const ctx = chart[0].getContext('2d');

                // Create Pie Chart
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Present', 'Absent', 'Late'],
                        datasets: [{
                            data: [attendanceData.present, attendanceData.absent, attendanceData
                                .late
                            ],
                            backgroundColor: ['#4CAF50', '#FF3B30', '#FFC107'],
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>
