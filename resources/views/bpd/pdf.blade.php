<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background-color: #f3f3f3; }
    </style>
</head>
<body>

<h3 style="text-align:center;">MASTER BPD</h3>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>No BPD</th>
            <th>Objective</th>
        </tr>
    </thead>
    <tbody>
        @foreach($masterBpds as $i => $bpd)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $bpd->no_bpd }}</td>
            <td>{{ $bpd->objective }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
