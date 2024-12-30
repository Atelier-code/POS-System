<div x-data="{ show: false, selectedReport: '' }">


    <!-- Report Type Selection -->
    <div
        x-cloak
        x-show="show"
        x-transition
        class="w-full mb-2 flex flex-col divide-y bg-gray-100 text-black rounded-lg shadow-md"
        @click.away="show = false"
    >
        <button
            wire:click="downloadExcel('d')"
            class="px-4 py-2 hover:bg-gray-200 font-semibold rounded-t-lg"
        >
            Day
        </button>
        <button
            wire:click="downloadExcel('m')"
            class="px-4 py-2 hover:bg-gray-200 font-semibold rounded-b-lg"
        >
            Month
        </button>
    </div>

    <!-- Export Report Button -->
    <button
        @click="show = !show"
        class="flex items-center justify-center gap-2 p-3 bg-gradient-to-r from-blue-500 to-orange-600 text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-200 ease-in-out w-full"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="20"
            height="20"
            fill="currentColor"
            class="bi bi-download"
            viewBox="0 0 16 16"
        >
            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
        </svg>
        <span wire:loading>Loading...</span>
        <span wire:loading.remove>Export Report</span>
    </button>




</div>
