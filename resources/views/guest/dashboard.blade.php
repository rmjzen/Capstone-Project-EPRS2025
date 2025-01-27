<!DOCTYPE html>
<html lang="en">

{{-- Head here --}}
<x-guest.head />

<body>

    <!-- ======= Header ======= -->
    <x-guest.header />
    <!-- End Header -->
    <!-- Sidebar Here -->

    <x-guest.sidebar />

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

                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <div class="row">
                            <!-- Total Pass Slip Requests Card -->
                            <div class="col-xxl-4 col-md-4">
                                <a href="/guestpass" class="text-decoration-none">
                                    <div class="card info-card total-card">
                                        <div class="card-body">
                                            <h5 class="card-title">Total Pass Slip Requests</h5>
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-file-earmark-text"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>{{ $totalPassSlips }}</h6>
                                                    <span class="text-muted small pt-2 ps-1">Total Pass Slip
                                                        Requests</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>


                            @if ($userDesignation === 'Head of Office')
                                <!-- Chosen as Approver Card -->
                                <div class="col-xxl-4 col-md-4">
                                    <a href="/guestpass" class="text-decoration-none">
                                        <div class="card info-card approver-card">
                                            <div class="card-body">
                                                <h5 class="card-title">Chosen as Approver</h5>
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-person-check"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <h6>{{ $chosenAsApproverCount }}</h6>
                                                        <span class="text-muted small pt-2 ps-1">Number of Users Who
                                                            Chose You as Approver</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif

                            <!-- Approved Pass Slip Card -->
                            <div class="col-xxl-4 col-md-4">
                                <a href="/guestpass" class="text-decoration-none">
                                    <div class="card info-card revenue-card">
                                        <div class="card-body">
                                            <h5 class="card-title">Approved Pass Slip</h5>
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-card-checklist"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>{{ $approvedPassSlip }}</h6>
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
                                <a href="/guestpass" class="text-decoration-none">
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
                                                    <span class="text-muted small pt-2 ps-1">Total Rejected Pass
                                                        Slip</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- End Rejected Pass Slip Card -->

                            <!-- Pending Pass Slip Card -->
                            <div class="col-xxl-4 col-md-4">
                                <a href="/guestpass" class="text-decoration-none">
                                    <div class="card info-card pending-card">
                                        <div class="card-body">
                                            <h5 class="card-title">Pending Pass Slip</h5>
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-card-checklist"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>{{ $pendingPassSlips }}</h6>
                                                    <span class="text-muted small pt-2 ps-1">Total Pending Pass
                                                        Slip</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- End Pending Pass Slip Card -->


                            <!-- Total Pass Slip Card -->
                            <div class="col-xxl-4 col-xl-4">
                                <a href="/guestpass" class="text-decoration-none">
                                    <div class="card info-card pass-card">
                                        <div class="card-body">
                                            <h5 class="card-title">Pass Slip</h5>
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-people"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>{{ $totalPassSlips }}</h6>
                                                    <span class="text-muted small pt-2 ps-1">Total Pass Slip</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- End Customers Card -->
                        </div>
                    </div><!-- End Left side columns -->



                </div>
        </section>

    </main><!-- End #main -->
    <!-- ======= Footer ======= -->
    <x-guest.footerscript />

</body>

</html>
