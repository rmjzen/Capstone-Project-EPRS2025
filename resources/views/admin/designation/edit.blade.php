<!DOCTYPE html>
<html lang="en">
<x-admin.head />

<body>
    <x-admin.header />
    <x-admin.sidebar />
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Edit Designation</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Designation</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <form action="{{ route('admin.updatedesignation', $designations->id) }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="deptName" class="col-sm-2 col-form-label">Designation Name</label>
                                <div class="col-sm-10">
                                    <input name="designation_name" type="text" class="form-control" id="deptName"
                                        value="{{ old('designation_name', $designations->designation_name) }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="designation_desc" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <input name="designation_desc" type="text" class="form-control"
                                        id="deptDescription"
                                        value="{{ old('designation_desc', $designations->designation_desc) }}" required>
                                </div>
                            </div>

                            <!-- Additional fields can be added here if necessary -->

                            <div class="row mb-3">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                        <!-- End General Form Elements -->
                    </div>
                </div>
                <!-- End Left side columns -->
            </div>
        </section>

    </main><!-- End #main -->
    <x-admin.footerscript />
</body>

</html>
