<div>
    <div>
        <canvas id="programStudiChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('livewire:load', function () {
            const ctx = document.getElementById('programStudiChart').getContext('2d');
            ctx.height = 100;

            // Convert PHP data to JavaScript object
            const dataFromPHP = @json($data);

            // Extract years
            const years = Object.keys(dataFromPHP);

            // Prepare data for each dataset
            const sistemInformasiData = years.map(year =>
                dataFromPHP[year]['sistem informasi'] || 0
            );
            const teknikInformatikaData = years.map(year =>
                dataFromPHP[year]['teknik informatika'] || 0
            );
            const bisnisDigitalData = years.map(year =>
                dataFromPHP[year]['bisnis digital'] || 0
            );

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: years,
                    datasets: [
                        {
                            label: "Sistem Informasi",
                            data: sistemInformasiData,
                            borderColor: 'rgb(238, 137, 18)',
                            borderWidth: 1,
                            backgroundColor: 'rgb(238, 137, 18)',
                        },
                        {
                            label: "Teknik Informatika",
                            data: teknikInformatikaData,
                            borderColor: 'rgba(77, 68, 181, 1)',
                            borderWidth: 1,
                            backgroundColor: 'rgba(77, 68, 181, 1)',
                        },
                        {
                            label: "Bisnis Digital",
                            data: bisnisDigitalData,
                            borderColor: 'rgb(238, 57, 18)',
                            borderWidth: 1,
                            backgroundColor: 'rgb(238, 57, 18)',
                        }
                    ]
                },
                options: {
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Grafik Beastudi',
                            font: {
                                size: 16
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true, // Ensure the scale starts at zero
                            max: 100, // Force y-axis to go up to 100
                            ticks: {
                                stepSize: 10 // Ensure y-axis increments by 10
                            },
                            title: {
                                display: true,
                                text: 'Jumlah Mahasiswa'
                            }
                        },
                        x: {
                            barPercentage: 0.7, // Control width of bars
                            categoryPercentage: 0.5, // Space between bars in the same group
                            title: {
                                display: true,
                                text: 'Angkatan'
                            }
                        }
                    }
                }
            });
        });
    </script>
</div>
