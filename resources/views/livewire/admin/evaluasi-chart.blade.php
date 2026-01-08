<div>
    <div style="width:100%; height:420px;">
        <canvas id="evaluasiSpChart" wire:ignore></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('livewire:load', function () {

            const canvas = document.getElementById('evaluasiSpChart');
            if (!canvas) return;

            const ctx = canvas.getContext('2d');
            let chart = null;

            const COLORS = [
                '#1E88E5', '#E53935', '#FB8C00',
                '#8E24AA',  '#00897B'
            ];

            function createChart(chartData) {

                if (!chartData || !chartData.datasets) return;

                chartData.datasets.forEach((ds, index) => {
                    ds.backgroundColor = COLORS[index % COLORS.length];
                    ds.borderColor = COLORS[index % COLORS.length];
                    ds.borderWidth = 1;
                    ds.borderRadius = 6;
                    ds.maxBarThickness = 35;
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
                                text: 'Distribusi Evaluasi Surat Peringatan (SP) per Program Studi',
                                font: { size: 16, weight: 'bold' }
                            },
                            legend: {
                                position: 'top',
                                labels: {
                                    usePointStyle: true,
                                    pointStyle: 'rect'
                                }
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Jenis Surat Peringatan'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Jumlah Mahasiswa'
                                },
                                ticks: {
                                    precision: 0
                                }
                            }
                        }
                    }
                });
            }

            // INIT
            chart = createChart(@json($chartData));

            // UPDATE DARI LIVEWIRE
            Livewire.on('updateEvaluasiChart', (data) => {
                if (chart) chart.destroy();
                chart = createChart(data);
            });
        });
    </script>
</div>
