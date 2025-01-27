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
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Add User</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">User</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add User</h5>

                            <!-- General Form Elements -->
                            <form action="/createhead" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">
                                        Name</label>
                                    <div class="col-sm-10">
                                        <input name="name" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="departmentSelect" class="col-sm-2 col-form-label">Department</label>
                                    <div class="col-sm-10">
                                        <select name="department" id="departmentSelect" class="form-control">
                                            <option value="" selected disabled>Select Department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->dept_name }}">
                                                    {{ $department->dept_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="designationSelect" class="col-sm-2 col-form-label">Designation</label>
                                    <div class="col-sm-10">
                                        <select name="designation" id="designationSelect" class="form-control">
                                            <option value="" selected disabled>Select Designation</option>
                                            @foreach ($designations as $designation)
                                                <option value="{{ $designation->designation_name }}">
                                                    {{ $designation->designation_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input name="email" type="email" class="form-control" id="inputEmail">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input name="password" type="password" class="form-control" id="inputPassword">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputPhone" class="col-sm-2 col-form-label">Phone
                                        Number</label>
                                    <div class="col-sm-10">
                                        <input name="phone_number" type="tel" class="form-control" id="inputPhone"
                                            placeholder="Enter 11-digit phone number" pattern="[0-9]{11}" maxlength="11"
                                            required>
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Submit</label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>


            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <x-admin.footerscript />

</body>

</html>
