<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')

    <title>Department of Health - LHSML</title>
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
        {{-- <div>HEY HEY HEY</div> --}}
        <div class="flex h-full w-full p-4">
            <div class="flex flex-col p-2 gap-4 items-center w-full h-full">
                <div class="flex font-bold items-center text-black w-full">
                    <div class="flex text-4xl items-center justify-center w-full tracking-wide">
                        LHS ML Targets & Accomplishments</div>
                </div>

                <div class="flex justify-end w-full">
                    <button class="rounded-lg h-[20px] bg-[]" onclick="openImage()" style="background-color: #0ca950">
                        <div class="p-3 text-white font-semibold">
                            See Image
                        </div>
                    </button>
                </div>


                <div class="flex flex-col gap-4 bg-white p-4 rounded-lg">



                    <table class="table-auto table-zebra gap-3 table ">
                        <thead class="text-black">
                            <tr class="border" style="border-color: black">
                                <th class="p-3">Year</th>
                                <th class="p-3">Target</th>
                                <th class="p-3">Accomplishments</th>
                                <th class="p-3">Remarks</th>
                            </tr>
                        </thead>
                        <tbody class="text-black items-center justify-center">
                            <tr class="text-center border" style="border-color: black">
                                <td class="p-3">2022</td>
                                <td class="p-3">Atleast 58 UHC IS achieved 100% of Level 1 KRAs</td>
                                <td class="p-3">57 UHC IS</td>
                                <td class="justify-center p-3">
                                    <div>53/58 original UHC IS and 4/13 additional UHC IS</div>
                                </td>
                            </tr>

                            <tr class="text-center border" style="border-color: black">
                                <td class="p-3">2023 (Mid Year)</td>
                                <td class="p-3">Atleast 58 UHC IS achieved 70% of Level 2 KRAs</td>
                                <td class="p-3">66 UHC IS achieved 100% of Level 1 KRAs;<br>19 UHC IS achieved at
                                    least 70% of Level
                                    2 KRAs</td>
                                <td class="justify-center p-3">
                                    <div>55/58 original UHC IS and 11/13 additional UHC IS</div>
                                </td>
                            </tr>

                            <tr class="text-center border" style="border-color: black">
                                <td class="p-3">2024</td>
                                <td class="p-3">Atleast 58 UHC IS achieved 100% of Level 2 KRAs and at least 70% of
                                    Level 3 KRAs
                                </td>
                                <td class="justify-center p-3">-</td>
                            </tr>

                            <tr class="text-center border" style="border-color: black">
                                <td class="p-3">2025</td>
                                <td class="p-3">Atleast 58 UHC IS achieved 100% of Level 3 KRAs</td>
                                <td class="justify-center p-3">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>

        </div>
    </div>

    <script>
        function openImage() {
            // Path to the image
            var imagePath = 'images/lhsml.jpg';

            var baseUrl = window.location.origin;
            var imageUrl = baseUrl + '/' + imagePath;

            window.open(imageUrl, '_blank');
        }
    </script>

</body>

</html>
