<div>
    <div style="width:100%; height:420px;">
        <canvas id="jalurBeastudiChart" wire:ignore></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('livewire:load', function () {

            const ctx = document.getElementById('jalurBeastudiChart').getContext('2d');
            let chart;

            const COLORS = [
                'rgb(238, 57, 18)','#FF9800', 'rgba(77, 68, 181, 1)',
                '#9C27B0', '#00BCD4', '#795548'
            ];

            function createChart(chartData) {

                chartData.datasets.forEach((ds, index) => {
                    ds.backgroundColor = COLORS[index % COLORS.length];
                    ds.borderRadius = 6;
                    ds.maxBarThickness = 40;
                });

                return new Chart(ctx, {
                    type: 'bar',
                    data: chartData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Distribusi Jalur Beastudi berdasarkan Program Studi',
                                font: { size: 16, weight: 'bold' }
                            },
                            legend: {
                                position: 'top'
                            }
                        },
                        scales: {
                            x: {
                                stacked: false,
                                title: {
                                    display: true,
                                    text: 'Jalur Beasiswa'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Jumlah Mahasiswa'
                                }
                            }
                        }
                    }
                });
            }

            chart = createChart(@json($chartData));

            Livewire.on('updateJalurBeastudiChart', (data) => {
                if (chart) chart.destroy();
                chart = createChart(data);
            });
        });
    </script>
</div>
