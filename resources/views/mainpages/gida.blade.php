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

                            <select id=""
                                class="select select-bordered w-full max-w-xs bg-white disabled:bg-white disabled:text-[#2c2c2c] disabled:border-none"
                                disabled>
                                <option disabled selected>Please select a City</option>
                                <option>Normal Apple</option>
                                <option>Normal Orange</option>
                                <option>Normal Tomato</option>
                            </select>

                            <select id=""
                                class="select select-bordered w-full max-w-xs bg-white disabled:bg-white disabled:text-[#2c2c2c] disabled:border-none"
                                disabled>
                                <option disabled selected>Please select a Barangay</option>
                                <option>Normal Apple</option>
                                <option>Normal Orange</option>
                                <option>Normal Tomato</option>
                            </select>
                        </div>

                        <div class="flex items-center text-black gap-3">
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
                                            <div class="flex text-4xl items-end" style="color: #0e9cdc">10 500</div>
                                        </div>
                                    </div>
                                    <div class="flex-none flex items-end justify-end text-xs italic">
                                        * Available data as of&nbsp;<span id="gida_date_1"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="card w-full h-full p-4 pb-2 bg-white shadow-md rounded-md gap-2">
                                <div class="flex flex-col h-full w-full">
                                    <div class="flex flex-row w-full justify-between h-full items-center">
                                        <div class="text-black tracking-wide flex-none font-bold">IP Population in GIDA
                                        </div>
                                        <div class="flex items-center justify-center text-[#252525] font-bold">
                                            <div class="flex text-4xl items-end" style="color: #0e9cdc">10 500</div>
                                        </div>
                                    </div>
                                    <div class="flex-none flex items-end justify-end text-xs italic">
                                        * Available data as of&nbsp;<span id="yesterdayDate2"></span>
                                    </div>
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
                                                style="color: #0e9cdc">
                                                25</div>
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
                                            style="color: #0e9cdc">
                                            10 500</div>
                                        <div class="text-black tracking-wide flex-none font-bold">GIDA Barangays
                                            without
                                            BHS
                                        </div>
                                    </div>

                                    {{-- <div class="flex flex-row w-full justify-between items-center">
                                        <div class="text-black tracking-wide flex-none font-bold">GIDA Barangays without BHS
                                        </div>
                                    </div> --}}

                                </div>
                            </div>

                            <div class="card w-full  p-4 pb-2 bg-white shadow-md rounded-md gap-2">
                                <div class="flex flex-col h-full w-full gap-3">
                                    <div class="flex flex-col w-full justify-between items-center">
                                        <div class="flex text-7xl h-full w-full items-center justify-center text-[#252525] font-bold"
                                            style="color: #0e9cdc">
                                            10 500</div>
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
                                            style="color: #0e9cdc">
                                            10 500</div>
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
                                            style="color: #0e9cdc">
                                            10 500</div>
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
                                            style="color: #0e9cdc">
                                            10 500</div>
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
                                            style="color: #0e9cdc">
                                            10 500</div>
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

                // Function to set yesterday's date
                function setYesterdayDate() {
                    var yesterday = Date.today().addDays(-1);
                    var formattedDate = yesterday.toString("MMMM d, yyyy");
                    document.getElementById("gida_date_1").innerText = formattedDate;
                }

                // Call functions to render charts and set date
                setYesterdayDate();

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
