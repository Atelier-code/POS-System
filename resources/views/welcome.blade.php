<x-app>
    <div class="container mx-auto h-screen px-6 py-8">
        <!-- Header Section -->
        <div class="flex items-center justify-between pb-4 mb-8 border-b border-gray-300">
            <h2 class="text-3xl font-bold text-gray-900">Cashier Dashboard</h2>
            <a href="#" class="px-4 py-2 bg-red-500 text-white rounded-lg shadow-sm hover:bg-red-600 transition duration-300">
                Logout
            </a>
        </div>

        <!-- Sales Overview Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Sales -->
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold text-gray-700">Total Sales</h3>
                <p class="text-2xl font-bold text-gray-900">GHS 12,345.00</p>
            </div>

            <!-- Transactions -->
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold text-gray-700">Transactions</h3>
                <p class="text-2xl font-bold text-gray-900">150</p>
            </div>

            <!-- Revenue -->
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold text-gray-700">Revenue</h3>
                <p class="text-2xl font-bold text-gray-900">GHS 10,245.00</p>
            </div>
        </div>

        <!-- Actions Section -->
        <div class="flex items-center justify-between mb-8">
            <h3 class="text-xl font-semibold text-gray-900">Sales Records</h3>
            <a href="#" class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow-sm hover:bg-blue-700 transition duration-300">
                + New Sale
            </a>
        </div>

        <!-- Sales Table -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="min-w-full text-left text-gray-700">
                <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 font-medium">#</th>
                    <th class="px-6 py-3 font-medium">Product</th>
                    <th class="px-6 py-3 font-medium">Quantity</th>
                    <th class="px-6 py-3 font-medium">Amount</th>
                    <th class="px-6 py-3 font-medium">Date</th>
                    <th class="px-6 py-3 font-medium text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                <!-- Dummy Rows -->
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4">1</td>
                    <td class="px-6 py-4">Product A</td>
                    <td class="px-6 py-4">10</td>
                    <td class="px-6 py-4">GHS 500.00</td>
                    <td class="px-6 py-4">20-11-2024</td>
                    <td class="px-6 py-4 text-center">
                        <a href="#" class="px-4 py-2 bg-yellow-400 text-white rounded-lg shadow-sm hover:bg-yellow-500 transition duration-300">
                            Edit
                        </a>
                    </td>
                </tr>
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4">2</td>
                    <td class="px-6 py-4">Product B</td>
                    <td class="px-6 py-4">5</td>
                    <td class="px-6 py-4">GHS 250.00</td>
                    <td class="px-6 py-4">19-11-2024</td>
                    <td class="px-6 py-4 text-center">
                        <a href="#" class="px-4 py-2 bg-yellow-400 text-white rounded-lg shadow-sm hover:bg-yellow-500 transition duration-300">
                            Edit
                        </a>
                    </td>
                </tr>
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4">3</td>
                    <td class="px-6 py-4">Product C</td>
                    <td class="px-6 py-4">8</td>
                    <td class="px-6 py-4">GHS 400.00</td>
                    <td class="px-6 py-4">18-11-2024</td>
                    <td class="px-6 py-4 text-center">
                        <a href="#" class="px-4 py-2 bg-yellow-400 text-white rounded-lg shadow-sm hover:bg-yellow-500 transition duration-300">
                            Edit
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="px-6 py-4">
                <nav class="flex justify-between">
                    <a href="#" class="text-gray-600 hover:underline">Previous</a>
                    <a href="#" class="text-gray-600 hover:underline">Next</a>
                </nav>
            </div>
        </div>
    </div>
</x-app>
