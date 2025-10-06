<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Charts Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Reset & base */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7f8;
            color: #333;
            margin: 0;
            padding: 30px;
        }

        h2 {
            font-weight: 600;
            margin-bottom: 15px;
            color: #2c3e50;
            border-left: 5px solid #3498db;
            padding-left: 10px;
            margin-top: 40px;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        /* Card style for charts */
        .chart-card {
            background: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            padding: 25px 30px;
            border-radius: 12px;
            margin-bottom: 40px;
            transition: box-shadow 0.3s ease;
        }

        .chart-card:hover {
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }

        canvas {
            max-width: 100%;
            height: 300px !important;
        }

        /* Responsive */
        @media (max-width: 600px) {
            body {
                padding: 15px;
            }
            .chart-card {
                padding: 15px 20px;
            }
        }
    </style>
</head>
<body>

    <div class="container">

        <div class="chart-card">
            <h2>Users Registered Per Month</h2>
            <canvas id="usersPerMonthChart"></canvas>
        </div>

        <div class="chart-card">
            <h2>Enrollments Per Course</h2>
            <canvas id="enrollmentsChart"></canvas>
        </div>

        <div class="chart-card">
            <h2>Gender Distribution</h2>
            <canvas id="genderChart"></canvas>
        </div>

    </div>

    <script>
        fetch('<?= site_url('chart-controller/get-chart-data') ?>')
            .then(res => res.json())
            .then(data => {
                // Users per month chart
                const months = data.usersPerMonth.map(item => item.month);
                const userCounts = data.usersPerMonth.map(item => item.total);

                new Chart(document.getElementById('usersPerMonthChart'), {
                    type: 'line',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Users Registered',
                            data: userCounts,
                            borderColor: '#2980b9',
                            backgroundColor: 'rgba(41, 128, 185, 0.2)',
                            fill: true,
                            tension: 0.3,
                            pointRadius: 5,
                            pointHoverRadius: 7,
                            borderWidth: 3
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: true, labels: { color: '#34495e' } }
                        },
                        scales: {
                            x: { ticks: { color: '#7f8c8d' } },
                            y: {
                                beginAtZero: true,
                                ticks: { color: '#7f8c8d' },
                                grid: { color: '#ecf0f1' }
                            }
                        }
                    }
                });

                const courseNames = data.enrollmentsPerCourse.map(item => item.course_name);
                const enrollments = data.enrollmentsPerCourse.map(item => item.total_enrollments);

                new Chart(document.getElementById('enrollmentsChart'), {
                    type: 'bar',
                    data: {
                        labels: courseNames,
                        datasets: [{
                            label: 'Enrollments',
                            data: enrollments,
                            backgroundColor: '#27ae60',
                            borderRadius: 5,
                            maxBarThickness: 30
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: true, labels: { color: '#34495e' } }
                        },
                        scales: {
                            x: { ticks: { color: '#7f8c8d' }, grid: { display: false } },
                            y: {
                                beginAtZero: true,
                                ticks: { color: '#7f8c8d' },
                                // grid: { color: '#ecf0f1' }
                            }
                        }
                    }
                });

                // Gender distribution pie chart
                const genders = data.genderDistribution.map(item => item.gender);
                const genderCounts = data.genderDistribution.map(item => item.total);

                new Chart(document.getElementById('genderChart'), {
                    type: 'pie',
                    data: {
                        labels: genders,
                        datasets: [{
                            label: 'Gender',
                            data: genderCounts,
                            backgroundColor: ['#f39c12', '#3498db', '#9b59b6'],
                            hoverOffset: 20
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { position: 'bottom', labels: { color: '#34495e' } },
                            tooltip: { enabled: true }
                        }
                    }
                });
            })
            .catch(err => {
                console.error('Failed to load chart data', err);
                alert('Failed to load chart data. Please try again later.');
            });
    </script>
</body>
</html>
<?= $this->endSection() ?>
