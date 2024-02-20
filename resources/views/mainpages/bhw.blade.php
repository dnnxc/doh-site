<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')

    <title>Department of Health - BHW</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet"> -->

    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datejs/1.0/date.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="flex flex-col h-screen">
    @include('header')

    <div class="flex flex-row flex-grow p-0 bg-[#E8E8E8] overflow-hidden">
        @include('side_panel')
        <div class="flex w-full flex-col gap-4 overflow-auto">
            <div class="p-4">
                <div class="flex flex-row w-full gap-4 p-2 justify-center">
                    <select id="regionDropdown" class="select select-bordered w-full max-w-xs bg-white text-[#252525]">
                        <option disabled selected>Please select a Region</option>
                        <option>Normal Apple</option>
                        <option>Normal Orange</option>
                        <option>Normal Tomato</option>
                    </select>

                    <select id="cityDropdown"
                        class="select select-bordered w-full max-w-xs bg-white disabled:bg-white disabled:text-[#2c2c2c] disabled:border-none"
                        disabled>
                        <option disabled selected>Please select a Province</option>
                        <option>Normal Apple</option>
                        <option>Normal Orange</option>
                        <option>Normal Tomato</option>
                    </select>

                    <select id="barangayDropdown"
                        class="select select-bordered w-full max-w-xs bg-white disabled:bg-white disabled:text-[#2c2c2c] disabled:border-none"
                        disabled>
                        <option disabled selected>Please select a City</option>
                        <option>Normal Apple</option>
                        <option>Normal Orange</option>
                        <option>Normal Tomato</option>
                    </select>
                </div>

                <div class="flex flex-col gap-4">
                    <div class="card w-full h-[120px] p-4 bg-white shadow-md rounded-md flex flex-col gap-4">
                        <div class="flex flex-row justify-between">
                            <div class="flex flex-col text-[#252525] font-extrabold justify-center">
                                <div class="flex text-xl tracking-wide	">Total number of</div>
                                <div class="flex text-4xl tracking-wide	">BHW</div>
                            </div>
                            <div class="flex items-center justify-center text-[#252525] font-extrabold">
                                <div class="flex text-7xl items-end" style="color: #0e9cdc">10 500</div>
                            </div>
                        </div>
                        <div class="flex items-end justify-end text-xs italic">
                            * Available data as of&nbsp;<span id="yesterdayDate"></span>
                        </div>
                    </div>


                    <div class="flex w-full gap-4 h-[250px]">
                        <div class="card w-full h-full p-4 pb-2 bg-white shadow-md rounded-md gap-2">
                            <div class="flex flex-col h-full w-full">
                                <div class="text-black tracking-wide flex-none font-bold">Age Group</div>
                                <div class="flex-grow h-full flex items-end justify-end pb-2">
                                    <canvas id="ageGroupChart" class="w-full" width="400" height="100"></canvas>
                                </div>
                                <div class="flex-none flex items-end justify-end text-xs italic">
                                    * Available data as of&nbsp;<span id="yesterdayDate2"></span>
                                </div>
                            </div>
                        </div>


                        <div class="card w-full h-full p-4 bg-white shadow-md rounded-md flex flex-row">
                            <div class="flex flex-col h-full w-full">
                                <div class="text-black tracking-wide flex-none font-bold">Sex</div>
                                <div class="flex-grow h-full flex items-end justify-end pb-2">
                                    <canvas id="sexChart" class="w-full" width="400" height="100"></canvas>
                                </div>
                                <div class="flex-none flex items-end justify-end text-xs italic">
                                    * Available data as of&nbsp;<span id="yesterdayDate3"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card w-full h-[340px] p-4 bg-white shadow-md rounded-md flex flex-row gap-2">
                        <div class="flex flex-col h-full w-full gap-3">
                            <div class="text-black tracking-wide flex-none font-bold">Educational Attainment</div>
                            <div class="flex-grow h-full flex items-end justify-end pb-2">
                                <canvas id="educChart" class="w-full" width="400" height="50"></canvas>
                            </div>
                            <div class="flex-none flex items-end justify-end text-xs italic">
                                * Available data as of&nbsp;<span id="yesterdayDate4"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Function to handle region dropdown change
            $('#regionDropdown').change(function() {
                var selectedRegion = $(this).val();
                if (selectedRegion) {
                    $('#cityDropdown, #barangayDropdown').prop('disabled', false);
                } else {
                    $('#cityDropdown').prop('disabled', true).val('').change();
                    $('#barangayDropdown').prop('disabled', true).val('').change();
                }
            });

            // Function to render the age group pie chart
            function renderAgeGroupChart() {
                var ageGroupData = {
                    labels: ["18-29", "30-59", "60 and above"],
                    datasets: [{
                        data: [30, 50, 20], // Sample data, replace with your actual data
                        backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56"]
                    }]
                };

                var ctx = document.getElementById('ageGroupChart').getContext('2d');

                var ageGroupPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: ageGroupData,
                    options: {
                        plugins: {
                            legend: {
                                position: 'left'
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            }

            // Function to render the sex pie chart
            function renderSexChart() {
                var sexData = {
                    labels: ['Male', 'Female'],
                    datasets: [{
                        data: [40, 60], // Sample data, replace with your actual data
                        backgroundColor: ['#36A2EB', '#FF6384'],
                        hoverBackgroundColor: ['#36A2EB', '#FF6384']
                    }]
                };

                var ctx = document.getElementById('sexChart').getContext('2d');

                var sexPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: sexData,
                    options: {
                        plugins: {
                            legend: {
                                position: 'left'
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            }

            // Function to render the educational attainment bar chart
            function renderEducationChart() {
                var educationData = {
                    labels: ["Elementary Level", "Highschool Level", "College Level", "Others"],
                    datasets: [{
                        label: '',
                        data: [20, 30, 40, 10], // Sample data, replace with your actual data
                        backgroundColor: ["#FFCE56", "#FF6384", "#36A2EB", "#4BC0C0"]

                    }]
                };

                var ctx = document.getElementById('educChart').getContext('2d');

                var educationBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: educationData,
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            // Function to set yesterday's date
            function setYesterdayDate() {
                var yesterday = Date.today().addDays(-1);
                var formattedDate = yesterday.toString("MMMM d, yyyy");
                document.getElementById("yesterdayDate").innerText = formattedDate;
                document.getElementById("yesterdayDate2").innerText = formattedDate;
                document.getElementById("yesterdayDate3").innerText = formattedDate;
                document.getElementById("yesterdayDate4").innerText = formattedDate;

            }

            // Call functions to render charts and set date
            renderAgeGroupChart();
            renderSexChart();
            renderEducationChart();
            setYesterdayDate();
        });
    </script>


</body>

</html>
