<div>
    <div class="card">
        <div class="card-body">
            <canvas id="monitoringStatusChart" wire:ignore></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            var ctx = document.getElementById('monitoringStatusChart').getContext('2d');
            var chartData = @json($chartData);

            var monitoringStatusChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Jumlah Mahasiswa',
                        data: chartData.data,
                        backgroundColor: chartData.colors,
                        borderWidth: 1,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Grafik Monitoring',
                            font: { size: 16 }
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            Livewire.on('refreshmonitoringStatusChart', (chartData) => {
                monitoringStatusChart.data.labels = chartData.labels;
                monitoringStatusChart.data.datasets[0].data = chartData.data;
                monitoringStatusChart.data.datasets[0].backgroundColor = chartData.colors;
                monitoringStatusChart.update();
            });
        });
    </script>

</div>
