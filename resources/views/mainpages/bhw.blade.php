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

    <style>
        .spinner {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 4px solid #ccc;
            border-top-color: #333;
            animation: spin 1s linear infinite;
            margin: 0 auto;
            /* Center the spinner horizontally */
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="flex flex-col h-screen">
    @include('header')

    <div class="flex flex-row flex-grow p-0 bg-[#E8E8E8] overflow-hidden">
        @include('side_panel')
        <div class="flex p-4 w-full flex-col gap-4 overflow-auto">
            <div class="flex flex-row w-full gap-4 p-2 justify-center">
                <select id="regionDropdown" class="select select-bordered text-black w-full max-w-xs bg-white ">
                    <option disabled selected>Please select a Region</option>
                    <option value="all">Show All Regions</option>
                    @foreach ($regions as $region)
                        <option>{{ $region }}</option>
                    @endforeach
                </select>

                <select id="provinceDropdown"
                    class="select select-bordered w-full max-w-xs bg-white text-black disabled:bg-white disabled:text-[#2c2c2c] disabled:border-none"
                    disabled>
                    <option disabled selected>Please select a Province</option>
                </select>

                <select id="cityDropdown"
                    class="select select-bordered w-full max-w-xs bg-white text-black disabled:bg-white disabled:text-[#2c2c2c] disabled:border-none"
                    disabled>
                    <option disabled selected>Please select a City</option>
                </select>
            </div>

            <div class="h-full w-full flex justify-center bg-white ">
                <button type="button" id="loadingScreen"
                    class=" items-center px-4 gap-4 flex py-2 font-semibold leading-6 text-sm shadow rounded-md text-red-500 bg-indigo-500 hover:bg-indigo-400 transition ease-in-out duration-150 cursor-not-allowed"
                    disabled="">
                    <div class="spinner"></div>
                    Processing...
                </button>
            </div>




            <div id="chartsContainer" class="hidden">
                <div class="flex flex-col gap-4">
                    <div class="card w-full h-[120px] p-4 bg-white shadow-md rounded-md flex flex-col gap-4">
                        <div class="flex flex-row justify-between">
                            <div class="flex flex-col text-[#252525] font-extrabold justify-center">
                                <div class="flex text-xl tracking-wide ">Total number of</div>
                                <div class="flex text-4xl tracking-wide ">BHW</div>
                            </div>
                            <div class="flex items-center justify-center text-[#252525] font-extrabold">
                                <div id="totalPopulation" class="flex text-7xl items-end" style="color: #0e9cdc"></div>
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
    </div>


    <script>
        var ageGroupPieChart;
        var sexPieChart;
        var educationBarChart;
        $(document).ajaxStart(function() {
            $('#loadingOverlay').show();
        });

        $(document).ajaxStop(function() {
            $('#loadingOverlay').hide();
        });


        $(document).ready(function() {
            function showCharts() {
                $('#loadingScreen').hide();
                $('#chartsContainer').show();
            }

            // Function to handle region dropdown change
            $('#regionDropdown').change(function() {
                // Hide charts and show loading screen
                $('#chartsContainer').hide();
                $('#loadingScreen').show();

                var selectedRegion = $(this).val();
                var population = 0;
                var maleCount = 0;
                var femaleCount = 0;
                var othersCount = 0;
                var elementaryCount = 0;
                var high_schoolCount = 0;
                var collegeCount = 0;
                var age_18_29Count = 0;
                var age_30_59Count = 0;
                var age_60_aboveCount = 0;
                if (selectedRegion === 'all') {
                    getInfo();
                    showCharts(); // Show charts after successful data retrieval
                    $('#provinceDropdown').empty();
                    $('#provinceDropdown').append('<option disabled selected>Please select a Province</option>');
                    $('#cityDropdown').empty();
                    $('#cityDropdown').append('<option disabled selected>Please select a City</option>');
                    $('#provinceDropdown').prop('disabled', true);
                    $('#cityDropdown').prop('disabled', true);
                    return;
                } else if (selectedRegion) {
                    $('#provinceDropdown').prop('disabled', false);
                    $('#cityDropdown').prop('disabled', true);
                    $('#cityDropdown').empty();
                    $('#cityDropdown').append('<option disabled selected>Please select a City</option>');
                    $.ajax({
                    url: '/get-provinces-bhw/' + selectedRegion,
                    type: 'GET',
                    success: function(data) {
                        $('#provinceDropdown').empty();
                        $('#provinceDropdown').append('<option disabled selected>Please select a Province</option>');
                        $.ajax({
                            url: '/get-info-bhw',
                            type: 'GET',
                            success: function(data){
                                var regionBHWInfo = data.filter(function(item) {
                                    return item.region === selectedRegion;
                                });
                                regionBHWInfo.forEach(function(item) {
                                    population += item.population;
                                    maleCount += item.male;
                                    femaleCount += item.female;
                                    elementaryCount += item.elementary;
                                    high_schoolCount += item.high_school;
                                    collegeCount += item.college;
                                    othersCount += item.others;
                                    age_18_29Count += item.age_18_29;
                                    age_30_59Count += item.age_30_59;
                                    age_60_aboveCount += item.age_60_above;
                                });
                                renderAgeGroupChart(age_18_29Count, age_30_59Count, age_60_aboveCount);
                                renderSexChart(maleCount, femaleCount);
                                renderEducationChart(elementaryCount, high_schoolCount, collegeCount, othersCount);
                                $('#totalPopulation').text(population.toLocaleString());
                                showCharts(); // Show charts after successful data retrieval
                            }
                        });
                        $.each(data, function(key, value) {
                            $('#provinceDropdown').append('<option>' + value + '</option>');
                        });
                     }
                 });
                } else {
                    $('#provinceDropdown').prop('disabled', true).val('').change();
                    $('#cityDropdown').prop('disabled', true).val('').change();
                }
            });

            // Function to handle province dropdown change
            $('#provinceDropdown').change(function() {
                // Hide charts and show loading screen
                $('#chartsContainer').hide();
                $('#loadingScreen').show();

                var selectedProvince = $(this).val();
                var population = 0;
                var maleCount = 0;
                var femaleCount = 0;
                var othersCount = 0;
                var elementaryCount = 0;
                var high_schoolCount = 0;
                var collegeCount = 0;
                var age_18_29Count = 0;
                var age_30_59Count = 0;
                var age_60_aboveCount = 0;
                if (selectedProvince) {
                    $('#cityDropdown').prop('disabled', false);
                    $.ajax({
                        url: '/get-cities-bhw/' + selectedProvince,
                        type: 'GET',
                        success: function(data) {
                            $('#cityDropdown').empty();
                            // $('#cityDropdown').append(
                            //     '<option disabled selected>Please select a City</option>');
                            $.ajax({
                                url: '/get-info-bhw',
                                type: 'GET',
                                success: function(data) {
                                    $('#cityDropdown').prop('disabled', false);
                                    var provinceBHWInfo = data.filter(function(
                                        item) {
                                        return item.province ===
                                            selectedProvince;
                                    });
                                    provinceBHWInfo.forEach(function(item) {
                                        population += item.population;
                                        maleCount += item.male;
                                        femaleCount += item.female;
                                        elementaryCount += item.elementary;
                                        high_schoolCount += item
                                            .high_school;
                                        collegeCount += item.college;
                                        othersCount += item.others;
                                        age_18_29Count += item.age_18_29;
                                        age_30_59Count += item.age_30_59;
                                        age_60_aboveCount += item
                                            .age_60_above;
                                    });
                                    renderAgeGroupChart(age_18_29Count, age_30_59Count, age_60_aboveCount);
                                    renderSexChart(maleCount, femaleCount);
                                    renderEducationChart(elementaryCount, high_schoolCount, collegeCount, othersCount);
                                    $('#totalPopulation').text(population.toLocaleString());
                                    showCharts(); // Show charts after successful data retrieval
                                }
                            });
                            $.each(data, function(key, value) {
                                $('#cityDropdown').append('<option>' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#cityDropdown').prop('disabled', true).val('').change();
                }
            });

            // Function to handle city dropdown change
            $('#cityDropdown').change(function() {
                // Hide charts and show loading screen
                $('#chartsContainer').hide();
                $('#loadingScreen').show();

                var selectedCity = $(this).val();
                var population = 0;
                var maleCount = 0;
                var femaleCount = 0;
                var othersCount = 0;
                var elementaryCount = 0;
                var high_schoolCount = 0;
                var collegeCount = 0;
                var age_18_29Count = 0;
                var age_30_59Count = 0;
                var age_60_aboveCount = 0;
                if (selectedCity) {
                    $.ajax({
                        url: '/get-info-bhw',
                        type: 'GET',
                        success: function(data) {
                            var cityBHWInfo = data.filter(function(item) {
                                return item.city === selectedCity;
                            });
                            cityBHWInfo.forEach(function(item) {
                                population += item.population;
                                maleCount += item.male;
                                femaleCount += item.female;
                                elementaryCount += item.elementary;
                                high_schoolCount += item.high_school;
                                collegeCount += item.college;
                                othersCount += item.others;
                                age_18_29Count += item.age_18_29;
                                age_30_59Count += item.age_30_59;
                                age_60_aboveCount += item.age_60_above;
                            });
                            renderAgeGroupChart(age_18_29Count, age_30_59Count, age_60_aboveCount);
                            renderSexChart(maleCount, femaleCount);
                            renderEducationChart(elementaryCount, high_schoolCount, collegeCount, othersCount);
                            $('#totalPopulation').text(population.toLocaleString());
                            showCharts(); // Show charts after successful data retrieval
                        }
                    });
                }
            });


            // Function to render the age group pie chart
            function renderAgeGroupChart(age_18_29Count, age_30_59Count, age_60_aboveCount) {
                if (ageGroupPieChart) {
                    ageGroupPieChart.destroy(); // Destroy existing chart instance
                }
                var ageGroupData = {
                    labels: ["18-29", "30-59", "60 and above"],
                    datasets: [{
                        data: [age_18_29Count, age_30_59Count,
                            age_60_aboveCount
                        ], // Sample data, replace with your actual data
                        backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56"]
                    }]
                };

                var ctx = document.getElementById('ageGroupChart').getContext('2d');

                ageGroupPieChart = new Chart(ctx, {
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
            function renderSexChart(maleCount, femaleCount) {
                if (sexPieChart) {
                    sexPieChart.destroy(); // Destroy existing chart instance
                }
                var sexData = {
                    labels: ['Male', 'Female'],
                    datasets: [{
                        data: [maleCount, femaleCount], // Sample data, replace with your actual data
                        backgroundColor: ['#36A2EB', '#FF6384'],
                        hoverBackgroundColor: ['#36A2EB', '#FF6384']
                    }]
                };

                var ctx = document.getElementById('sexChart').getContext('2d');

                sexPieChart = new Chart(ctx, {
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
            function renderEducationChart(elementaryCount, high_schoolCount, collegeCount, othersCount) {
                if (educationBarChart) {
                    educationBarChart.destroy(); // Destroy existing chart instance
                }
                var educationData = {
                    labels: ["Elementary Level", "Highschool Level", "College Level", "Others"],
                    datasets: [{
                        label: '',
                        data: [elementaryCount, high_schoolCount, collegeCount,
                            othersCount
                        ], // Sample data, replace with your actual data
                        backgroundColor: ["#FFCE56", "#FF6384", "#36A2EB", "#4BC0C0"]

                    }]
                };

                var ctx = document.getElementById('educChart').getContext('2d');

                educationBarChart = new Chart(ctx, {
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

            function getInfo() {
                var population = 0;
                var maleCount = 0;
                var femaleCount = 0;
                var othersCount = 0;
                var elementaryCount = 0;
                var high_schoolCount = 0;
                var collegeCount = 0;
                var age_18_29Count = 0;
                var age_30_59Count = 0;
                var age_60_aboveCount = 0;
                $.ajax({
                    url: '/get-info-bhw',
                    type: 'GET',
                    success: function(data) {
                        data.forEach(function(item) {
                            population += item.population;
                            maleCount += item.male;
                            femaleCount += item.female;
                            elementaryCount += item.elementary;
                            high_schoolCount += item.high_school;
                            collegeCount += item.college;
                            othersCount += item.others;
                            age_18_29Count += item.age_18_29;
                            age_30_59Count += item.age_30_59;
                            age_60_aboveCount += item.age_60_above;
                        });
                        renderAgeGroupChart(age_18_29Count, age_30_59Count, age_60_aboveCount);
                        renderSexChart(maleCount, femaleCount);
                        renderEducationChart(elementaryCount, high_schoolCount, collegeCount,
                            othersCount);
                        $('#totalPopulation').text(population.toLocaleString());
                        showCharts(); // Show charts after successful data retrieval
                    }
                });
            }

            getInfo();
            setYesterdayDate();
        });
    </script>


</body>

</html>
