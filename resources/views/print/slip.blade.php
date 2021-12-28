<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Print Fuel Slips</title>
    <style>
        body {
            font-family: Inter, sans-serif;
        }

        .qr-slip {
            border: 1px dashed black;
            text-align :center;

        }

        .table-collapse {
            border-collapse: collapse;
        }

        .page {
            page-break-after: always;
            page-break-inside: avoid;
        }

    </style>
</head>

<body>
    @foreach($slips as $slip)
        <div style="text-align :center;">
            <img width="200"
                src="{{ $qr->render($encryptor->hash("{$slip->issued_date}|{$slip->gasoline_station}|{$slip->no_of_liters}|{$slip->name}|{$slip->vehicle_plate_no}")) }}"
                class="qr-slip">
        </div>
        <br>
        <span>
            ID : <strong>{{ $slip->id }}</strong>
        </span>
        <br>
          <span>
              Date Issued : <strong>{{ date('F d, Y', strtotime($slip->issued_date)) }}</strong>
          </span>
          <br>
        <span>
            Gasoline Station : <strong>{{ $slip->gasoline_station }}</strong>
        </span>
        <br>
        <span>
            Name of driver : <strong>{{ $slip->name }}</strong>
        </span>
        <br>
        <span>
            No. of Liters : <strong>{{ $slip->no_of_liters }}</strong>
        </span>
        <br>
        <span>
            Vehicle Plate No. : <strong>{{ $slip->vehicle_plate_no }}</strong>
        </span>
        <br>
        <hr color="black">
    @endforeach
</body>

</html>
