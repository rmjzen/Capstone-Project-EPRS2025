<!DOCTYPE html>
<html lang="en">

<x-admin.head />


<body>

    <!-- ======= Header ======= -->
    <x-admin.header />
    <!-- End Header -->
    <x-admin.sidebar />
    <!-- End Sidebar-->

    <!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())


            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach


        @endif

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="{{ Auth::check() && Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('assets/img/defaultprofilepic.png') }}"
                                alt="Profile" class="rounded-circle">
                            <h2> {{ Auth::check() ? Auth::user()->name : 'Guest' }}</h2>
                            <h3>{{ Auth::user()->designation ?? 'Faculty' }}</h3>
                            <div class="social-links mt-2">
                                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Overview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                        Profile</button>
                                </li>




                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Change Password</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">


                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ Auth::check() ? Auth::user()->name : 'Guest' }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Department</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ Auth::check() ? Auth::user()->department : 'Unknown' }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ Auth::check() ? Auth::user()->phone_number : 'N/A' }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ Auth::check() ? Auth::user()->email : 'email@gmail.com' }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Account Created</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ Auth::check() ? (Auth::user()->designation === 'Admin' ? 'Admin Created' : (Auth::user()->created_at ? Auth::user()->created_at->format('F j, Y, h:i A') : 'Unavailable')) : 'Unavailable' }}
                                        </div>

                                    </div>



                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <!-- Profile Edit Form -->
                                    <form action="{{ route('admin.updateprofile', $admin->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <!-- Profile Image -->
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                                Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img src="{{ Auth::check() && Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('assets/img/defaultprofilepic.png') }}"
                                                    alt="Profile" class="rounded-circle">
                                                <div class="pt-2">
                                                    <input type="file" name="avatar" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Full Name -->
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="fullName" type="text" class="form-control"
                                                    id="fullName"
                                                    value="{{ Auth::check() ? Auth::user()->name : 'Guest' }}">
                                            </div>
                                        </div>

                                        <!-- Department -->
                                        <div class="row mb-3">
                                            <label for="department"
                                                class="col-md-4 col-lg-3 col-form-label">Department</label>
                                            <div class="col-md-8 col-lg-9">
                                                <select name="department" id="department" class="form-control">
                                                    <option value="" selected disabled>Select Department</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->dept_name }}"
                                                            {{ Auth::check() && Auth::user()->department == $department->dept_name ? 'selected' : '' }}>
                                                            {{ $department->dept_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Phone -->
                                        <div class="row mb-3">
                                            <label for="phone"
                                                class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control"
                                                    id="phone"
                                                    value="{{ Auth::check() ? Auth::user()->phone_number : 'N/A' }}">
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="row mb-3">
                                            <label for="email"
                                                class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control"
                                                    id="email"
                                                    value="{{ Auth::check() ? Auth::user()->email : 'email@gmail.com' }}">
                                            </div>
                                        </div>



                                        <!-- Submit Button -->
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>



                                </div>



                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form method="POST" action="{{ route('password.adminchangepass') }}">
                                        @csrf

                                        <!-- Current Password Field -->
                                        <div class="row mb-3">
                                            <label for="current_password" class="col-sm-2 col-form-label">Current
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input name="current_password" type="password" class="form-control"
                                                    id="current_password" placeholder="Enter current password"
                                                    required>
                                                @error('current_password')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- New Password Field -->
                                        <div class="row mb-3">
                                            <label for="password" class="col-sm-2 col-form-label">New Password</label>
                                            <div class="col-sm-10">
                                                <input name="password" type="password" class="form-control"
                                                    id="password" placeholder="Enter new password (optional)">
                                                @error('password')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Confirm New Password Field -->
                                        <div class="row mb-3">
                                            <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input name="password_confirmation" type="password"
                                                    class="form-control" id="password_confirmation"
                                                    placeholder="Confirm new password">
                                                @error('password_confirmation')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </form>


                                    <!-- End Change Password Form -->

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


    <!-- End Footer -->

    <x-admin.footerscript />

</body>

</html>
