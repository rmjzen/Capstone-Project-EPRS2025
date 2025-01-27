<!DOCTYPE html>
<html lang="en">

<x-admin.head />

<body>

    <!-- ======= Header ======= -->
    <x-admin.header />

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-heading">Home</li>

            <li class="nav-item">
                <a class="nav-link collapsed " href="/admin">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed " href="/viewpass">
                    <i class="bi bi-card-heading"></i>
                    <span>Pass Slip</span>
                </a>
            </li>

            <!-- End Pass Slip Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed " href="/requestpass">
                    <i class="bi bi-calendar4-range"></i>
                    <span>Request Pass Slip</span>
                </a>
            </li>
            <!-- End Request Pass Slip Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#department" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-buildings"></i><span>Department</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="department" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                    <li>
                        <a href="/viewdepartment">
                            <i class="bi bi-circle-fill"></i><span>List of Department</span>
                        </a>
                    </li>
                    <li>
                        <a href="/department">
                            <i class="bi bi-circle-fill"></i><span>Create Department</span>
                        </a>
                    </li>


                </ul>
            </li><!-- End Department Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#designation" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person-bounding-box"></i><span>Designation</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="designation" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                    <li>
                        <a href="/viewdesignation">
                            <i class="bi bi-circle-fill"></i><span>Designation List</span>
                        </a>
                    </li>
                    <li>
                        <a href="/viewcreatedesignation">
                            <i class="bi bi-circle-fill"></i><span>Create Designation</span>
                        </a>
                    </li>

                </ul>
            </li>
            <!-- End Designation Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#purpose" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Purpose Type</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="purpose" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/viewpurpose">
                            <i class="bi bi-circle-fill"></i><span>Purpose List</span>
                        </a>
                    </li>
                    <li>
                        <a href="/viewcreatepurpose">
                            <i class="bi bi-circle-fill"></i><span>Create Purpose</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Purpose Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#head" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person-square"></i><span>User Management</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="head" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/viewhead">
                            <i class="bi bi-circle"></i><span>List of Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="/viewheadtype">
                            <i class="bi bi-circle"></i><span>Head Type list</span>
                        </a>
                    </li>
                    <li>
                        <a href="/pleaseheadtypepost">
                            <i class="bi bi-circle"></i><span>Add head type</span>
                        </a>
                    </li>
                    <li>
                        <a href="/viewcreatehead">
                            <i class="bi bi-circle"></i><span>Add User</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- End Head Of Office Nav -->

            {{-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#faculty" data-bs-toggle="collapse" href="#">
                <i class="bi bi-person-lines-fill"></i><span>Faculty</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="faculty" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/viewfaculty">
                        <i class="bi bi-circle"></i><span>List of Faculty</span>
                    </a>
                </li>
                <li>
                    <a href="/viewcreatefaculty">
                        <i class="bi bi-circle"></i><span>Add Faculty</span>
                    </a>
                </li>
            </ul>
        </li> --}}
            <!-- End Faculty Nav -->


            {{-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#passslip" data-bs-toggle="collapse" href="#">
                <i class="bi bi-card-checklist"></i><span>Pass Slip Management</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="passslip" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="charts-chartjs.html">
                        <i class="bi bi-circle"></i><span>Total Pass Slip</span>
                    </a>
                </li>
                <li>
                    <a href="charts-apexcharts.html">
                        <i class="bi bi-circle"></i><span>Pending Pass Slip</span>
                    </a>
                </li>
                <li>
                    <a href="charts-apexcharts.html">
                        <i class="bi bi-circle"></i><span>Rejected Pass Slip</span>
                    </a>
                </li>
                <li>
                    <a href="charts-echarts.html">
                        <i class="bi bi-circle"></i><span>Approved But Cancelled Pass Slip</span>
                    </a>
                </li>
            </ul>
        </li><!-- End pass Management Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#user" data-bs-toggle="collapse" href="#">
                <i class="bi bi-card-checklist"></i><span>User Management</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="user" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="charts-chartjs.html">
                        <i class="bi bi-circle"></i><span>All User</span>
                    </a>
                </li>
                <li>
                    <a href="charts-apexcharts.html">
                        <i class="bi bi-circle"></i><span>ApexCharts</span>
                    </a>
                </li>
                <li>
                    <a href="charts-echarts.html">
                        <i class="bi bi-circle"></i><span>ECharts</span>
                    </a>
                </li>
            </ul>
        </li><!-- End pass Management Nav --> --}}



            <li class="nav-heading">Barcode List</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="/barcodelist">
                    <i class="bi bi-upc"></i>
                    <span>Barcode List</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-heading">Barcode Scan</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="/barcode-scan">
                    <i class="bi bi-upc-scan"></i>
                    <span>Barcode Scan</span>
                </a>
            </li><!-- End Profile Page Nav -->



            <li class="nav-heading">Reports</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="/reports">
                    <i class="bi bi-bar-chart-steps"></i>
                    <span>Reports</span>
                </a>
            </li><!-- End Profile Page Nav -->
            <li class="nav-heading">Settings</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="/adminprofile">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Page Nav -->


            {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="pages-contact.html">
                <i class="bi bi-envelope"></i>
                <span>Contact</span>
            </a>
        </li><!-- End Contact Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-register.html">
                <i class="bi bi-card-list"></i>
                <span>About Us</span>
            </a>
        </li><!-- End Register Page Nav --> --}}

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-login.html">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Logout</span>
                </a>
            </li><!-- End Login Page Nav -->



        </ul>

    </aside>
    <!-- End Sidebar-->

    <!-- End Sidebar-->

    <!-- End Sidebar-->


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Request Pass Slip</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Request Pass Slip</a></li>
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

                        <!-- General Form Elements -->
                        <form action="{{ route('admin.updateRequest', $requestPass->id) }}" method="POST">
                            @csrf

                            <!-- Time of Departure -->
                            <div class="row mb-3">
                                <label for="timeDeparture" class="col-sm-2 col-form-label">Time of
                                    Departure</label>
                                <div class="col-sm-10">
                                    <input name="time_departure" type="time" class="form-control"
                                        id="timeDeparture"
                                        value="{{ old('time_departure', $requestPass->time_departure) }}">
                                </div>
                            </div>

                            <!-- Time of Arrival -->
                            <div class="row mb-3">
                                <label for="timeArrival" class="col-sm-2 col-form-label">Time of Arrival</label>
                                <div class="col-sm-10">
                                    <input name="time_arrival" type="time" class="form-control" id="timeArrival"
                                        value="{{ old('time_arrival', $requestPass->time_arrival) }}">
                                </div>
                            </div>

                            <!-- Date of Departure -->
                            <div class="row mb-3">
                                <label for="dateDeparture" class="col-sm-2 col-form-label">Date of
                                    Departure</label>
                                <div class="col-sm-10">
                                    <input name="date_departure" type="date" class="form-control"
                                        id="dateDeparture"
                                        value="{{ old('date_departure', $requestPass->date_departure) }}">
                                </div>
                            </div>

                            <!-- Date of Arrival -->
                            <div class="row mb-3">
                                <label for="dateArrival" class="col-sm-2 col-form-label">Date of Arrival</label>
                                <div class="col-sm-10">
                                    <input name="date_arrival" type="date" class="form-control" id="dateArrival"
                                        value="{{ old('date_arrival', $requestPass->date_arrival) }}">
                                </div>
                            </div>

                            <!-- Purpose -->
                            <div class="row mb-3">
                                <label for="purpose" class="col-sm-2 col-form-label">Purpose</label>
                                <div class="col-sm-10">
                                    <select name="purpose" id="purpose" class="form-control">
                                        <option value="" disabled>Select Purpose</option>
                                        @foreach ($purpose as $purp)
                                            <option value="{{ $purp->purpose_name }}"
                                                {{ $purp->purpose_name == $requestPass->purpose ? 'selected' : '' }}>
                                                {{ $purp->purpose_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- status -->
                            <div class="row mb-3">
                                <label for="status" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select name="status" id="status" class="form-control">
                                        <option value="" disabled>Select Status</option>
                                        <option value="pending"
                                            {{ $requestPass->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved"
                                            {{ $requestPass->status == 'approved' ? 'selected' : '' }}>Approved
                                        </option>
                                        <option value="disapproved"
                                            {{ $requestPass->status == 'disapproved' ? 'selected' : '' }}>Disapproved
                                        </option>
                                    </select>
                                </div>
                            </div>


                            <!-- Reason -->
                            <div class="row mb-3">
                                <label for="reason" class="col-sm-2 col-form-label">Reason</label>
                                <div class="col-sm-10">
                                    <textarea name="reason" class="form-control" id="reason" rows="3">{{ old('reason', $requestPass->reason) }}</textarea>
                                </div>
                            </div>

                            <!-- Department -->
                            <div class="row mb-3">
                                <label for="department" class="col-sm-2 col-form-label">Department</label>
                                <div class="col-sm-10">
                                    <select name="department" id="department" class="form-control">
                                        <option value="" disabled>Select Department</option>
                                        @foreach ($departments as $dept)
                                            <option value="{{ $dept->dept_name }}"
                                                {{ $dept->dept_name == $requestPass->department ? 'selected' : '' }}>
                                                {{ $dept->dept_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Head of Office -->
                            <div class="row mb-3">
                                <label for="head_office" class="col-sm-2 col-form-label">Approving Authority</label>
                                <div class="col-sm-10">
                                    <select name="head_office" id="head_office" class="form-control">
                                        <option value="" disabled>Select Head</option>
                                        @foreach ($heads as $head)
                                            <option value="{{ $head->name }}"
                                                {{ $head->name == $requestPass->head_office ? 'selected' : '' }}>
                                                {{ $head->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row mb-3">
                                <div class="col-sm-10 offset-sm-2">
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
