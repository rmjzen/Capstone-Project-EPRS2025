<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Pass Slip</title>
    <style>
        /* Add print-friendly CSS here */
        body {
            font-family: Arial, sans-serif;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>

    <h1>Pass Slip Details</h1>

    <table class="table">
        <tr>
            <th>Name</th>
            <td>{{ $slip->user->name }}</td>
        </tr>
        <tr>
            <th>Control Number</th>
            <td>{{ $slip->control_number }}</td>
        </tr>
        <tr>
            <th>Purpose</th>
            <td>{{ $slip->purpose }}</td>
        </tr>
        <tr>
            <th>Reason</th>
            <td>{{ $slip->reason }}</td>
        </tr>
        <tr>
            <th>Date Created</th>
            <td>{{ $slip->created_at->format('F j, Y, h:i A') }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($slip->status) }}</td>
        </tr>
        @if ($slip->status === 'approved' && $slip->barcode)
            <tr>
                <th>Barcode</th>
                <td><img src="{{ asset('storage/barcodes/' . $slip->barcode) }}" alt="Barcode" style="width:100px;"></td>
            </tr>
        @else
            <tr>
                <th>Barcode</th>
                <td>UNAVAILABLE</td>
            </tr>
        @endif
        <tr>
            <th>Approved by</th>
            <td>{{ \App\Models\User::where('id', $slip->approved_by)->value('name') }}</td>
        </tr>

        @if ($item->status == 'approved')
            <a href="{{ route('pass-slip.print', $item->id) }}" class="btn btn-secondary" target="_blank">Print</a>
        @endif
    </table>

    <script>
        // Automatically trigger print dialog
        window.onload = function() {
            window.print();
        }
    </script>

</body>

</html>
