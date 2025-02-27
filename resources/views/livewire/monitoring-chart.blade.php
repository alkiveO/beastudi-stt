<div>
    <div style="width: 100%; max-width: 600px; height: 400px;">
        <canvas id="monitoringChart" wire:ignore style="width: 100%; height: 400px;"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            var ctx = document.getElementById('monitoringChart').getContext('2d');
            var monitoringChart = createChart(ctx, @json($chartData));

            Livewire.on('refreshMonitoringChart', (chartData) => {
                if (monitoringChart) {
                    monitoringChart.destroy();
                }
                monitoringChart = createChart(ctx, chartData);
            });

            function createChart(ctx, chartData) {
                return new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: chartData.semesters,
                        datasets: [
                            {
                                label: 'IPK',
                                data: chartData.ipk,
                                borderColor: '#7987FF',
                                borderWidth: 2,
                                fill: false,
                                tension: 0.3
                            },
                            {
                                label: 'IPS',
                                data: chartData.ips,
                                borderColor: '#FFA5CB',
                                borderWidth: 2,
                                fill: false,
                                tension: 0.3
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Grafik IPK/IPS',
                                font: {
                                    size: 16
                                }
                            }
                        },
                        animation: {
                            duration: 500
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Semester'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Nilai IPK / IPS'
                                },
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
    </script>
</div>
