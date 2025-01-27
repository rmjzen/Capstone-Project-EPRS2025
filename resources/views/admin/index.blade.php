<!DOCTYPE html>
<html lang="en">

<x-admin.head />

<body>

    <!-- ======= Header ======= -->
    <x-admin.header />
    <!-- End Header -->
    <!-- Sidebar Here -->

    <x-admin.sidebar />

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        {{-- section inside the content of body left side column --}}
        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Approved Pass Slip Card -->
                        <div class="col-xxl-4 col-md-4">
                            <a href="/viewpass" class="text-decoration-none">
                                <div class="card info-card revenue-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Approved Pass Slip</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-card-checklist"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $totalApproved }}</h6>
                                                <span class="text-muted small pt-2 ps-1">Approved Pass Slip</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- End Approved Pass Slip Card -->

                        <!-- Rejected Pass Slip Card -->
                        <div class="col-xxl-4 col-md-4">
                            <a href="/viewpass" class="text-decoration-none">
                                <div class="card info-card reject-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Rejected Pass Slip</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-card-checklist"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $rejectedPassSlip }}</h6>
                                                <span class="text-muted small pt-2 ps-1">Total Rejected Pass Slip</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- End Rejected Pass Slip Card -->

                        <!-- Pending Pass Slip Card -->
                        <div class="col-xxl-4 col-md-4">
                            <a href="/viewpass" class="text-decoration-none">
                                <div class="card info-card pending-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Pending Pass Slip</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-card-checklist"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $totalPending }}</h6>
                                                <span class="text-muted small pt-2 ps-1">Total Pending Pass Slip</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- End Pending Pass Slip Card -->




                        <!-- Total Pass Slip Card -->
                        <div class="col-xxl-4 col-xl-4">
                            <a href="/viewpass" class="text-decoration-none">
                                <div class="card info-card pass-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Pass Slip</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-people"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $slips->count() }}</h6>
                                                <span class="text-muted small pt-2 ps-1">Total Pass Slip</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- End Pass Slip Card -->

                        <!-- Department Card -->
                        <div class="col-xxl-4 col-md-4">
                            <a href="/viewdepartment" class="text-decoration-none">
                                <div class="card info-card department-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Department</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-buildings"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $departments->count() }}</h6>
                                                <span class="text-muted small pt-2 ps-1">Total Departments</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- End Department Card -->


                        <!-- Designation Card -->
                        <div class="col-xxl-4 col-md-4">
                            <a href="/viewdesignation" class="text-decoration-none">
                                <div class="card info-card sales-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Designation</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-person-bounding-box"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $designations->count() }}</h6>
                                                <span class="text-muted small pt-2 ps-1">Total Designation</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- End Designation Card -->

                        <!-- Purpose Card -->
                        <div class="col-xxl-4 col-md-4">
                            <a href="/viewpurpose" class="text-decoration-none">
                                <div class="card info-card purpose-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Purpose Type</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-journal-text"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $purposes->count() }}</h6>
                                                <span class="text-muted small pt-2 ps-1">Total Purpose Type</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- End Purpose Card -->

                        <!-- Users Card -->
                        <!-- Users Card -->
                        <div class="col-xxl-4 col-xl-4">
                            <a href="/viewhead" class="text-decoration-none">
                                <div class="card info-card user-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Users</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-people"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $totalUsers }}</h6>
                                                <span class="text-muted small pt-2 ps-1">Total Users</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- End Users Card -->

                        <!-- Admin Card -->
                        <div class="col-xxl-4 col-xl-4">
                            <a href="/viewhead" class="text-decoration-none">
                                <div class="card info-card user-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Admin</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-people"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $totalAdmin }}</h6>
                                                <span class="text-muted small pt-2 ps-1">Total Admin</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- End Admin Card -->

                        <!-- Heads Card -->
                        <div class="col-xxl-4 col-xl-4">
                            <a href="/viewhead" class="text-decoration-none">
                                <div class="card info-card user-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Heads</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-people"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $heads->count() }}</h6>
                                                <span class="text-muted small pt-2 ps-1">Total Heads</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- End Heads Card -->

                        <!-- Faculty Card -->
                        <div class="col-xxl-4 col-xl-4">
                            <a href="/viewhead" class="text-decoration-none">
                                <div class="card info-card user-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Faculty</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-people"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $faculty->count() }}</h6>
                                                <span class="text-muted small pt-2 ps-1">Total Faculty</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- End Faculty Card -->


                        <div class="col-xxl-4 col-xl-4">
                            <a href="/barcodelist" class="text-decoration-none">
                                <div class="card info-card user-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Barcode Created</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-upc-scan"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $totalBarcode->count() }}</h6>
                                                <span class="text-muted small pt-2 ps-1">Total Barcode Created</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="col-xxl-4 col-xl-12">
                            <a href="/viewhead" class="text-decoration-none">
                                <div class="card info-card user-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Non-teaching personnel</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-people-fill"></i> <!-- Adjust icon if needed -->
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $totalNonTeaching }}</h6>
                                                <span class="text-muted small pt-2 ps-1">Total Non-teaching
                                                    personnel</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- End Faculty Card -->






                    </div>
                </div><!-- End Left side columns -->



            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <x-admin.footerscript />

</body>

</html>
