<!DOCTYPE html>
<html lang="en">

<x-admin.head />

<body>

    <!-- ======= Header ======= -->
    <x-admin.header />
    <!-- End Header -->
    <!-- Sidebar Here -->

    <!-- ======= Sidebar ======= -->
    <!-- ======= Sidebar ======= -->
    <x-admin.sidebar />
    <!-- End Sidebar-->

    <!-- End Sidebar-->


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Head of Office</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Head of Office</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        {{-- section inside the content of body left side column --}}
        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- General Form Elements for Edit -->
                        <form action="{{ route('admin.updatehead', $head->id) }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Head Name</label>
                                <div class="col-sm-10">
                                    <input name="name" type="text" class="form-control"
                                        value="{{ $head->name }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="departmentSelect" class="col-sm-2 col-form-label">Department</label>
                                <div class="col-sm-10">
                                    <select name="department" id="departmentSelect" class="form-control">
                                        <option value="" disabled>Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->dept_name }}"
                                                {{ $head->department == $department->dept_name ? 'selected' : '' }}>
                                                {{ $department->dept_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="departmentSelect" class="col-sm-2 col-form-label">Designation</label>
                                <div class="col-sm-10">
                                    <select name="designation" id="departmentSelect" class="form-control">
                                        <option value="" disabled>Select Designation</option>
                                        @foreach ($designation as $design)
                                            <option value="{{ $design->designation_name }}"
                                                {{ $design->designation_name == $head->designation ? 'selected' : '' }}>
                                                {{ $design->designation_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input name="email" type="email" class="form-control" id="inputEmail"
                                        value="{{ $head->email }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <!-- Leave password field empty to avoid showing it -->
                                    <input name="password" type="password" class="form-control" id="inputPassword"
                                        placeholder="Enter new password (optional)">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPhone" class="col-sm-2 col-form-label">Phone Number</label>
                                <div class="col-sm-10">
                                    <input name="phone_number" type="tel" class="form-control" id="inputPhone"
                                        value="{{ $head->phone_number }}" placeholder="Enter 11-digit phone number"
                                        pattern="[0-9]{11}" maxlength="11" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Submit</label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>







                    </div>
                </div><!-- End Left side columns -->



            </div>
        </section>

    </main><!-- End #main -->

    <x-admin.footerscript />

</body>

</html>
