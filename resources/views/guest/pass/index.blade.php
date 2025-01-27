<!DOCTYPE html>
<html lang="en">

{{-- Head here --}}
<x-guest.head />

<body>

    <!-- ======= Header ======= -->
    <x-guest.header />
    <!-- End Header -->

    {{-- sidebar --}}
    <x-guest.sidebar />



    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Pass Slip</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Pass Sip</a></li>
                    <li class="breadcrumb-item active">Recent Pass Slip</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->


        {{-- section inside the content of body left side column --}}
        <section class="section dashboard">
            <div class="row">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">



                        <!-- Recent Pass Slip -->
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
                                    <h5 class="card-title">Recent Pass Slip</span></h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                {{-- <th scope="col">Control Number</th> --}}
                                                <th scope="col">Date Created</th>
                                                <th scope="col">Barcode</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Options</th>

                                            </tr>
                                        </thead>
                                        <tbody>


                                            <!-- Display slips for the user themselves -->
                                            {{-- @foreach ($slip as $index => $item) --}}

                                            @foreach ($slip->reverse() as $item)
                                                <tr>
                                                    {{-- <th scope="row">{{ $index + 1 }}</th> --}}
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <!-- Display sequential numbers starting from 1 -->
                                                    <th scope="row">
                                                        <a href="#">
                                                            @if (Auth::id() === $item->user->id)
                                                                {{ $item->user->name }}
                                                            @else
                                                                {{ $item->user->name }}
                                                            @endif
                                                        </a>
                                                    </th>

                                                    {{-- <td>{{ $item->control_number ?? 'N/A' }}</td> --}}
                                                    <td>{{ $item->created_at ? $item->created_at->format('F j, Y, h:i A') : 'N/A' }}
                                                    </td>
                                                    <td>
                                                        @if (Auth::check() && $item->status === 'approved' && $item->barcode)
                                                            <img src="{{ asset('storage/barcodes/' . $item->barcode) }}"
                                                                alt="Barcode for {{ $item->control_number }}"
                                                                style="width:100px;" />
                                                        @else
                                                            <span>UNAVAILABLE</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if ($item->status === 'pending')
                                                            <span class="badge bg-warning text-dark">Pending</span>
                                                        @elseif ($item->status === 'approved')
                                                            <span class="badge bg-success">Approved</span>
                                                        @elseif ($item->status === 'disapproved')
                                                            <span class="badge bg-danger">Rejected</span>
                                                        @else
                                                            <span class="badge bg-light text-dark">Unknown</span>
                                                        @endif
                                                    </td>
                                                    <td>

                                                        <!-- Show View button only if status is 'approved' -->
                                                        <!-- "View" button that triggers the modal -->
                                                        @if ($item->status == 'approved')
                                                            <button type="button" class="btn btn-info btn-sm"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#viewModals{{ $item->id }}">
                                                                View
                                                            </button>
                                                        @endif



                                                        <!-- Modal Structure -->
                                                        <div class="modal fade" id="viewModals{{ $item->id }}"
                                                            tabindex="-1"
                                                            aria-labelledby="viewModalLabel{{ $item->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="viewModalLabel{{ $item->id }}">Pass
                                                                            Slip Details</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Display Pass Slip Details -->
                                                                        <p><strong>Name:</strong>
                                                                            {{ $item->user->name }}</p>


                                                                        <p><strong>Control Number:</strong>
                                                                            {{ $item->control_number }}</p>

                                                                        <p><strong>Purpose:</strong>
                                                                            {{ $item->purpose }}</p>
                                                                        <p><strong>Reason:</strong> {{ $item->reason }}
                                                                        </p>
                                                                        <p><strong>Intended Time of Departure:</strong>
                                                                            {{ \Carbon\Carbon::parse($item->time_departure)->format('h:i A') }}
                                                                        </p>
                                                                        <p><strong>Intended Time of Arrival:</strong>
                                                                            {{ \Carbon\Carbon::parse($item->time_arrival)->format('h:i A') }}
                                                                        </p>
                                                                        <p><strong>Date of Departure:</strong>
                                                                            {{ \Carbon\Carbon::parse($item->date_departure)->format('F j, Y') }}
                                                                        </p>
                                                                        <p><strong>Date of Arrival:</strong>
                                                                            {{ \Carbon\Carbon::parse($item->date_arrival)->format('F j, Y') }}
                                                                        </p>

                                                                        <!-- Display Barcode if approved and exists -->
                                                                        @if ($item->status === 'approved' && $item->barcode)
                                                                            <p><strong>Barcode:</strong></p>
                                                                            <img src="{{ asset('storage/barcodes/' . $item->barcode) }}"
                                                                                alt="Barcode for {{ $item->control_number }}"
                                                                                style="width:250px;" />
                                                                        @else
                                                                            <p><strong>Barcode:</strong> UNAVAILABLE</p>
                                                                        @endif
                                                                        <p><strong>Approved by:</strong>
                                                                            {{ \App\Models\User::where('id', $item->approved_by)->value('name') }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>

                                                                        <!-- Print button -->
                                                                        @if ($item->status == 'approved')
                                                                        @else
                                                                            <a href="{{ route('guest.guesteditsliprequest', $item->id) }}"
                                                                                class="btn btn-warning btn-sm">Edit
                                                                            </a>
                                                                        @endif
                                                                        @if ($item->status == 'approved')
                                                                            <a href="{{ route('pass-slip.view', $item->id) }}"
                                                                                class="btn btn-info btn-sm"
                                                                                target="_blank">Print</a>
                                                                        @endif



                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>




                                                        @if (auth()->user()->designation === 'Head of Office')
                                                            <!-- Head of Office can edit and delete -->

                                                            @if ($item->status == 'approved')
                                                            @else
                                                                <a href="{{ route('guest.guesteditsliprequest', $item->id) }}"
                                                                    class="btn btn-warning btn-sm">Edit </a>
                                                            @endif
                                                        @else
                                                            <!-- Non-Head of Office users see conditional buttons -->
                                                            @if ($item->status !== 'approved')
                                                                <a href="{{ route('guest.guesteditsliprequest', $item->id) }}"
                                                                    class="btn btn-warning btn-sm">Edit </a>
                                                            @else
                                                            @endif
                                                        @endif

                                                        @if ($item->status == 'approved')
                                                            <a href="{{ route('pass-slip.view', $item->id) }}"
                                                                class="btn btn-info btn-sm" target="_blank">Print
                                                            </a>
                                                        @endif
                                                        {{-- @if ($item->status == 'approved')
                                                            <a href="{{ route('pass-slip.print', $item->id) }}"
                                                                class="btn btn-info btn-sm" target="_blank">
                                                                Print Now
                                                            </a>
                                                        @endif --}}



{{-- Shit this is so preety --}}

                                                    </td>
                                                </tr>
                                            @endforeach


                                            <!-- Display slips where the logged-in user is the head of office approver -->
                                            @if ($headOfficeSlips->isNotEmpty())

                                                @foreach ($headOfficeSlips as $item)
                                                    <tr>
                                                        {{-- <th scope="row"><a href="#">{{ $item->id }}</a> --}}
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        </th>
                                                        <th scope="row"><a
                                                                href="#">{{ $item->user->name }}</a>
                                                            {{-- <td>{{ $item->control_number ?? 'N/A' }}</td> --}}
                                                        <td>{{ $item->created_at ? $item->created_at->format('F j, Y, h:i A') : 'N/A' }}
                                                        </td>
                                                        <td>
                                                            @if ($item->status === 'approved' && $item->barcode)
                                                                <img src="{{ asset('storage/barcodes/' . $item->barcode) }}"
                                                                    alt="Barcode for {{ $item->control_number }}"
                                                                    style="width:100px;" />
                                                            @else
                                                                <span>UNAVAILABLE</span>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            @if ($item->status === 'pending')
                                                                <span class="badge bg-warning text-dark">Pending</span>
                                                            @elseif ($item->status === 'approved')
                                                                <span class="badge bg-success">Approved</span>
                                                            @elseif ($item->status === 'disapproved')
                                                                <span class="badge bg-danger">Rejected</span>
                                                            @else
                                                                <span class="badge bg-light text-dark">Unknown</span>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            @if (auth()->user()->designation === 'Head of Office')
                                                                <button type="button" class="btn btn-info btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#viewModalshead{{ $item->id }}">
                                                                    View
                                                                </button>

                                                                <!-- Head of Office Approve and Disapprove Buttons for Pending Status -->
                                                                @if ($item->status == 'pending')
                                                                    <form
                                                                        action="{{ route('headOffice.slip.approve', $item->id) }}"
                                                                        method="POST" style="display:inline-block;">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="btn btn-success btn-sm"
                                                                            onclick="return confirm('Are you sure you want to approve this pass slip?');">Approve</button>
                                                                    </form>

                                                                    <form
                                                                        action="{{ route('headOffice.slip.disapprove', $item->id) }}"
                                                                        method="POST" style="display:inline-block;">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="btn btn-danger btn-sm"
                                                                            onclick="return confirm('Are you sure you want to reject this pass slip?');">Reject</button>
                                                                    </form>
                                                                @endif

                                                                @if ($item->status == 'approved')
                                                                    <a href="{{ route('pass-slip.view', $item->id) }}"
                                                                        class="btn btn-info btn-sm"
                                                                        target="_blank">Print</a>
                                                                @endif

                                                                <!-- Show View button only if status is 'approved' -->



                                                                <!-- Modal Structure -->
                                                                <div class="modal fade"
                                                                    id="viewModalshead{{ $item->id }}"
                                                                    tabindex="-1"
                                                                    aria-labelledby="viewModalLabel{{ $item->id }}"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="viewModalLabel{{ $item->id }}">
                                                                                    Indivdual Pass/Time Adjustment Slip
                                                                                </h5>

                                                                                <button type="button"
                                                                                    class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <!-- Display Pass Slip Details -->
                                                                                <p><strong>Name:</strong>
                                                                                    {{ $item->user->name }}</p>
                                                                                <p><strong>Date Created:</strong>
                                                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('F j, Y h:i A') }}

                                                                                </p>
                                                                                <p><strong>Intended time of
                                                                                        Departure:</strong>
                                                                                    {{ \Carbon\Carbon::parse($item->time_departure)->format('h:i A') }}
                                                                                </p>
                                                                                <p><strong>Intended Time of
                                                                                        Arrival:</strong>
                                                                                    {{ \Carbon\Carbon::parse($item->time_arrival)->format('h:i A') }}
                                                                                </p>
                                                                                <p><strong>Purpose:</strong>
                                                                                    {{ $item->purpose }}</p>
                                                                                <p><strong>Reason:</strong>
                                                                                    {{ $item->reason }}
                                                                                </p>


                                                                                <p><strong>Date of Departure:</strong>
                                                                                    {{ \Carbon\Carbon::parse($item->date_departure)->format('F j, Y') }}
                                                                                </p>
                                                                                <p><strong>Date of Arrival:</strong>
                                                                                    {{ \Carbon\Carbon::parse($item->date_arrival)->format('F j, Y') }}
                                                                                </p>

                                                                                <!-- Display Barcode if approved and exists -->
                                                                                @if ($item->status === 'approved' && $item->barcode)
                                                                                    <p><strong>Barcode:</strong></p>
                                                                                    <img src="{{ asset('storage/barcodes/' . $item->barcode) }}"
                                                                                        alt="Barcode for {{ $item->control_number }}"
                                                                                        style="width:250px;" />
                                                                                @else
                                                                                    <p><strong>Barcode:</strong>
                                                                                        UNAVAILABLE</p>
                                                                                @endif
                                                                                <p><strong>Approved by:</strong>
                                                                                    {{ \App\Models\User::where('id', $item->approved_by)->value('name') }}
                                                                                </p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary btn-sm"
                                                                                    data-bs-dismiss="modal">Close</button>

                                                                                @if ($item->status == 'approved')
                                                                                    <a href="{{ route('pass-slip.view', $item->id) }}"
                                                                                        class="btn btn-info btn-sm"
                                                                                        target="_blank">Print</a>
                                                                                @endif



                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <!-- Non-Head of Office Users -->




                                                                @if (auth()->user()->designation === 'Head of Office' || $item->status !== 'approved')
                                                                    <a href="{{ route('guest.guesteditsliprequest', $item->id) }}"
                                                                        class="btn btn-warning btn-sm">Edit </a>
                                                                @else
                                                                    <button
                                                                        class="btn btn-warning btn-sm">Edit</button>
                                                                @endif

                                                                @if ($item->status == 'approved')
                                                                    <a href="{{ route('pass-slip.view', $item->id) }}"
                                                                        class="btn btn-info btn-sm"
                                                                        target="_blank">Print</a>
                                                                @endif
                                                            @endif
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif




                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>
                        <!-- End Recent Pass Slip -->



                    </div>
                </div><!-- End Left side columns -->



            </div>
        </section>

    </main><!-- End #main -->

    <x-guest.footerscript />


</body>

</html>
