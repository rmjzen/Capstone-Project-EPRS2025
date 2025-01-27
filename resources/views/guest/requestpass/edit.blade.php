<!DOCTYPE html>
<html lang="en">

<x-guest.head />

<body>

    <!-- ======= Header ======= -->
    <x-guest.header />
    <!-- End Header -->
    <!-- Sidebar Here -->

    <!-- ======= Sidebar ======= -->
    <x-admin.sidebar />
    <!-- End Sidebar-->


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Department</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Department</a></li>
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
                        <!-- General Form Elements -->
                        <form action="{{ route('guest.guestupdatesliprequest', $request->id) }}" method="POST">
                            @csrf
                            {{-- @method('PUT') --}}
                            <!-- Use PUT method for update -->

                            <!-- Time of Departure -->
                            <div class="row mb-3">
                                <label for="timeDeparture" class="col-sm-2 col-form-label">Time of Departure</label>
                                <div class="col-sm-10">
                                    <input name="time_departure" type="time" class="form-control" id="timeDeparture"
                                        value="{{ old('time_departure', $request->time_departure) }}" required>
                                </div>
                            </div>

                            <!-- Time of Arrival -->
                            <div class="row mb-3">
                                <label for="timeArrival" class="col-sm-2 col-form-label">Time of Arrival</label>
                                <div class="col-sm-10">
                                    <input name="time_arrival" type="time" class="form-control" id="timeArrival"
                                        value="{{ old('time_arrival', $request->time_arrival) }}" required>
                                </div>
                            </div>

                            <!-- Date of Departure -->
                            <div class="row mb-3">
                                <label for="dateDeparture" class="col-sm-2 col-form-label">Date of Departure</label>
                                <div class="col-sm-10">
                                    <input name="date_departure" type="date" class="form-control" id="dateDeparture"
                                        value="{{ old('date_departure', $request->date_departure) }}" required>
                                </div>
                            </div>

                            <!-- Date of Arrival -->
                            <div class="row mb-3">
                                <label for="dateArrival" class="col-sm-2 col-form-label">Date of Arrival</label>
                                <div class="col-sm-10">
                                    <input name="date_arrival" type="date" class="form-control" id="dateArrival"
                                        value="{{ old('date_arrival', $request->date_arrival) }}" required>
                                </div>
                            </div>

                            <!-- Purpose -->
                            <div class="row mb-3">
                                <label for="purpose" class="col-sm-2 col-form-label">Purpose</label>
                                <div class="col-sm-10">
                                    <select name="purpose" id="purpose" class="form-control" required>
                                        <option value="" disabled>Select Purpose</option>
                                        @foreach ($purpose as $p)
                                            <option value="{{ $p->purpose_name }}"
                                                {{ $p->purpose_name == $request->purpose ? 'selected' : '' }}>
                                                {{ $p->purpose_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Reason -->
                            <div class="row mb-3">
                                <label for="reason" class="col-sm-2 col-form-label">Reason</label>
                                <div class="col-sm-10">
                                    <textarea name="reason" class="form-control" id="reason" rows="3" required>{{ old('reason', $request->reason) }}</textarea>
                                </div>
                            </div>

                            <!-- Department -->
                            <div class="row mb-3">
                                <label for="department" class="col-sm-2 col-form-label">Department</label>
                                <div class="col-sm-10">
                                    <select name="department" id="department" class="form-control" required>
                                        <option value="" disabled>Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->dept_name }}"
                                                {{ $department->dept_name == $request->department ? 'selected' : '' }}>
                                                {{ $department->dept_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Head of Office -->
                            <div class="row mb-3">
                                <label for="head_office" class="col-sm-2 col-form-label">Head of Office</label>
                                <div class="col-sm-10">
                                    <select name="head_office" id="head_office" class="form-control" required>
                                        <option value="" disabled>Select Head</option>
                                        @foreach ($heads as $head)
                                            <option value="{{ $head->name }}"
                                                {{ $head->name == $request->head_office ? 'selected' : '' }}>
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

                        <!-- End General Form Elements -->







                    </div>
                </div><!-- End Left side columns -->



            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->

    <x-guest.footerscript />
</body>

</html>
