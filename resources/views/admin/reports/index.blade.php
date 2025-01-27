<!DOCTYPE html>
<html lang="en">
<x-admin.head />

<body>

    <!-- ======= Header ======= -->
    <x-admin.header />
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <x-admin.sidebar />
    <!-- End Sidebar-->

    <!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Chart.js</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Charts</li>
                    <li class="breadcrumb-item active">Chart.js</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <p>Chart.JS Examples. You can check the <a href="https://www.chartjs.org/docs/latest/samples/"
                target="_blank">official website</a> for more examples.</p>

        <section class="section">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Monthly Pass Slip Requests</h5>
                            <!-- Line Chart -->
                            <canvas id="lineChart" style="max-height: 400px;"></canvas>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    const labels = @json($labels);
                                    const data = @json($data);

                                    new Chart(document.querySelector('#lineChart'), {
                                        type: 'line',
                                        data: {
                                            labels: labels,
                                            datasets: [{
                                                label: 'Number of Pass Slips',
                                                data: data,
                                                fill: false,
                                                borderColor: 'rgb(75, 192, 192)',
                                                tension: 0.1
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
                                });
                            </script>
                            <!-- End Line Chart -->
                        </div>
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Bar Chart</h5>

                            <!-- Bar Chart -->
                            <canvas id="barChart" style="max-height: 400px;"></canvas>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    const labels = @json($labels); // Use the labels data from the controller
                                    const dataValues = @json($data); // Use the data counts from the controller

                                    new Chart(document.querySelector('#barChart'), {
                                        type: 'bar',
                                        data: {
                                            labels: labels,
                                            datasets: [{
                                                label: 'Monthly Slip Requests',
                                                data: dataValues,
                                                backgroundColor: [
                                                    'rgba(255, 99, 132, 0.2)',
                                                    'rgba(255, 159, 64, 0.2)',
                                                    'rgba(255, 205, 86, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(54, 162, 235, 0.2)',
                                                    'rgba(153, 102, 255, 0.2)',
                                                    'rgba(201, 203, 207, 0.2)',
                                                    'rgba(255, 99, 132, 0.2)',
                                                    'rgba(255, 159, 64, 0.2)',
                                                    'rgba(255, 205, 86, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(54, 162, 235, 0.2)',
                                                    'rgba(153, 102, 255, 0.2)',
                                                ],
                                                borderColor: [
                                                    'rgb(255, 99, 132)',
                                                    'rgb(255, 159, 64)',
                                                    'rgb(255, 205, 86)',
                                                    'rgb(75, 192, 192)',
                                                    'rgb(54, 162, 235)',
                                                    'rgb(153, 102, 255)',
                                                    'rgb(201, 203, 207)',
                                                    'rgb(255, 99, 132)',
                                                    'rgb(255, 159, 64)',
                                                    'rgb(255, 205, 86)',
                                                    'rgb(75, 192, 192)',
                                                    'rgb(54, 162, 235)',
                                                    'rgb(153, 102, 255)',
                                                ],
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
                                });
                            </script>
                            <!-- End Bar Chart -->

                        </div>
                    </div>
                </div>



                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Overview - Pie Chart</h5>

                            <!-- Pie Chart -->
                            <canvas id="pieChart" style="max-height: 400px;"></canvas>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new Chart(document.querySelector('#pieChart'), {
                                        type: 'pie',
                                        data: {
                                            labels: [
                                                'Departments',
                                                'Designations',
                                                'Purposes',
                                                'Total Slips',
                                                'Faculty',
                                                'Heads of Office',
                                                'Pending Slips',
                                                'Approved Slips',
                                                'Rejected Slips',
                                                'Total Users',
                                                'Admins'
                                            ],
                                            datasets: [{
                                                label: 'Data Distribution',
                                                data: [
                                                    {{ $departments }},
                                                    {{ $designations }},
                                                    {{ $purposes }},
                                                    {{ $slips }},
                                                    {{ $faculty }},
                                                    {{ $heads }},
                                                    {{ $totalPending }},
                                                    {{ $totalApproved }},
                                                    {{ $rejectedPassSlip }},
                                                    {{ $totalUsers }},
                                                    {{ $totalAdmin }}
                                                ],
                                                backgroundColor: [
                                                    'rgb(255, 99, 132)',
                                                    'rgb(54, 162, 235)',
                                                    'rgb(255, 205, 86)',
                                                    'rgb(75, 192, 192)',
                                                    'rgb(153, 102, 255)',
                                                    'rgb(201, 203, 207)',
                                                    'rgb(255, 159, 64)',
                                                    'rgb(100, 181, 246)',
                                                    'rgb(186, 104, 200)',
                                                    'rgb(255, 183, 77)',
                                                    'rgb(77, 208, 225)'
                                                ],
                                                hoverOffset: 4
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            plugins: {
                                                legend: {
                                                    display: true,
                                                    position: 'top'
                                                },
                                                tooltip: {
                                                    callbacks: {
                                                        label: function(context) {
                                                            return context.raw + ' items';
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    });
                                });
                            </script>
                            <!-- End Pie Chart -->

                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main><!-- End #main -->

    <x-admin.footerscript />

</body>

</html>
