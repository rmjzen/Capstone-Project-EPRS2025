<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Barcode</title>
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
    <x-admin.header />
    <!-- End Header -->
    <!-- ======= Sidebar ======= -->
    <x-admin.sidebar />




    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Barcodes</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Barcode</a></li>
                    <li class="breadcrumb-item active">List</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        {{-- section inside the content of body left side column --}}
        <section class="section dashboard">
            <div class="row">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">



                        <!-- Recent Pass Slip -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="#">Today</a></li>
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Recent Barcode Scanned <span>| Today</span></h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>

                                                {{-- <th scope="col">Barcode</th> --}}
                                                <!-- Column for barcode image -->
                                                {{-- <th scope="col">Control Number: </th> --}}
                                                <!-- Column for barcode image -->
                                                <th scope="col">Name</th> <!-- Column for barcode image -->
                                                <th scope="col">Date Created</th> <!-- Column for barcode image -->
                                                <th scope="col">Date Scanned</th> <!-- Column for barcode image -->
                                                {{-- <th scope="col">Status</th>  --}}
                                                <th scope="col">Intended time of Departure | Arrival</th>
                                                <!-- Column for barcode image -->
                                                <th scope="col">Actual time of Departure | Arrival</th>

                                                <!-- Column for barcode image -->
                                                <th scope="col">Approved By</th> <!-- Column for approved_by -->
                                                <th scope="col">Options</th> <!-- Column for approved_by -->


                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($barcodes->reverse() as $barcode)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    {{-- <th scope="row">
                                                        <img src="{{ asset('storage/barcodes/' . $barcode->slip->barcode) }}"
                                                            alt="Barcode for {{ $barcode->slip->control_number }}"
                                                            style="width:100px;" />
                                                    </th> --}}
                                                    {{-- <td>{{ $barcode->slip->control_number ?? 'N/A' }}</td> --}}
                                                    <td>{{ $barcode->slip->user->name ?? 'N/A' }}</td>
                                                    <td>{{ $barcode->slip->created_at ? \Carbon\Carbon::parse($barcode->slip->created_at)->format('F j, Y, g:i A') : 'N/A' }}
                                                    </td>
                                                    <td>{{ $barcode->created_at ? \Carbon\Carbon::parse($barcode->created_at)->format('F j, Y, g:i A') : 'N/A' }}
                                                    </td>

                                                    {{-- <td>
                                                        @if ($barcode->slip->status === 'approved')
                                                            <span class="badge bg-success">Approved</span>
                                                        @endif
                                                    </td> --}}
                                                    <td>
                                                        {{ ($barcode->slip->time_departure
                                                            ? \Carbon\Carbon::parse($barcode->slip->time_departure)->format('h:i A')
                                                            : 'N/A') .
                                                            ' | ' .
                                                            ($barcode->slip->time_arrival ? \Carbon\Carbon::parse($barcode->slip->time_arrival)->format('h:i A') : 'N/A') }}
                                                    </td>
                                                    <td>
                                                        {{ ($barcode->actual_time_departure
                                                            ? \Carbon\Carbon::parse($barcode->actual_time_departure)->format('h:i A')
                                                            : 'N/A') .
                                                            ' | ' .
                                                            ($barcode->actual_time_arrival ? \Carbon\Carbon::parse($barcode->actual_time_arrival)->format('h:i A') : 'N/A') }}
                                                    </td>

                                                    <!-- User who created the slip -->
                                                    <td>
                                                        <span class="badge bg-success">
                                                            {{ $barcode->slip->approver->name ?? 'N/A' }}</span>

                                                    </td>

                                                    <td>

                                                        <button type="button" class="btn btn-info btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#viewModal{{ $barcode->slip->id }}">
                                                            View
                                                        </button>
                                                        <!-- Modal Structure -->
                                                        <!-- "View" button that triggers the modal -->


                                                        <!-- Modal Structure -->
                                                        <!-- "View" button that triggers the modal -->


                                                        <!-- Modal Structure -->
                                                        <div class="modal fade" id="viewModal{{ $barcode->slip->id }}"
                                                            tabindex="-1"
                                                            aria-labelledby="viewModalLabel{{ $barcode->slip->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="viewModalLabel{{ $barcode->slip->id }}">
                                                                            Pass
                                                                            Slip Details</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Display Pass Slip Details -->
                                                                        <p><strong>Name:</strong>
                                                                            {{ $barcode->slip->user->name }}</p>
                                                                        <p><strong>Date Created: </strong>
                                                                            {{ $barcode->slip->created_at ? \Carbon\Carbon::parse($barcode->slip->created_at)->format('F j, Y, g:i A') : 'N/A' }}
                                                                        </p>

                                                                        <p><strong>Control Number:</strong>
                                                                            {{ $barcode->slip->control_number }}</p>



                                                                        <p><strong>Purpose:</strong>
                                                                            {{ $barcode->slip->purpose }}</p>
                                                                        <p><strong>Approving Authority:</strong>
                                                                            {{ $barcode->slip->head_office }} or Admin
                                                                        </p>
                                                                        <p><strong>Reason:</strong>
                                                                            {{ $barcode->slip->reason }}
                                                                        </p>
                                                                        <p><strong>Time of Departure:</strong>
                                                                            {{ \Carbon\Carbon::parse($barcode->slip->time_departure)->format('h:i A') }}
                                                                        </p>
                                                                        <p><strong>Time of Arrival:</strong>
                                                                            {{ \Carbon\Carbon::parse($barcode->slip->time_arrival)->format('h:i A') }}
                                                                        </p>
                                                                        <p><strong>Date of Departure:</strong>
                                                                            {{ \Carbon\Carbon::parse($barcode->slip->date_departure)->format('F j, Y') }}
                                                                        </p>
                                                                        <p><strong>Date of Arrival:</strong>
                                                                            {{ \Carbon\Carbon::parse($barcode->slip->date_arrival)->format('F j, Y') }}
                                                                        </p>

                                                                        <!-- Display Barcode if approved and exists -->
                                                                        @if ($barcode->slip->status === 'approved' && $barcode->slip->barcode)
                                                                            <p><strong>Barcode:</strong></p>
                                                                            <img src="{{ asset('storage/barcodes/' . $barcode->slip->barcode) }}"
                                                                                alt="Barcode for {{ $barcode->slip->control_number }}"
                                                                                style="width:250px;" />
                                                                        @else
                                                                            <p><strong>Barcode:</strong> UNAVAILABLE</p>
                                                                        @endif
                                                                        <p><strong>Approved by:</strong>
                                                                            {{ \App\Models\User::where('id', $barcode->slip->approved_by)->value('name') }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>

                                                                        <!-- Print button -->
                                                                        {{-- @if ($slip->status !== 'approved')
                                                                            <a href="{{ route('guest.guesteditsliprequest', $slip->id) }}"
                                                                                class="btn btn-warning btn-sm">Edit</a>
                                                                        @else
                                                                            <button
                                                                                class="btn btn-warning btn-sm">Edit</button>
                                                                        @endif
                                                                        @if ($slip->status == 'approved')
                                                                            <a href=""
                                                                                class="btn btn-secondary "
                                                                                target="_blank">Print</a>
                                                                        @endif --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>





                                                        <!-- Delete Option -->
                                                        <!-- Delete Option -->
                                                        <form action="{{ route('barcode.destroy', $barcode->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to delete this barcode?');">
                                                                Delete
                                                            </button>
                                                        </form>


                                                    </td>


                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>
                        <!-- End Recent Pass Slip -->



                    </div>
                </div><!-- End Left side columns -->



            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


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
