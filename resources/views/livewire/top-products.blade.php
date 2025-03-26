<div class="p-2 h-full bg-white w-full lg:w-[35%] rounded-md max-lg:mt-2">
    <h3 class="font-semibold text-xl text-slate-500">This Week's Hits</h3>
    <canvas id="salesChart"></canvas>
</div>

<script src="/js/chart.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const products = @json($products);
        if (!products || products.length === 0) {
            document.getElementById("salesChart").parentElement.innerHTML += '<p class="text-center text-gray-500">No sales data available</p>';
            return;
        }

        const topProducts = products.slice(0, 5);
        const labels = topProducts.map(p => p.name);
        const salesData = topProducts.map(p => p.total_sales_quantity);

        const ctx = document.getElementById("salesChart").getContext("2d");
        new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: labels,
                datasets: [{
                    data: salesData,
                    backgroundColor: ["#6D28D9", "#10B981", "#F59E0B", "#EF4444", "#3B82F6"],
                }],
            },
        });
    });
</script>
