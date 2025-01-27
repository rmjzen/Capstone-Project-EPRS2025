<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SCAN</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>


    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">EPRS</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->




        <!-- Search Form -->


    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="/scan">
                    <i class="bi bi-grid"></i>
                    <span>Scan</span>
                </a>
            </li><!-- End Dashboard Nav -->



            <li class="nav-item">
                <a class="nav-link collapsed" href="/register">
                    <i class="bi bi-card-list"></i>
                    <span>Register</span>
                </a>
            </li><!-- End Register Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="/login">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Login</span>
                </a>
            </li><!-- End Login Page Nav -->



        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">


        <section class="section dashboard">
            <div class="row">

                <!-- Search Form -->
                <form action="{{ route('scan') }}" method="GET" id="barcode-form">
                    <div class="mb-3">
                        <label for="control_number" class="form-label">Scan or Enter Control Number</label>
                        <input type="text" name="control_number" id="control_number" class="form-control" required
                            autofocus>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="startScanner()">Use Camera to
                        Scan</button>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>

                <video id="camera" style="display:none; width:100%;"></video>

                <!-- Scanned Pass Slip Details -->
                @if (!empty($scannedPassSlips))
                    <div class="col-12 mt-5">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">Scanned Pass Slips</h5>

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Control Number</th>
                                            <th>Department</th>
                                            <th>Purpose</th>
                                            <th>Time of Departure</th>
                                            <th>Time of Arrival</th>
                                            <th>Date of Departure</th>
                                            <th>Date of Arrival</th>
                                            <th>Status</th>
                                            <th>Date Scanned</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($scannedPassSlips->reverse() as $passSlip)
                                            <tr>
                                                <td>{{ $passSlip->control_number }}</td>
                                                <td>{{ $passSlip->department }}</td>
                                                <td>{{ $passSlip->purpose }}</td>
                                                <td>{{ $passSlip->time_departure }}</td>
                                                <td>{{ $passSlip->time_arrival }}</td>
                                                <td>{{ $passSlip->date_departure }}</td>
                                                <td>{{ $passSlip->date_arrival }}</td>
                                                <td>
                                                    <span
                                                        class="badge
                                                @if ($passSlip->status == 'approved') bg-success
                                                @elseif($passSlip->status == 'pending') bg-warning
                                                @elseif($passSlip->status == 'rejected') bg-danger
                                                @else bg-secondary @endif">
                                                        {{ ucfirst($passSlip->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $passSlip->date_scanned ? $passSlip->date_scanned->format('Y-m-d H:i') : 'Not Scanned' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </section>

        <script>
            function startScanner() {
                const video = document.getElementById('camera');
                video.style.display = 'block';

                Quagga.init({
                    inputStream: {
                        name: "Live",
                        type: "LiveStream",
                        target: video,
                    },
                    decoder: {
                        readers: ["code_128_reader"] // Adjust based on your barcode type
                    }
                }, function(err) {
                    if (err) {
                        console.error(err);
                        return;
                    }
                    Quagga.start();
                });

                Quagga.onDetected(function(result) {
                    const code = result.codeResult.code;
                    document.getElementById('control_number').value = code;
                    Quagga.stop();
                    video.style.display = 'none';
                    document.getElementById('barcode-form').submit(); // Automatically submit the form after scanning
                });
            }
        </script>



        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/chart.js/chart.umd.js"></script>
        <script src="assets/vendor/echarts/echarts.min.js"></script>
        <script src="assets/vendor/quill/quill.js"></script>
        <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
        <script src="assets/vendor/tinymce/tinymce.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>

</body>

</html>
