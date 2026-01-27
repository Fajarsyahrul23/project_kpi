<!DOCTYPE html>
<html>

<head>
    <title>BPD List</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            w-full: 100%;
            border-collapse: collapse;
            margin-bottom: 1em;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
        }

        .meta {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h1>BPD List</h1>
    <div class="meta">
        <strong>Department:</strong> {{ session('department_name') }}<br>
        <strong>Date:</strong> {{ date('Y-m-d') }}
    </div>

    <table width="100%">
        <thead>
            <tr>
                <th width="20%">No BPD</th>
                <th width="80%">Objective</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bpds as $bpd)
                <tr>
                    <td>{{ $bpd->no_bpd }}</td>
                    <td>{{ $bpd->objective }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>