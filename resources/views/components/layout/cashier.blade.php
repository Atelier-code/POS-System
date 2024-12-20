<x-app>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <body class="bg-slate-100 h-screen" x-data="{ show: false }">
    <div class="w-full h-screen">
        <!-- Navbar -->
        <header class="bg-white shadow sticky top-0 h-16 z-50 px-[5rem] flex items-center justify-between">
            <!-- Logo and Search -->
            <div class="flex items-center w-1/3 gap-12">
                <a href="/cashier/dashboard" class="text-2xl font-bold text-dark">
                    STORE<span class="text-orange-500">POS</span>
                </a>

            </div>

            <!-- User Info -->
            <div class="flex items-center space-x-4">
                <!-- User Details -->
                <div class="hidden lg:flex flex-col text-right">
                    <span class="text-md font-semibold">{{ auth()->user()->name }}</span>
                    <span class="text-sm text-gray-600">{{ auth()->user()->role }}</span>
                </div>
                <!-- Profile Image -->
                <button class="focus:outline-none" @click="show = !show">
                    <img src="https://placehold.co/400" alt="Profile Picture" class="w-12 h-12 rounded-full">
                </button>
            </div>

            <!-- Dropdown Menu -->
            <div
                class="absolute top-[5rem] right-[5rem] w-72 p-4 bg-white rounded-md shadow-lg transform transition-all duration-300 ease-in-out"
                x-show="show"
                x-cloak
                @click.outside="show = false"
            >
                <a href="{{route("cashier.dashboard")}}"
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="inline-block mr-2 bi bi-box-seam-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003zM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z"/>
                    </svg>
                    Dashboard
                </a>

                <a href="{{route("cashier.settings")}}"
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="inline-block bi bi-gear-fill mr-2" viewBox="0 0 16 16">
                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                    </svg>
                    Settings
                </a>
                <a href="{{route('logout')}}"
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="inline-block bi bi-box-arrow-right mr-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6.364 5.636a.5.5 0 0 1 0 .707L4.707 8l1.657 1.657a.5.5 0 0 1-.707.707L3.5 8.707a.5.5 0 0 1 0-.707l2.157-2.157a.5.5 0 0 1 .707 0zM9.5 4a.5.5 0 0 1 .5-.5h4A1.5 1.5 0 0 1 15.5 5v6a1.5 1.5 0 0 1-1.5 1.5h-4a.5.5 0 0 1-.5-.5V11a.5.5 0 0 1 .5-.5h3.5V5.5H9.5A.5.5 0 0 1 9 5V4.5a.5.5 0 0 1 .5-.5z"/>
                    </svg>
                    Logout
                </a>
            </div>
        </header>

        <!-- Main Content -->
        <main class="px-[5rem] py-5 mb-6">
            {{ $slot }}
        </main>
    </div>
    </body>
</x-app>
