<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')

    <title>Department of Health - GIDA</title>
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

<body class="flex flex-col h-screen ">
    @include('header')

    <div class="flex flex-row flex-grow p-0 bg-[#E8E8E8] overflow-hidden">
        @include('side_panel')
        <div class="flex w-full flex-col gap-4 overflow-auto h-full">

            <div class="p-4">
                <div class="flex flex-col w-full h-full gap-4 p-2">
                    <div class="flex flex-row gap-4 items-center justify-center">
                        <select id="regionDropdown"
                            class="select select-bordered w-full max-w-xs bg-white text-[#252525]">
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

                        <select id="barangayDropdown"
                            class="select select-bordered w-full max-w-xs bg-white text-black disabled:bg-white disabled:text-[#2c2c2c] disabled:border-none"
                            disabled>
                            <option disabled selected>Please select a Barangay</option>
                        </select>
                    </div>



                    <div id="gidaBody" class="flex flex-col gap-3">
                        <div class="flex items-center text-black gap-3">
                            Filter:
                            <div class="dropdown relative grid items-center" style="position: relative">
                                <button class="dropdown-toggle bg-white rounded-lg " type="button" id="filterDropdown"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{-- <i class="fas fa-filter"></i> --}}
                                    <x-ri-filter-fill class="text-black h-[30px] p-2" />
                                </button>
                                <div class="dropdown-menu absolute hidden rounded-lg shadow-2xl z-[9999]"
                                    aria-labelledby="filterDropdown"
                                    style="top: 35px; right: 0; left: 10px; z-index: 1000; width: 220px; background-color: #f9f3f3">
                                    <form id="filterForm" class="p-4 shadow-lg">
                                        <div class="form-check">
                                            <input class="radio form-check-input" type="radio" name="filter"
                                                id="filterA" value="2023" checked>
                                            <label class="form-check-label" for="filterA">
                                                2023
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="radio form-check-input" type="radio" name="filter"
                                                id="filterB" value="2022">
                                            <label class="form-check-label" for="filterB">
                                                2022
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="radio form-check-input" type="radio" name="filter"
                                                id="filterC" value="2021">
                                            <label class="form-check-label" for="filterC">
                                                2021
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="radio form-check-input" type="radio" name="filter"
                                                id="filterD" value="2020">
                                            <label class="form-check-label" for="filterD">
                                                2020
                                            </label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="flex flex-row gap-2">
                            <div class="card w-full h-full p-4 pb-2 bg-white shadow-md rounded-md gap-2">
                                <div class="flex flex-col h-full w-full">
                                    <div class="flex flex-row w-full justify-between h-full items-center">
                                        <div class="text-black tracking-wide flex-none font-bold">Total Population in
                                            GIDA
                                        </div>
                                        <div class="flex items-center justify-center text-[#252525] font-bold">
                                            <div class="flex text-4xl items-end" style="color: #0e9cdc"
                                                id="totalPopulation"></div>
                                        </div>
                                    </div>
                                    {{-- <div class="flex-none flex items-end justify-end text-xs italic">
                                        * Available data as of&nbsp;<span id="gida_date_1"></span>
                                    </div> --}}
                                </div>
                            </div>

                            <div class="card w-full h-full p-4 pb-2 bg-white shadow-md rounded-md gap-2">
                                <div class="flex flex-col h-full w-full">
                                    <div class="flex flex-row w-full justify-between h-full items-center">
                                        <div class="text-black tracking-wide flex-none font-bold">IP Population in GIDA
                                        </div>
                                        <div class="flex items-center justify-center text-[#252525] font-bold">
                                            <div class="flex text-4xl items-end" style="color: #0e9cdc"
                                                id="ipPopulation">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="flex-none flex items-end justify-end text-xs italic">
                                        * Available data as of&nbsp;<span id="yesterdayDate2"></span>
                                    </div> --}}
                                </div>
                            </div>
                        </div>

                        <div class="flex w-full ">
                            <div class="card  w-full  p-4 bg-white shadow-md rounded-md" style="height: 120px">
                                <div class="flex flex-col  w-full gap-3 items-cente h-full ">
                                    <div class="flex flex-row w-full justify-between items-center h-full">
                                        <div class="flex text-xl text-black tracking-wide font-bold">Total number of
                                            available
                                            HRH
                                            in GIDA Barangays</div>
                                        <div class="flex items-center justify-center">
                                            <div class="flex text-xl w-full items-center justify-center font-bold"
                                                style="color: #0e9cdc" id="totalHrh">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="flex flex-row gap-2 h-full">
                            <div class="card w-full  p-4 pb-2 bg-white shadow-md rounded-md gap-2">
                                <div class="flex flex-col h-full w-full gap-3 ">

                                    <div class="flex items-center justify-center flex-col ">
                                        <div class="flex text-7xl h-full w-full items-center justify-center  font-bold"
                                            style="color: #0e9cdc" id="woBhs">
                                        </div>
                                        <div class="text-black tracking-wide flex-none font-bold">GIDA Barangays
                                            without
                                            BHS
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card w-full  p-4 pb-2 bg-white shadow-md rounded-md gap-2">
                                <div class="flex flex-col h-full w-full gap-3">
                                    <div class="flex flex-col w-full justify-between items-center">
                                        <div class="flex text-7xl h-full w-full items-center justify-center text-[#252525] font-bold"
                                            style="color: #0e9cdc" id="woElec">
                                        </div>
                                        <div class="text-black tracking-wide flex-none font-bold">GIDA Barangays
                                            without
                                            Electricity
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="flex flex-row gap-2 h-full">
                            <div class="card w-full  p-4 pb-2 bg-white shadow-md rounded-md gap-2">
                                <div class="flex flex-col h-full w-full gap-3">
                                    <div class="flex flex-col w-full justify-between items-center">
                                        <div class="flex text-7xl h-full w-full items-center justify-center text-[#252525] font-bold"
                                            style="color: #0e9cdc" id="woSignal">
                                        </div>
                                        <div class="text-black tracking-wide flex-none font-bold">GIDA Barangays with
                                            no
                                            Mobile
                                            phone Signal

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card w-full  p-4 pb-2 bg-white shadow-md rounded-md gap-2">
                                <div class="flex flex-col h-full w-full gap-3">
                                    <div class="flex flex-col w-full justify-between items-center">
                                        <div class="flex text-7xl h-full w-full items-center justify-center text-[#252525] font-bold"
                                            style="color: #0e9cdc" id="woInternet">
                                        </div>
                                        <div class="text-black tracking-wide flex-none font-bold">GIDA Barangays with
                                            no
                                            Internet Connection
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-row gap-2 h-full">
                            <div class="card w-full  p-4 bg-white shadow-md rounded-md gap-2">
                                <div class="flex flex-col h-full w-full gap-3">
                                    <div class="flex flex-col w-full justify-between items-center">
                                        <div class="flex text-7xl h-full w-full items-center justify-center text-[#252525] font-bold"
                                            style="color: #0e9cdc" id="perToilet">
                                        </div>
                                        <div class="text-black tracking-wide flex-none font-bold">Proportion of HH
                                            living
                                            in
                                            GIDA with Sanitary Toilet
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card w-full  p-4 bg-white shadow-md rounded-md gap-2">
                                <div class="flex flex-col h-full w-full gap-3">
                                    <div class="flex flex-col w-full justify-between items-center">
                                        <div class="flex text-7xl h-full w-full items-center justify-center text-[#252525] font-bold"
                                            style="color: #0e9cdc" id="perWater">
                                        </div>
                                        <div
                                            class="flex text-black tracking-wide flex-none font-bold w-full justify-center">
                                            Proportion of HH
                                            living in GIDA with access to improved water supply
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>


                </div>

                <div class="h-full flex w-full justify-center bg-white " id="loadingScreen">
                    <button type="button"
                        class=" items-center px-4 gap-4 flex py-2 font-semibold leading-6 text-sm shadow rounded-md text-red-500 bg-indigo-500 hover:bg-indigo-400 transition ease-in-out duration-150 cursor-not-allowed"
                        disabled="">
                        <div class="spinner"></div>
                        Processing...
                    </button>
                </div>


            </div>
        </div>
    </div>




    <script>
        function showLoadingScreen() {
            $('#loadingScreen').show();
            $('#gidaBody').hide();

        }

        // Function to hide loading screen and show content
        function hideLoadingScreen() {
            $('#loadingScreen').hide();
            $('#gidaBody').show();
        }

        $(document).ready(function() {
            // /
            // Function to toggle dropdown menu visibility
            $('#filterDropdown').click(function() {
                $('.dropdown-menu').toggle();
            });

            // Event listener for filter change
            $('input[name="filter"]').change(function() {
                // Remove checked attribute from all radio buttons except the selected one
                $('input[name="filter"]').not(this).prop('checked', false);

                $('#gidaBody').hide();
                $('#loadingScreen').show();

                // Perform filtering based on selected value
                var selectedYear = $('input[name="filter"]:checked').val();
                console.log("Year when it changed: ", selectedYear);
                var selectedRegion = $('#regionDropdown').val();
                if (selectedRegion) {
                    getInfo(selectedYear, selectedRegion);
                    $('#provinceDropdown').prop('disabled', true);
                    $('#cityDropdown').prop('disabled', true);
                    $('#barangayDropdown').prop('disabled', true);
                    $('#provinceDropdown').empty();
                    $('#provinceDropdown').append(
                        '<option disabled selected>Please select a Province</option>');
                    $('#cityDropdown').empty();
                    $('#cityDropdown').append('<option disabled selected>Please select a City</option>');
                    $('#barangayDropdown').empty();
                    $('#barangayDropdown').append(
                        '<option disabled selected>Please select a Barangay</option>');
                    $.ajax({
                        url: '/get-provinces-gida/' + selectedRegion + '/' + selectedYear,
                        type: 'GET',
                        success: function(data) {
                            console.log("Provinces: ", data);
                            $('#provinceDropdown').empty(); // Clear existing options
                            $('#provinceDropdown').append(
                                '<option disabled selected>Please select a Province</option>'
                            );
                            $.each(data, function(key, value) {
                                console.log("This is the data from .each: ", data);
                                $('#provinceDropdown').append('<option>' + value +
                                    '</option>');
                            });
                            $('#provinceDropdown').prop('disabled', false);

                        }
                    });
                } else if (!selectedRegion || selectedRegion === "all") {
                    getInfo(selectedYear);
                    $('#provinceDropdown').prop('disabled', true);
                    $('#cityDropdown').prop('disabled', true);
                    $('#provinceDropdown').empty();
                    $('#provinceDropdown').append(
                        '<option disabled selected>Please select a Province</option>');
                    $('#cityDropdown').empty();
                    $('#cityDropdown').append('<option disabled selected>Please select a City</option>');
                } else {
                    $('#provinceDropdown').prop('disabled', true).val('').change();
                    $('#cityDropdown').prop('disabled', true).val('').change();
                    $('#barangayDropdown').prop('disabled', true).val('').change();
                }


                // Update URL parameter
                var urlParams = new URLSearchParams(window.location.search);
                urlParams.set('filter', selectedYear);
                var newUrl = window.location.pathname + '?' + urlParams.toString();
                window.history.pushState({}, '', newUrl);
            });


            $('#loadingScreen').hide();

            // Function to handle region dropdown change
            $('#regionDropdown').change(function() {
                $('#gidaBody').hide();
                $('#loadingScreen').show();

                var selectedRegion = $(this).val();
                var totalPopulation = 0;
                var ipPopulation = 0;
                var totalHrh = 0;
                var woBhs = 0;
                var woElec = 0;
                var woSignal = 0;
                var woInternet = 0;
                var perToilet = 0;
                var perWater = 0;
                if (selectedRegion === 'all') {
                    var selectedYear = $('input[name="filter"]:checked').val();
                    getInfo(selectedYear);
                    $('#provinceDropdown').empty();
                    $('#provinceDropdown').append(
                        '<option disabled selected>Please select a Province</option>');
                    $('#cityDropdown').empty();
                    $('#cityDropdown').append('<option disabled selected>Please select a City</option>');
                    $('#barangayDropdown').empty();
                    $('#barangayDropdown').append(
                        '<option disabled selected>Please select a Barangay</option>');
                    $('#provinceDropdown').prop('disabled', true);
                    $('#cityDropdown').prop('disabled', true);
                    $('#barangayDropdown').prop('disabled', true);
                    return;
                } else if (selectedRegion) {
                    var selectedYear = $('input[name="filter"]:checked').val();
                    getInfo(selectedYear, selectedRegion);
                    $('#provinceDropdown').prop('disabled', true);
                    $('#cityDropdown').prop('disabled', true);
                    $('#barangayDropdown').prop('disabled', true);
                    $('#provinceDropdown').empty();
                    $('#provinceDropdown').append(
                        '<option disabled selected>Please select a Province</option>');
                    $('#cityDropdown').empty();
                    $('#cityDropdown').append('<option disabled selected>Please select a City</option>');
                    $('#barangayDropdown').empty();
                    $('#barangayDropdown').append(
                        '<option disabled selected>Please select a Barangay</option>');
                    $.ajax({
                        url: '/get-provinces-gida/' + selectedRegion + '/' + selectedYear,
                        type: 'GET',

                        success: function(data) {
                            console.log("Provinces: ", data);
                            $('#provinceDropdown').empty(); // Clear existing options
                            $('#provinceDropdown').append(
                                '<option disabled selected>Please select a Province</option>'
                            );
                            $.each(data, function(key, value) {
                                console.log("This is the data from .each: ", data);
                                $('#provinceDropdown').append('<option>' + value +
                                    '</option>');
                            });
                            $('#provinceDropdown').prop('disabled', false);
                            hideLoadingScreen();
                        }
                    });
                } else {
                    $('#provinceDropdown').prop('disabled', true).val('').change();
                    $('#cityDropdown').prop('disabled', true).val('').change();
                    $('#barangayDropdown').prop('disabled', true).val('').change();
                }
            });

            $('#provinceDropdown').change(function() {
                $('#gidaBody').hide();
                $('#loadingScreen').show();

                var selectedProvince = $(this).val();
                var totalPopulation = 0;
                var ipPopulation = 0;
                var totalHrh = 0;
                var woBhs = 0;
                var woElec = 0;
                var woSignal = 0;
                var woInternet = 0;
                var perToilet = 0;
                var perWater = 0;
                if (selectedProvince) {
                    var selectedYear = $('input[name="filter"]:checked').val();
                    var selectedRegion = $('#regionDropdown').val();
                    getInfo(selectedYear, selectedRegion, selectedProvince);
                    $('#cityDropdown').prop('disabled', true);
                    $('#barangayDropdown').prop('disabled', true);
                    $('#cityDropdown').empty();
                    $('#cityDropdown').append('<option disabled selected>Please select a City</option>');
                    $('#barangayDropdown').empty();
                    $('#barangayDropdown').append(
                        '<option disabled selected>Please select a Barangay</option>');
                    $.ajax({
                        url: '/get-cities-gida/' + selectedProvince + '/' + selectedYear,
                        type: 'GET',
                        success: function(data) {
                            $('#cityDropdown').empty(); // Clear existing options
                            $('#cityDropdown').append(
                                '<option disabled selected>Please select a City</option>');
                            $.each(data, function(key, value) {
                                $('#cityDropdown').append('<option>' + value +
                                    '</option>');
                            });
                            $('#cityDropdown').prop('disabled', false);
                            hideLoadingScreen();
                        }
                    });
                } else {
                    $('#cityDropdown').prop('disabled', true).val('').change();
                    $('#barangayDropdown').prop('disabled', true).val('').change();
                }
            });

            $('#cityDropdown').change(function() {
                $('#gidaBody').hide();
                $('#loadingScreen').show();

                var selectedCity = $(this).val();
                var totalPopulation = 0;
                var ipPopulation = 0;
                var totalHrh = 0;
                var woBhs = 0;
                var woElec = 0;
                var woSignal = 0;
                var woInternet = 0;
                var perToilet = 0;
                var perWater = 0;
                if (selectedCity) {
                    var selectedYear = $('input[name="filter"]:checked').val();
                    var selectedRegion = $('#regionDropdown').val();
                    var selectedProvince = $('#provinceDropdown').val();
                    getInfo(selectedYear, selectedRegion, selectedProvince, selectedCity);
                    $('#barangayDropdown').prop('disabled', true);
                    $('#barangayDropdown').empty();
                    $('#barangayDropdown').append(
                        '<option disabled selected>Please select a Barangay</option>');
                    $.ajax({
                        url: '/get-barangays-gida/' + selectedCity + '/' + selectedYear,
                        type: 'GET',
                        success: function(data) {
                            $('#barangayDropdown').empty();
                            $('#barangayDropdown').append(
                                '<option disabled selected>Please select a Barangay</option>'
                            );
                            $.each(data, function(key, value) {
                                $('#barangayDropdown').append('<option>' + value +
                                    '</option>');
                            });
                            $('#barangayDropdown').prop('disabled', false);
                            hideLoadingScreen();
                        }
                    });
                } else {
                    $('#barangayDropdown').prop('disabled', true).val('').change();
                }
            });

            $('#barangayDropdown').change(function() {
                $('#gidaBody').hide();
                $('#loadingScreen').show();

                var selectedBarangay = $(this).val();
                var totalPopulation = 0;
                var ipPopulation = 0;
                var totalHrh = 0;
                var woBhs = 0;
                var woElec = 0;
                var woSignal = 0;
                var woInternet = 0;
                var perToilet = 0;
                var perWater = 0;
                if (selectedBarangay) {
                    var selectedYear = $('input[name="filter"]:checked').val();
                    var selectedRegion = $('#regionDropdown').val();
                    var selectedProvince = $('#provinceDropdown').val();
                    var selectedCity = $('#cityDropdown').val();
                    getInfo(selectedYear, selectedRegion, selectedProvince, selectedCity, selectedBarangay);
                }
            });

            // Function to set yesterday's date
            function setYesterdayDate() {
                var yesterday = Date.today().addDays(-1);
                var formattedDate = yesterday.toString("MMMM d, yyyy");
                document.getElementById("gida_date_1").innerText = formattedDate;
            }

            function getInfo(selectedYear, selectedRegion, selectedProvince, selectedCity, selectedBarangay) {
                $('#gidaBody').hide();
                $('#loadingScreen').show();

                var totalPopulation = 0;
                var ipPopulation = 0;
                var totalHrh = 0;
                var woBhs = 0;
                var woElec = 0;
                var woSignal = 0;
                var woInternet = 0;
                var perToilet = 0;
                var perWater = 0;
                var count = 0;
                console.log("Selected Year inside getInfo: ", selectedYear);

                // Construct the request data with the selected criteria
                var requestData = {
                    year: selectedYear,
                    region: selectedRegion,
                    province: selectedProvince,
                    city: selectedCity,
                    barangay: selectedBarangay
                };
                // Remove any keys with undefined or empty values
                Object.keys(requestData).forEach(key => requestData[key] === undefined || requestData[key] === "" &&
                    delete requestData[key]);
                console.log("Request Data: ", requestData);

                $.ajax({
                    url: '/get-info-gida',
                    type: 'GET',
                    data: requestData,
                    success: function(data) {
                        // Filter the data based on requestData
                        var filteredData = data.filter(function(item) {
                            // Check if each key in requestData matches the corresponding key in item
                            return Object.keys(requestData).every(function(key) {
                                // If requestData[key] is defined and not empty, item[key] must match it
                                // Otherwise, skip filtering based on this key
                                return requestData[key] === undefined || requestData[
                                    key] === "" || item[key] == requestData[key];
                            });
                        });

                        console.log("Filtered data inside getInfo: ", filteredData);
                        filteredData.forEach(function(item) {
                            totalPopulation += item.population;
                            ipPopulation += item.ip_population;
                            totalHrh += item.hrh;
                            woBhs += item.wo_bhs;
                            woElec += item.wo_electricity;
                            woSignal += item.wo_signal;
                            woInternet += item.wo_internet;
                            perToilet += item.proportion_sanitary;
                            perWater += item.proportion_water;
                            count++;
                        });
                        perToilet = (perToilet / count).toFixed(2);
                        perWater = (perWater / count).toFixed(2);
                        $('#totalPopulation').text(totalPopulation.toLocaleString());
                        $('#ipPopulation').text(ipPopulation.toLocaleString());
                        $('#totalHrh').text(totalHrh.toLocaleString());
                        $('#woBhs').text(woBhs.toLocaleString());
                        $('#woElec').text(woElec.toLocaleString());
                        $('#woSignal').text(woSignal.toLocaleString());
                        $('#woInternet').text(woInternet.toLocaleString());
                        $('#perToilet').text(perToilet + "%");
                        $('#perWater').text(perWater + "%");

                        hideLoadingScreen();
                    }
                });
            }

            var selectedYear = $('input[name="filter"]:checked').val();
            getInfo(selectedYear);

            // Call functions to render charts and set date
            setYesterdayDate();

            // Hide dropdown menu initially
            $('.dropdown-menu').hide();




        });
    </script>


</body>

</html>
