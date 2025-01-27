<!DOCTYPE html>
<html lang="en">
<x-admin.head />

<body>
    <x-admin.header />
    <x-admin.sidebar />
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Designation</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Designation</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Designation</h5>

                            <!-- General Form Elements -->
                            <form action="/createdesignation" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Designation Name</label>
                                    <div class="col-sm-10">
                                        <input name="designation_name" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <input name="designation_desc" type="text" class="form-control">
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
    <x-admin.footerscript />
</body>
</html>
