<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Individual Pass/Time Adjustment Slip</title>
    <style>
        @media print {
            img {
                max-width: 100%;
                height: auto;
                display: block;
            }
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

        .flex-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            /* Spacing between the two slips */
        }

        .container {
            width: 400px;
            border: 4px solid black;
            padding: 10px;
        }

        .header {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .row {
            margin-bottom: 5px;
            align-items: left;
            text-align: left;
        }

        .label {
            display: inline-block;
            width: 150px;
            text-align: left;
        }

        .input {
            width: 200px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .separator {
            border-top: 2px solid black;
            margin-top: 8px;
            margin-bottom: 8px;
        }

        .separatornew {
            border-top: 1px solid black;
            margin-top: 6px;
            margin-bottom: 6px;
        }

        .separatornewnew {
            border-top: 1px solid black;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .separatortranspo {
            border-top: 1px solid black;
            margin-top: 6px;
            margin-bottom: 6px;
        }

        .separatornospace {
            border-top: 1px solid black;
            margin-top: 2px;
            margin-bottom: 2px;
        }


        .separatornospaceguard {
            border-top: 1px solid black;
            margin-top: 1px;
            margin-bottom: 1px;
        }



        img {
            margin: auto;
            width: 250px;
        }
    </style>
</head>

<body>
    <!-- Flex container to hold both slips -->
    <div class="flex-container">
        <!-- Original Slip -->
        {{-- 
  <div class="container">
            <!-- Original content -->
            <div class="header">
                INDIVIDUAL PASS/TIME ADJUSTMENT SLIP
            </div>
            <div class="separator"></div>

            <div class="header">
                TO BE FILLED OUT BY THE REQUESTING EMPLOYEE
            </div>
            <div class="separator"></div>

            <div class="row">
                <span>Name:</span>
                <span>{{ $slip->user->name }}</span>
            </div>

            <div class="row">
                <span>Date:</span>
                <span>{{ $slip->created_at->format('F j, Y') }}</span>
            </div>

            <div class="separator"></div>

            <!-- <div class="row">
                <span>Control Number:</span>
                <span>{{ $slip->control_number }}</span>
            </div>

            <div class="row">
                <img src="{{ asset('storage/barcodes/' . $slip->barcode) }}"
                    alt="Barcode for {{ $slip->control_number }}">
            </div> -->

            <div class="separator"></div>

            <div class="header">
                Permission is requested to Leave the Office premises during office hours from:
            </div>

            <div class="row">
                <span>Intended time of Departure:</span>
                <span>{{ \Carbon\Carbon::parse($slip->time_departure)->format('h:i A') }}</span>
            </div>

            <div class="row">
                <span>Intended time of Arrival:</span>
                <span>{{ \Carbon\Carbon::parse($slip->time_arrival)->format('h:i A') }}</span>
            </div>

            <div class="row">
                <span>Purpose:</span>
                <span>{{ $slip->purpose }}</span>
            </div>

            <div class="row">
                <span>Reason:</span>
                <span>{{ $slip->reason }}</span>
            </div>

            <div class="separator"></div>

            <div class="header">
                TO BE FILLED OUT BY THE APPROVING AUTHORITY
            </div>
            <div class="separator"></div>

            <div class="row"> <br>
                <span>Approved By:</span>
                <span><strong>{{ strtoupper(\App\Models\User::where('id', $slip->approved_by)->value('name')) }}</strong></span>

            </div>
            <br>
            <div class="separator"></div>

            <div class="header">
                FILLED OUT BY GUARD OR BARCODE SCANNED
            </div>
            <div class="separator"></div>

            <div class="row">
                <span ">Date Scanned:</span>
                <span>
                    @php
                        $barcode = $slip->barcodes->where('slip_id', $slip->id)->first();
                    @endphp
                    {{ $barcode && $barcode->created_at
                        ? \Carbon\Carbon::parse($barcode->created_at)->format('M d, Y h:i A')
                        : 'N/A' }}
                </span>
            </div>
            <div class="row">
                <span ">Actual time of Departure:</span>
                <span>
                    @php
                        $barcode = $slip->barcodes->where('slip_id', $slip->id)->first();
                    @endphp
                    {{ $barcode && $barcode->actual_time_departure
                        ? \Carbon\Carbon::parse($barcode->actual_time_departure)->format('h:i A')
                        : 'NOT AVAILABLE' }}
                    <span>____________________</span>

                </span>
            </div>



            <div class="row">
                <span>Actual time of Arrival:</span>
                <span>
                    @php
                        $barcode = $slip->barcodes->where('slip_id', $slip->id)->first();
                    @endphp
                    {{ $barcode && $barcode->actual_time_arrival
                        ? \Carbon\Carbon::parse($barcode->actual_time_arrival)->format('h:i A')
                        : 'NOT AVAILABLE' }}
                    <span>_______________________</span>
                    <span style="display: block; text-align: left; margin-left: 220px;">Guard</span>
                </span>
            </div>

            <div class="separator"></div>

            <div class="header">
                TRANSPORTATION REQUEST
            </div>
            <div class="separator"></div>
            <br>

            <div class="row">
                <span>Requesting Division/Office:
                </span>
            </div>

            <div class="separatortranspo"></div>
            <div class="row">
                <span>Remarks:
                </span>
            </div>
            <div class="separatortranspo"></div>

            <div class="row">
                <span>Reccomended Driver: <strong> ARTEMIO S. PASTOR</strong>
                </span>

            </div>
            <div class="separatortranspo"></div>

            <div class="row">
                <span>Reccomending Approval: <strong>MARIA GLETA B. ABENDAN</strong>
                </span>
            </div>
            <div class="separatortranspo"></div>
            <span style="display: block; text-align: left; margin-left: 160px;">AO/Authorized Representative</span>
            <br>
            <br>
            <div class="row">
                <span>Approved: <strong>EUTIQUIO A. PERNIS</strong>
                </span>
            </div>
            <div class="separatortranspo"></div>
            <span style="display: block; text-align: left; margin-left: 125px;">D-IV/D-III/Authorized
                Representative</span>

        </div>
--}}

        <!-- Duplicate Slip -->
        <div class="container">
            <!-- Original content -->
            <div class="header">
                <h2>CERTIFICATE OF APPREARANCE</h2>
            </div>
            <div class="row">
                <span>Control Number:</span>
                <span>{{ $slip->control_number }}</span>
            </div>

            <div class="row">
                <img src="{{ asset('storage/barcodes/' . $slip->barcode) }}"
                    alt="Barcode for {{ $slip->control_number }}">
            </div>


            <h2>TO WHOM IT MAY CONCERN</h2>

            <div class="row">
                <span>
                    This is to certify that I attended to <strong>{{ strtoupper($slip->user->name) }}</strong>
                </span>
            </div>
            <div class="separatornew"></div>

            <div class="row">
                <span>
                    OF
                    PALOMPON INSTITUTE OF TECHNOLOGY TABANGO,
                </span>
            </div>
            <div class="separatornew"></div>

            <div class="row">
                <span>
                    TABANGO, LEYTE
                </span>
            </div>
            <div class="separatornew"></div>
            <div class="row">
                <span>
                    WHEN HE/SHE TRANSACTED BUSINESS WITH MY AGREEMENT COMPANY.
                </span>

            </div>
            <div class="separatornew"></div>

            <div class="row">
                <span>
                    ON
                </span>
            </div>
            <div class="separatornew"></div>




            AT<div class="separatornospace"></div>
            <span style="display: block; text-align: center;">AM/PM</span>


            <div class="separator"></div>

            <br>
            <div class="row"> <br>
                <div class="separatornospace"></div>
                <span style="display: block; text-align: center; ">SIGNATURE OVER PRINTED NAME</span>

            </div>

            <br>

            <div class="separator"></div>

            <div class="separatornew"></div>
            <div class="row">
                <span>Date:
                </span>
            </div>

            <div class="separatornew"></div>

            <div class="row"> <br>
                <span>Name of Agency/ies:
                </span>
            </div>
            <div class="separatornew"></div>
            <br>
            <div class="separatornew"></div>
            <br>
            <div class="separatornew"></div>
            <br>
            <div class="separatornew"></div>
            <br>

            <div class="row">
                <span>Tel. No.:

                </span>
            </div>
            <div class="separatornospace"></div>

            <br><br>

            <span>In case an employee buys office supplies, <strong>{{ strtoupper($slip->user->name) }}</strong> shall
                attached an authenticated copy of OR of Purchases.</span>
        </div>

    </div>

    </div>

</body>

</html>
