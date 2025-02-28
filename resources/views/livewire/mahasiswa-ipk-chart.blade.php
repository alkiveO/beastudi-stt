<div>
    <div style="width: 100%; max-width: 600px; height: 400px;">
        <canvas id="mahasiswaIpkChart" wire:ignore style="width: 100%; height: 400px;"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            var ctx = document.getElementById('mahasiswaIpkChart').getContext('2d');
            var chartData = @json($chartData);

            var mahasiswaIpkChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [
                        {
                            label: 'IPK',
                            data: chartData.ipk,
                            borderColor: '#7987FF',
                            borderWidth: 2,
                            tension: 0.1,
                        },
                        {
                            label: 'IPS',
                            data: chartData.ips,
                            borderColor: '#FFA5CB',
                            borderWidth: 2,
                            tension: 0.1,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Grafik IPK & IPS',
                            font: { size: 16 }
                        },
                        legend: {
                            position: 'bottom'
                        }
                    },
                    scales: {
                         x: {
                            title: {
                                display: true,
                                text: 'Semester'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            suggestedMax: 4
                        }
                    }
                }
            });
        });
    </script>
</div>
