<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #333;
            margin: 20px;
        }

        /* ===== HEADER ===== */
        .title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .subtitle {
            text-align: center;
            font-size: 11px;
            margin-bottom: 20px;
            color: #666;
        }

        /* ===== TABLE ===== */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background-color: #e5e7eb; /* abu soft */
            color: #111;
            font-weight: bold;
            text-align: left;
            padding: 8px;
            border: 1px solid #999;
        }

        tbody td {
            padding: 7px;
            border: 1px solid #bbb;
            vertical-align: top;
        }

        tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        /* ===== COLUMN WIDTH ===== */
        .col-no {
            width: 5%;
            text-align: center;
        }

        .col-bpd {
            width: 20%;
        }

        .col-objective {
            width: 75%;
        }

        /* ===== FOOTER ===== */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: right;
            font-size: 9px;
            color: #666;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="title">MASTER BPD</div>
    <div class="subtitle">
        Preview & Download Data BPD<br>
        Generated on {{ date('d M Y') }}
    </div>

    <!-- TABLE -->
    <table>
        <thead>
            <tr>
                <th class="col-no">No</th>
                <th class="col-bpd">No BPD</th>
                <th class="col-objective">Objective</th>
            </tr>
        </thead>
        <tbody>
            @foreach($masterBpds as $i => $bpd)
                <tr>
                    <td class="col-no">{{ $i + 1 }}</td>
                    <td class="col-bpd">{{ $bpd->no_bpd }}</td>
                    <td class="col-objective">{{ $bpd->objective }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        MASTER BPD | Page {PAGE_NUM} of {PAGE_COUNT}
    </div>

</body>
</html>
