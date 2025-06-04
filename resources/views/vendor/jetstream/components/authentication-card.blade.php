<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    <div style="border: 2px solid #abcdef;">
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg" style="border: 2px solid gray !important;">
        {{ $slot }}
    </div>
</div>
