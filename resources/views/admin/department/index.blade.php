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
            <h1>Department</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Department</a></li>
                    <li class="breadcrumb-item active">List</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Recent Sales -->
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
                                    <h5 class="card-title">Department<span></span></h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Department Name</th>
                                                <th scope="col">Department Description</th>
                                                <th scope="col">Date Added</th>
                                                <th scope="col">Option</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($departments->reverse() as $department)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    </th>
                                                    <td>{{ $department['dept_name'] ?? 'Default Name' }}</td>
                                                    <td>{{ $department['department_description'] ?? 'Technology Department' }}
                                                    <td>{{ $department['created_at'] ? $department['created_at']->format('F j, Y') : 'Technology Department' }}
                                                    </td>

                                                    </td>
                                                    <td>

                                                        <!-- Edit Option -->
                                                        <a href="{{ route('admin.editdepartment', $department->id) }}"
                                                            class="btn btn-warning btn-sm">Edit</a>
                                                        <!-- Delete Option -->
                                                        <form
                                                            action="{{ route('department.destroy', $department->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to delete this department?');">
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
                        </div><!-- End Recent Sales -->

                    </div>
                </div><!-- End Left side columns -->



            </div>
        </section>

    </main><!-- End #main -->



    <x-admin.footerscript />

</body>

</html>
