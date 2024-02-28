<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')

    <title>Department of Health - LGU</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet"> -->

    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body class="flex flex-col h-screen">
    @include('header')

    <div class="flex flex-row flex-grow p-0 bg-[#E8E8E8]">
        @include('side_panel')
        <div class="flex h-full w-full p-4">
            <div class="flex flex-col p-2 gap-4 items-center w-full h-full">
                <div class="flex flex-row gap-4 items-center justify-center w-full">
                    <select id="regionDropdown" class="select select-bordered w-full max-w-xs bg-white text-[#252525]">
                        <option disabled selected>Please select a Region</option>
                        <option value="all">Show All Regions</option>
                        @foreach($regions as $region)
                        <option>{{ $region }}</option>
                        @endforeach
                    </select>

                    <select id="provinceDropdown"
                        class="select select-bordered w-full max-w-xs bg-white disabled:bg-white disabled:text-[#2c2c2c] disabled:border-none"
                        disabled>
                        <option disabled selected>Please select a Province</option>
                    </select>

                    <select id="cityDropdown"
                        class="select select-bordered w-full max-w-xs bg-white disabled:bg-white disabled:text-[#2c2c2c] disabled:border-none"
                        disabled>
                        <option disabled selected>Please select a City</option>
                    </select>
                </div>

                <div class="flex items-start text-black gap-3 w-full">
                    Filter:
                    <div class="dropdown relative flex items-center" style="position: relative">
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
                                    <input class="radio form-check-input" type="radio" name="filter" id="filterA"
                                        value="2023" checked>
                                    <label class="form-check-label" for="filterA">
                                        2023
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="radio form-check-input" type="radio" name="filter" id="filterB"
                                        value="2022">
                                    <label class="form-check-label" for="filterB">
                                        2022
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="radio form-check-input" type="radio" name="filter" id="filterC"
                                        value="2021">
                                    <label class="form-check-label" for="filterC">
                                        2021
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="radio form-check-input" type="radio" name="filter" id="filterD"
                                        value="2020">
                                    <label class="form-check-label" for="filterD">
                                        2020
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="flex flex-row gap-4 w-full">
                    <div class="card w-full h-full p-4 bg-white shadow-md rounded-md flex flex-col gap-4">
                        <div class="flex flex-col w-full justify-between items-center">
                            <div class="flex text-7xl h-full w-full items-center justify-center text-[#252525] font-bold"
                                style="color: #0e9cdc" id="totalCase">
                                </div>
                            <div class="text-black tracking-wide flex-none font-bold">
                                TB Case Notification Rate

                            </div>
                        </div>
                    </div>

                    <div class="card w-full h-full p-4 bg-white shadow-md rounded-md flex flex-col gap-4">

                        <div class="flex flex-col w-full justify-between items-center">
                            <div class="flex text-7xl h-full w-full items-center justify-center text-[#252525] font-bold"
                                style="color: #0e9cdc" id="totalTreatment">
                                </div>
                            <div class="text-black tracking-wide flex-none font-bold">
                                TB Treatment Success Rate
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-row gap-4 w-full">
                    <div class="card w-full h-full p-4 bg-white shadow-md rounded-md flex flex-col gap-4">
                        <div class="flex flex-col w-full justify-between items-center">
                            <div class="flex text-7xl h-full w-full items-center justify-center text-[#252525] font-bold"
                                style="color: #0e9cdc" id="safeWater">
                                </div>
                            <div class="flex text-black tracking-wide font-bold w-full justify-center text-center">
                                Percentage of households using safely managed drinking-water services/sources
                            </div>
                        </div>
                    </div>

                    <div class="card w-full h-full p-4 bg-white shadow-md rounded-md flex flex-col gap-4">
                        <div class="flex flex-col w-full justify-between items-center">
                            <div class="flex text-7xl h-full w-full items-center justify-center text-[#252525] font-bold"
                                style="color: #0e9cdc" id="stunting">
                                </div>
                            <div class="text-black tracking-wide flex-none font-bold">
                                Prevalence of Stunting among under 5 children
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-row gap-4 w-full">
                    <div class="card w-full h-full p-4 bg-white shadow-md rounded-md flex flex-col gap-4">
                        <div class="flex flex-col w-full justify-between items-center">
                            <div class="flex text-7xl h-full w-full items-center justify-center text-[#252525] font-bold"
                                style="color: #0e9cdc" id="fullImmune">
                                </div>
                            <div class="text-black tracking-wide flex-none font-bold">
                                Percentage of Fully Immunized Child
                            </div>
                        </div>
                    </div>

                    <div class="card w-full h-full p-4 bg-white shadow-md rounded-md flex flex-col gap-4">
                        <div class="flex flex-col w-full justify-between items-center">
                            <div class="flex text-7xl h-full w-full items-center justify-center text-[#252525] font-bold"
                                style="color: #0e9cdc" id="philpen">
                                </div>
                            <div class="text-black tracking-wide flex-none font-bold text-center">
                                Percentage of adults 20 years old and above who were risk assessed using the PhilPEN
                                protocol

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
                var totalCase = 0;
                var totalTreatment = 0;
                var safeWater = 0;
                var stunting = 0;
                var fullImmune = 0;
                var philpen = 0;
                var count = 0;
                if (selectedRegion === 'all'){
                    var selectedYear = $('input[name="filter"]:checked').val();
                    getInfo(selectedYear);
                    $('#provinceDropdown').empty();
                    $('#provinceDropdown').append('<option disabled selected>Please select a Province</option>');
                    $('#cityDropdown').empty();
                    $('#cityDropdown').append('<option disabled selected>Please select a City</option>');
                    $('#provinceDropdown').prop('disabled', true);
                    $('#cityDropdown').prop('disabled', true);
                    return;
                }
                else if (selectedRegion) {
                    var selectedYear = $('input[name="filter"]:checked').val();
                    getInfo(selectedYear, selectedRegion);
                    $('#provinceDropdown').prop('disabled', false);
                    $('#cityDropdown').prop('disabled', true);
                    $('#provinceDropdown').empty();
                    $('#provinceDropdown').append('<option disabled selected>Please select a Province</option>');
                    $('#cityDropdown').empty();
                    $('#cityDropdown').append('<option disabled selected>Please select a City</option>');
                    $.ajax({
                        url: '/get-provinces-lgu/' + selectedRegion + '/' + selectedYear,
                        type: 'GET',
                        success: function(data) {
                            $('#provinceDropdown').empty(); // Clear existing options
                            $('#provinceDropdown').append('<option disabled selected>Please select a Province</option>');
                            $.each(data, function(key, value) {
                                console.log("This is the data from .each: ",data);
                                $('#provinceDropdown').append('<option>' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#provinceDropdown').prop('disabled', true).val('').change();
                    $('#cityDropdown').prop('disabled', true).val('').change();
                }
            });

            // Function to handle region dropdown change
            $('#provinceDropdown').change(function() {
                var selectedProvince = $(this).val();
                var totalCase = 0;
                var totalTreatment = 0;
                var safeWater = 0;
                var stunting = 0;
                var fullImmune = 0;
                var philpen = 0;
                var count = 0;
                if (selectedProvince) {
                    var selectedYear = $('input[name="filter"]:checked').val();
                    var selectedRegion = $('#regionDropdown').val();
                    getInfo(selectedYear, selectedRegion, selectedProvince);
                    $('#cityDropdown').prop('disabled', false);
                    $('#cityDropdown').empty();
                    $('#cityDropdown').append('<option disabled selected>Please select a City</option>');
                    $.ajax({
                        url: '/get-cities-lgu/' + selectedProvince + '/' + selectedYear,
                        type: 'GET',
                        success: function(data) {
                            $('#cityDropdown').empty();
                            $('#cityDropdown').append('<option disabled selected>Please select a City</option>');
                            $.each(data, function(key, value) {
                                console.log("This is the data from .each: ",data);
                                $('#cityDropdown').append('<option>' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#cityDropdown').prop('disabled', true).val('').change();
                }
            });

            // Function to handle region dropdown change
            $('#cityDropdown').change(function() {
                var selectedCity = $(this).val();
                var totalCase = 0;
                var totalTreatment = 0;
                var safeWater = 0;
                var stunting = 0;
                var fullImmune = 0;
                var philpen = 0;
                var count = 0;
                if (selectedCity) {
                    var selectedYear = $('input[name="filter"]:checked').val();
                    var selectedRegion = $('#regionDropdown').val();
                    var selectedProvince = $('#provinceDropdown').val();
                    getInfo(selectedYear, selectedRegion, selectedProvince, selectedCity);
                }
            });


            function getInfo(selectedYear, selectedRegion, selectedProvince, selectedCity){
                var totalCase = 0;
                var totalTreatment = 0;
                var safeWater = 0;
                var stunting = 0;
                var fullImmune = 0;
                var philpen = 0;
                var count = 0;

                // Construct the request data with the selected criteria
                var requestData = {
                    year: selectedYear,
                    region: selectedRegion,
                    province: selectedProvince,
                    city: selectedCity,
                };
                // Remove any keys with undefined or empty values
                Object.keys(requestData).forEach(key => requestData[key] === undefined || requestData[key] === "" && delete requestData[key]);

                $.ajax({
                    url: '/get-info-lgu',
                    type: 'GET',
                    data: requestData,
                    success: function(data){
                        // Filter the data based on requestData
                        var filteredData = data.filter(function(item) {
                            // Check if each key in requestData matches the corresponding key in item
                            return Object.keys(requestData).every(function(key) {
                                // If requestData[key] is defined and not empty, item[key] must match it
                                // Otherwise, skip filtering based on this key
                                return requestData[key] === undefined || requestData[key] === "" || item[key] == requestData[key];
                            });
                        });
                        filteredData.forEach(function(item) {
                                totalCase += item.tb_case;
                                totalTreatment += item.tb_treatment;
                                safeWater += parseFloat(item.safe_water);
                                stunting += parseFloat(item.stunting);
                                fullImmune += parseFloat(item.full_immune);
                                philpen += parseFloat(item.risk_philpen);
                                count++;
                            });
                        totalCase = Math.round(totalCase / count).toLocaleString();
                        totalTreatment = Math.round(totalTreatment / count).toLocaleString();
                        safeWater = (safeWater / count).toFixed(2) + "%";
                        stunting = (stunting / count).toFixed(2) + "%";
                        fullImmune = (fullImmune / count).toFixed(2) + "%";
                        philpen = (philpen / count).toFixed(2) + "%";
                        $('#totalCase').text(totalCase);
                        $('#totalTreatment').text(totalTreatment);
                        $('#safeWater').text(safeWater);
                        $('#stunting').text(stunting);
                        $('#fullImmune').text(fullImmune);
                        $('#philpen').text(philpen);
                    }
                });
            }

            var selectedYear = $('input[name="filter"]:checked').val();
            getInfo(selectedYear);

            // Hide dropdown menu initially
            $('.dropdown-menu').hide();

            // Function to toggle dropdown menu visibility
            $('#filterDropdown').click(function() {
                $('.dropdown-menu').toggle();
            });

            // Event listener for filter change
            $('input[name="filter"]').change(function() {
                // Remove checked attribute from all radio buttons except the selected one
                $('input[name="filter"]').not(this).prop('checked', false);

                // Perform filtering based on selected value
                var selectedYear = $('input[name="filter"]:checked').val();
                var selectedRegion = $('#regionDropdown').val();
                if(selectedRegion){
                    $('#provinceDropdown').prop('disabled', false);
                    $('#cityDropdown').prop('disabled', true);
                    $('#provinceDropdown').empty();
                    $('#provinceDropdown').append('<option disabled selected>Please select a Province</option>');
                    $('#cityDropdown').empty();
                    $('#cityDropdown').append('<option disabled selected>Please select a City</option>');
                    $.ajax({
                            url: '/get-provinces-lgu/' + selectedRegion + '/' + selectedYear,
                            type: 'GET',
                            success: function(data) {
                                $('#provinceDropdown').empty(); // Clear existing options
                                $('#provinceDropdown').append('<option disabled selected>Please select a Province</option>');
                                $.each(data, function(key, value) {
                                    $('#provinceDropdown').append('<option>' + value + '</option>');
                                });
                            }
                        });
                    getInfo(selectedYear, selectedRegion);
                } else if(!selectedRegion || selectedRegion === "all"){
                    $('#provinceDropdown').prop('disabled', true);
                    $('#cityDropdown').prop('disabled', true);
                    $('#provinceDropdown').empty();
                    $('#provinceDropdown').append('<option disabled selected>Please select a Province</option>');
                    $('#cityDropdown').empty();
                    $('#cityDropdown').append('<option disabled selected>Please select a City</option>');
                    getInfo(selectedYear);
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
        });
    </script>
</body>

</html>
