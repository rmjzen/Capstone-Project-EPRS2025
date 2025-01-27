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
                <i class="bi bi-journal-text"></i><span>Purpose Type</span><i class="bi bi-chevron-down ms-auto"></i>
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
