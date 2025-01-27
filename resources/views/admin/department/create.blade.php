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
            <h1>Create Department</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Department</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Department</h5>

                            <!-- General Form Elements -->
                            <form action="/department" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Department Name</label>
                                    <div class="col-sm-10">
                                        <input name="dept_name" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <input name="dept_description" type="text" class="form-control">
                                    </div>
                                </div>
                                <!--
                                                <div class="row mb-3">
                                                      <label class="col-sm-2 col-form-label">Head Of the Department</label>
                                                      <div class="col-sm-10">
                                                            <select class="form-select" aria-label="Default select example">
                                                                  <option selected>Open this select menu</option>
                                                                  <option value="1">One</option>
                                                                  <option value="2">Two</option>
                                                                  <option value="3">Three</option>
                                                            </select>
                                                      </div>
                                                </div> -->



                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Submit</label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                            </form><!-- End General Form Elements -->

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
