<div>
    <div style="width: 100%; max-width: 600px; height: 400px;">
        <canvas id="monitoringStatusChart" wire:ignore></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            var ctx = document.getElementById('monitoringStatusChart').getContext('2d');
            var chartData = @json($chartData);

            var monitoringStatusChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: chartData.datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: { title: { display: true, text: 'Semester' } },
                        y: { title: { display: true, text: 'Jumlah Mahasiswa' }, beginAtZero: true }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Grafik Monitoring',
                            font: { size: 16 }
                        },
                        legend: {
                            position: 'top'
                        }
                    }
                }
            });

            Livewire.on('refreshMonitoringStatusChart', (chartData) => {
                monitoringStatusChart.data.labels = chartData.labels;
                monitoringStatusChart.data.datasets = chartData.datasets;
                monitoringStatusChart.update();
            });
        });
    </script>
</div>
