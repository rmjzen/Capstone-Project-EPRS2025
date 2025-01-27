<!DOCTYPE html>
<html lang="en">
<x-guest.head />

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="/" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block" id="liveTime"></span> <!-- Element to display live time -->
            </a>
        </div><!-- End Logo -->
        <div style="opacity: 0;" class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="/barcode/scan">
                @csrf
                <input type="text" id="barcodeInput" name="code"
                    placeholder="Click here and scan actual time of departure" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div>

        <div style="opacity: 0;" class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="/barcode/scanarrival">
                @csrf
                <input type="text" id="barcodeInputarrival" name="code"
                    placeholder="Click here and scan actual time of arrival" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div>


    </header><!-- End Header -->
    <main>
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show fixed-alert" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show fixed-alert" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <style>
            .fixed-alert {
                position: fixed;
                top: 20px;
                /* Adjust based on your preference */
                left: 50%;
                transform: translateX(-50%);
                z-index: 1050;
                /* Ensures alert is above other content */
                width: auto;
                max-width: 90%;
                /* To ensure it doesn't stretch too much */
                margin: 0;
            }
        </style>
        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Recent Sales -->
                        <<div class="col-12">
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
                                    <h5 class="card-title">Recent Barcode Scanned <span>| Today</span></h5>
                                    <nav>
                                        <h1 id="scanMessage" class="blink-text open-sans-regular"
                                            style="font-size: 24px; color: #333; text-align: center; background-color: #f9f9f9; padding: 15px; border-radius: 8px; border: 2px solid #ccc; font-weight: bold;">
                                            SCAN NOW!
                                        </h1>
                                        <h2 id="countdownMessage"
                                            style="font-size: 50px; color: #ff0000; text-align: center; margin-top: 10px;">
                                            <span id="countdown">5</span>
                                        </h2>

                                        <style>
                                            @keyframes blink {

                                                0%,
                                                100% {
                                                    opacity: 1;
                                                    /* Fully visible */
                                                }

                                                50% {
                                                    opacity: 0;
                                                    /* Fully hidden */
                                                }
                                            }

                                            /* Apply the animation */
                                            .blink-text {
                                                animation: blink 2s infinite;
                                                /* Blink every 3 seconds */
                                            }
                                        </style>

                                        <table class="table table-borderless datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Name</th> <!-- Column for barcode image -->
                                                    <th scope="col">Designation</th>
                                                    <th scope="col">Intended Departure & Arrival</th>
                                                    <th scope="col">Actual Departure</th>
                                                    <th scope="col">Actual Arrival</th>
                                                    <th scope="col">Purpose</th> <!-- Column for approved_by -->
                                                    <th scope="col">Approved by:</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($scannedBarcodes->reverse() as $barcode)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $barcode->slip->user->name ?? 'N/A' }}</td>
                                                        <td>{{ $barcode->slip->user->designation ?? 'N/A' }}</td>
                                                        <td>
                                                            {{ ($barcode->slip->time_departure
                                                                ? \Carbon\Carbon::parse($barcode->slip->time_departure)->format('h:i A')
                                                                : 'N/A') .
                                                                ' | ' .
                                                                ($barcode->slip->time_arrival ? \Carbon\Carbon::parse($barcode->slip->time_arrival)->format('h:i A') : 'N/A') }}
                                                        </td>
                                                        <td>{{ $barcode->actual_time_departure ? \Carbon\Carbon::parse($barcode->actual_time_departure)->format('h:i A') : 'N/A' }}
                                                        </td>
                                                        <td>{{ $barcode->actual_time_arrival ? \Carbon\Carbon::parse($barcode->actual_time_arrival)->format('h:i A') : 'N/A' }}
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="badge {{ $barcode->slip->purpose === 'Personal' ? 'bg-success' : ($barcode->slip->purpose === 'Official' ? 'bg-warning' : 'bg-secondary') }}">
                                                                {{ $barcode->slip->purpose ?? 'N/A' }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-primary"><i
                                                                    class="bi bi-star me-1"></i>
                                                                {{ $barcode->slip->approver->name ?? 'Admin' }}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                </div>

                            </div>
                    </div><!-- End Recent Sales -->
                </div>



            </div>
            </div><!-- End Left side columns -->


            </div>
        </section>

    </main><!-- End #main -->


    {{-- original script in case failed --}}
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const scanMessage = document.getElementById('scanMessage');
            const barcodeInput = document.getElementById('barcodeInput');
            const barcodeInputArrival = document.getElementById('barcodeInputarrival');
            const countdownElement = document.getElementById('countdown');
            const lastFocusedInput = localStorage.getItem('lastFocusedInput');
            let countdown = 5; // Initial countdown value in seconds

            // Function to update the message based on focus
            // function updateMessage(focusedInputId) {
            //     if (focusedInputId === 'barcodeInput') {
            //         scanMessage.textContent = 'NOW SCAN ACTUAL TIME OF DEPARTURE';
            //     } else if (focusedInputId === 'barcodeInputarrival') {
            //         scanMessage.textContent = 'NOW SCAN ACTUAL TIME OF ARRIVAL';
            //     }
            // }

            function updateMessage(focusedInputId) {
                if (focusedInputId === 'barcodeInput') {
                    scanMessage.textContent = ' SCANED DEPARTURE NOW!';
                } else if (focusedInputId === 'barcodeInputarrival') {
                    scanMessage.textContent = ' SCANED ARRIVAL NOW!';
                }
            }

            // Determine which input to focus based on lastFocusedInput
            if (lastFocusedInput === 'barcodeInput') {
                barcodeInputArrival.focus();
                updateMessage('barcodeInputarrival');
                localStorage.setItem('lastFocusedInput', 'barcodeInputarrival');
            } else {
                barcodeInput.focus();
                updateMessage('barcodeInput');
                localStorage.setItem('lastFocusedInput', 'barcodeInput');
            }

            // Add event listeners to update message when inputs gain focus
            barcodeInput.addEventListener('focus', () => {
                updateMessage('barcodeInput');
                localStorage.setItem('lastFocusedInput', 'barcodeInput');
            });

            barcodeInputArrival.addEventListener('focus', () => {
                updateMessage('barcodeInputarrival');
                localStorage.setItem('lastFocusedInput', 'barcodeInputarrival');
            });

            // Countdown logic for page reload
            const countdownInterval = setInterval(() => {
                countdown--;
                countdownElement.textContent = countdown; // Update countdown display
                if (countdown <= 0) {
                    clearInterval(countdownInterval);
                    window.location.reload(); // Reload the page when countdown ends
                }
            }, 1000); // 1 second intervals
        });
        document.getElementById('barcodeInput').addEventListener('change', function(event) {
            const code = event.target.value;

            fetch('/barcode/scan', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        code: code
                    })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message); // Show success or error message
                    document.getElementById('barcoedeInput').value = ''; // Clear input
                    document.getElementById('barcodeInputarrival')
                        .focus(); // Switch focus back to departure input
                })
                .catch(error => console.error('Error:', error));
        });

        document.getElementById('barcodeInputarrival').addEventListener('change', function(event) {
            const code = event.target.value;

            fetch('/barcode/scanarrival', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        code: code
                    })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message); // Show success or error message
                    document.getElementById('barcodeInputarrival').value = ''; // Clear input
                    document.getElementById('barcodeInput').focus(); // Switch focus back to departure input
                })
                .catch(error => console.error('Error:', error));
        });

        function updateTime() {
            const now = new Date();
            const options = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            };
            document.getElementById('liveTime').innerText = now.toLocaleTimeString([], options);
        }

        // Update the time every second
        setInterval(updateTime, 1000);
        updateTime(); // Initial call to set the time immediately
    </script>



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
