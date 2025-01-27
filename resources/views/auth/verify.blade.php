<!DOCTYPE html>
<html lang="en">

<x-guest.head />

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">E-Pass Slip </span>
            </a>

        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">



                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href=""
                        data-bs-toggle="dropdown">
                        <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">Not verified</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

                        <li class="dropdown-header">
                            <h6>
                                <!-- Show authenticated user's name or 'Guest' if not logged in -->
                                {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                            </h6>

                            <!-- Display the user's designation if available, or default to 'Faculty' -->
                            <span>{{ Auth::check() ? Auth::user()->designation : 'Faculty' }}</span>
                            <br>

                            <!-- Show authenticated user's email or 'Guest' -->
                            <span>{{ Auth::check() ? Auth::user()->email : 'Guest' }}</span>
                        </li>


                        <li>
                            <form id="logout-form" action="/verifyout" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item d-flex align-items-center" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Log Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->



    </header>
    <!-- End Header -->



    <main id="" class="main">

        <div class="pagetitle">
            <h1>Buttons</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Components</li>
                    <li class="breadcrumb-item active">Buttons</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">



                    <main>
                        <div class="container">

                            <section
                                class="section error-404  d-flex flex-column align-items-center justify-content-center">

                                <h2>Account Verification Required</h2>
                                <p>We've sent your account verification code to the system administrator.</p>
                                <p>Your account is pending verification. Please contact the administrator to receive
                                    your verification code.</p>
                                <p>Please allow up to 24 hours for your account to be reviewed and verified.</p>

                                <p>If you need immediate assistance, feel free to contact the administrator directly.
                                </p>

                                <p>Once your account is verified, you will be notified and granted access to the system.
                                </p>
                                <p>Thank you for your patience.</p>


                                <div class="row mb-3">
                                    <form action="{{ route('verify') }}" method="POST">
                                        @csrf
                                        <label for="inputText" class="col-sm-2 col-form-label">Code:</label>
                                        <div class="col">
                                            <input placeholder="Enter code to verify " name="verification_code"
                                                type="text" class="form-control">

                                        </div>


                                </div>

                                <button type="submit" class="btn btn-success">Verify</button>

                                </form>


                            </section>

                        </div>
                    </main><!-- End #main -->
                </div>


            </div>
        </section>

    </main><!-- End #main -->





    <x-admin.footerscript />

</body>

</html>
