<div class="p-2 rounded-md bg-white lg:w-[75%] w-full ">
    <canvas id="myChart"></canvas>
</div>

@assets
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endassets

@script
<script>
    const ctx = document.getElementById('myChart');
     const data = $wire.monthlySales
    const labels = data.map(item => item.month);
    const value = data.map(item => item.total);

    console.log(data)

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Revenue in last 12 months',
                data: value,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endscript
