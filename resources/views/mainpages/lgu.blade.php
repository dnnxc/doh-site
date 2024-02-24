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
                                style="color: #0e9cdc">
                                10 500</div>
                            <div class="text-black tracking-wide flex-none font-bold">
                                TB Case Notification Rate

                            </div>
                        </div>
                    </div>

                    <div class="card w-full h-full p-4 bg-white shadow-md rounded-md flex flex-col gap-4">

                        <div class="flex flex-col w-full justify-between items-center">
                            <div class="flex text-7xl h-full w-full items-center justify-center text-[#252525] font-bold"
                                style="color: #0e9cdc">
                                10 500</div>
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
                                style="color: #0e9cdc">
                                10 500</div>
                            <div class="flex text-black tracking-wide font-bold w-full justify-center text-center">
                                Percentage of households using safely managed drinking-water services/sources
                            </div>
                        </div>
                    </div>

                    <div class="card w-full h-full p-4 bg-white shadow-md rounded-md flex flex-col gap-4">
                        <div class="flex flex-col w-full justify-between items-center">
                            <div class="flex text-7xl h-full w-full items-center justify-center text-[#252525] font-bold"
                                style="color: #0e9cdc">
                                10 500</div>
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
                                style="color: #0e9cdc">
                                10 500</div>
                            <div class="text-black tracking-wide flex-none font-bold">
                                Percentage of Fully Immunized Child
                            </div>
                        </div>
                    </div>

                    <div class="card w-full h-full p-4 bg-white shadow-md rounded-md flex flex-col gap-4">
                        <div class="flex flex-col w-full justify-between items-center">
                            <div class="flex text-7xl h-full w-full items-center justify-center text-[#252525] font-bold"
                                style="color: #0e9cdc">
                                10 500</div>
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
                if (selectedRegion) {
                    $('#cityDropdown, #barangayDropdown').prop('disabled', false);
                } else {
                    $('#cityDropdown').prop('disabled', true).val('').change();
                    $('#barangayDropdown').prop('disabled', true).val('').change();
                }
            });

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
                var selectedFilter = $(this).val();
                // Perform filtering logic here, for example:
                // Submit form or trigger AJAX request
                $('#filterForm').submit();
            });

            // Check URL parameter and set corresponding radio button as checked
            var urlParams = new URLSearchParams(window.location.search);
            var filterValue = urlParams.get('filter');
            if (filterValue) {
                $('input[name="filter"]').each(function() {
                    if ($(this).val() === filterValue) {
                        $(this).prop('checked', true);
                    }
                });
            }
        });
    </script>
</body>

</html>
