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
            <h1>Purpose</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Purpose</a></li>
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
                                    <h5 class="card-title">Purpose</h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Purpose Type</th>
                                                <th scope="col">Purpsoe Description</th>
                                                <th scope="col">Date Added</th>
                                                <th scope="col">Option</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($purposes->reverse() as $purpose)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    </th>
                                                    <td>{{ $purpose['purpose_name'] ?? 'Default Name' }}</td>
                                                    <td>{{ $purpose['purpose_description'] ?? 'Technology purpose' }}
                                                    <td>{{ $purpose['created_at'] ? $purpose['created_at']->format('F j, Y') : 'Technology purpose' }}
                                                    </td>

                                                    </td>
                                                    <td>

                                                        <!-- Edit Option -->

                                                        <a href="{{ route('admin.editpurpose', $purpose->id) }}"
                                                            class="btn btn-warning btn-sm">Edit</a>
                                                        <!-- Print Option -->

                                                        <!-- Delete Option -->
                                                        <form action="{{ route('purpose.destroy', $purpose->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to delete this purpose?');">
                                                                Delete
                                                            </button>
                                                        </form>
                                                        <!-- Print Option -->

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
