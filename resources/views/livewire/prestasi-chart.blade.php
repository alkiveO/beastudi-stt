<div>
    <div style="width: 100%; max-width: 600px; height: 400px;">
        <canvas id="prestasiChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            const colors = [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(199, 199, 199, 0.6)',
                'rgba(83, 102, 255, 0.6)',
                'rgba(255, 102, 255, 0.6)',
            ];

            var ctx = document.getElementById('prestasiChart').getContext('2d');
            var chartData = @json($chartData);

            var prestasiChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.semesters,
                    datasets: Object.keys(chartData.categories).map((key, index) => ({
                        label: chartData.categories[key],
                        data: chartData.semesters.map(semester => chartData.data[semester][key] || 0),
                        backgroundColor: colors[index % colors.length],
                        borderColor: colors[index % colors.length].replace('0.6', '1'),
                        borderWidth: 1,
                    }))
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Grafik Prestasi',
                            font: {
                                size: 16
                            }
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
                            title: {
                                display: true,
                                text: 'Jumlah Mah'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });

            Livewire.on('refreshPrestasiChart', (chartData) => {
                prestasiChart.destroy();

                prestasiChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: chartData.semesters,
                        datasets: Object.keys(chartData.categories).map((key, index) => ({
                            label: chartData.categories[key],
                            data: chartData.semesters.map(semester => chartData.data[semester][key] || 0),
                            backgroundColor: colors[index % colors.length],
                            borderColor: colors[index % colors.length].replace('0.6', '1'),
                            borderWidth: 1,
                        }))
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Grafik Prestasi',
                                font: {
                                    size: 16
                                }
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
                                title: {
                                    display: true,
                                    text: 'Jumlah Mahasiswa'
                                },
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        });
    </script>
</div>
