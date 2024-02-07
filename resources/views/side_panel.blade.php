<!-- Sidebar content -->
<div id="full_side_panel" class="bg-[#0CA950] w-[280px] p-4">
    <div class="gap-5 h-full">
        <div class="text-white flex flex-row items-center pb-8 active:bg-[#FFCF35]">
            <a href="/bhw" class="">
                <div class="flex">Baranggay Health Worker (BHW)</div>
            </a>
            <div class="flex h-[29px]"><x-ri-arrow-right-s-line class="" /></div>
        </div>
        <div class="text-white flex flex-row items-center pb-8 active:bg-[#FFCF35]">
            <a href="/lgu" class="">
                <div class="flex">Local Government Unit (LGU)</div>
            </a>

            <div class="flex h-[29px]"><x-ri-arrow-right-s-line class="" /></div>
        </div>
        <div class="text-white flex flex-row items-center pb-8 active:bg-[#FFCF35]">
            <a href="/gida" class="">
                <div class="flex">Geographically Isolated and disadvantaged areas (GIDA)</div>
            </a>

            <div class="flex h-[29px]"><x-ri-arrow-right-s-line class="" /></div>
        </div>

        <!-- Double arrow icon positioned at the bottom right -->
        <div class="bottom-0 right-0">
            <x-radix-double-arrow-left id="closeSidePanel" class="text-white h-[30px]" />
        </div>
    </div>
</div>

<!-- Content to show when full_side_panel is closed -->
<div id="closedContent" class="hidden">
    <div class="w-[100px] h-full bg-[#0CA950] p-4 ">
        <div class="flex flex-col h-full">
            <div class="text-white pb-8 flex flex-row items-center active:bg-[#FFCF35]">
                <div class="flex">BHW</div>

            </div>
            <div class="text-white pb-8 flex flex-row items-center active:bg-[#FFCF35]">
                <div class="flex">LGU</div>

            </div>
            <div class="text-white pb-8 flex flex-row items-center active:bg-[#FFCF35]">
                <div class="flex">GIDA</div>

            </div>

            <div class="bottom-0 right-0">
                <x-radix-double-arrow-right id="openSidePanel" class="text-white h-[30px]" />
            </div>
        </div>
    </div>
    <!-- Add your content here -->
</div>

<script>
    // Add event listener to the double arrow icon to close the side panel
    document.getElementById('closeSidePanel').addEventListener('click', function() {
        // Hide the full side panel
        document.getElementById('full_side_panel').style.display = 'none';

        // Show the content for when the side panel is closed
        document.getElementById('closedContent').style.display = 'block';
    });

    // Add event listener to the double arrow icon to open the side panel
    document.getElementById('openSidePanel').addEventListener('click', function() {
        // Show the full side panel
        document.getElementById('full_side_panel').style.display = 'block';

        // Hide the content for when the side panel is closed
        document.getElementById('closedContent').style.display = 'none';
    });
</script>
