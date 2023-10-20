<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Production-PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    {{-- <style>
        /* heading */

        h1 {
            font: bold 100% sans-serif;
            letter-spacing: 0.5em;
            text-align: center;
            text-transform: uppercase;
        }

        /* table */

        table {
            font-size: 75%;
            table-layout: fixed;
            width: 100%;
        }

        table {
            border-collapse: separate;
            border-spacing: 2px;
        }

        th,
        td {
            border-width: 1px;
            padding: 0.5em;
            position: relative;
            text-align: left;
        }

        th,
        td {
            border-radius: 0.25em;
            border-style: solid;
        }

        th {
            background: #EEE;
            border-color: #BBB;
        }

        td {
            border-color: #DDD;
        }

        body {
            box-sizing: border-box;
            height: 11in;
            margin: 0 auto;
            overflow: hidden;
            padding: 0.5in;
            width: 7.5in;
        }

        body {
            background: #FFF;
            border-radius: 1px;
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
        }

        /* header */

        header {
            margin: 0 0 3em;
        }

        header:after {
            clear: both;
            content: "";
            display: table;
        }

        header h1 {
            background: #e40101;
            border-radius: 0.25em;
            color: #FFF;
            margin: 0 0 1em;
            padding: 0.5em 0;
        }

        header address {
            float: left;
            font-size: 95%;
            font-style: normal;
            line-height: 1.25;
            margin: 0 1em 1em 0;
        }

        article address.norm h4 {
            font-size: 125%;
            font-weight: bold;
        }

        article address.norm {
            float: left;
            font-size: 95%;
            font-style: normal;
            font-weight: normal;
            line-height: 1.25;
            margin: 0 1em 1em 0;
        }

        header address p {
            margin: 0 0 0.25em;
        }

        header span,
        header img {
            display: block;
            float: right;
        }

        header span {
            margin: 0 0 1em 1em;
            max-height: 25%;
            max-width: 60%;
            position: relative;
        }

        header img {
            max-height: 100%;
            max-width: 100%;
        }

        header input {
            cursor: pointer;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            height: 100%;
            left: 0;
            opacity: 0;
            position: absolute;
            top: 0;
            width: 100%;
        }

        /* article */

        article,
        article address,
        table.meta,
        table.inventory {
            margin: 0 0 3em;
        }

        article:after {
            clear: both;
            content: "";
            display: table;
        }

        article h1 {
            clip: rect(0 0 0 0);
            position: absolute;
        }

        article address {
            float: left;
            font-size: 125%;
            font-weight: bold;
        }

        /* table meta & balance */

        table.meta,
        table.balance {
            float: right;
            width: 36%;
        }

        table.meta:after,
        table.balance:after {
            clear: both;
            content: "";
            display: table;
        }

        /* table meta */

        table.meta th {
            width: 40%;
        }

        table.meta td {
            width: 60%;
        }

        /* table items */

        table.inventory {
            clear: both;
            width: 100%;
        }

        table.inventory th:first-child {
            width: 50px;
        }

        table.inventory th:nth-child(2) {
            width: 300px;
        }

        table.inventory th {
            font-weight: bold;
            text-align: center;
        }

        table.inventory td:nth-child(1) {
            width: 26%;
        }

        table.inventory td:nth-child(2) {
            width: 38%;
        }

        table.inventory td:nth-child(3) {
            text-align: right;
            width: 12%;
        }

        table.inventory td:nth-child(4) {
            text-align: right;
            width: 12%;
        }

        table.inventory td:nth-child(5) {
            text-align: right;
            width: 12%;
        }

        /* table balance */

        table.balance th,
        table.balance td {
            width: 50%;
        }

        table.balance td {
            text-align: right;
        }

        /* aside */

        aside h1 {
            border: none;
            border-width: 0 0 1px;
            margin: 0 0 1em;
        }

        aside h1 {
            border-color: #999;
            border-bottom-style: solid;
        }

        table.sign {
            float: left;
            width: 220px;
        }

        table.sign img {
            width: 100%;
        }

        table.sign tr td {
            border-color: transparent;
        }

        @media print {
            * {
                -webkit-print-color-adjust: exact;
            }

            html {
                background: none;
                padding: 0;
            }

            body {
                box-shadow: none;
                margin: 0;
            }

            span:empty {
                display: none;
            }

            .add,
            .cut {
                display: none;
            }
        }

        @page {
            margin: 0;
        }
    </style> --}}

    <style>

    </style>
</head>

<body class="fw-bold">
    {{-- <div class="container mt-5">
        <div class="row h-25 w-35 d-inline-block">
            <p class="m-0 d-inline-block col">
                RAW MATERIAL ISSUE SLIP &nbsp;&nbsp;&nbsp; S.NO.
            </p>
            <p class="m-0 d-inline-block col">
                REQ.NO.
            </p>
            <p class="m-0 d-inline-block">
                PLEASE ISSUE THE FOLLOWING MATERIALS AS PER DETAILS
            </p>
            <p class="mt-3 d-inline-block">
                PRODUCT NAME --
            </p>
            <p class="mt-0 d-inline-block">
                DATE------05/10/2023
            </p>
        </div> --}}
        <div class="container mt-5">
            <div class="row">
                <div class="col">
                    RAW MATERIAL ISSUE SLIP
                </div>
                <div class="col">
                    S.NO. - {{ $production->id }}
                </div>
            </div>
            <div class="row">
                <div class="col">
                    REQ.NO.
                </div>
                <div class="col">
                    REV.NO.
                </div>
            </div>
            <div class="row">
                <div class="col">
                    PRODUCT NAME-- {{ $production->product->name }}
                </div>
            </div>
            <div class="row">
                <div class="col">
                    DATE-- {{ $production->created_at->format('d-m-Y') }}
                </div>
                <div class="col">
                    BATCH NO.-- {{ $production->batch_no }}
                </div>
                <div class="col">
                    MFG DATE-
                </div>
            </div>
            <div class="row">
                <div class="col">

                </div>
                <div class="col">
                    BATCH SIZE--
                </div>
                <div class="col">
                    EXP.DATE--
                </div>
            </div>
        </div>
        <div class="container mt-3">
            <div class="row w-75">
                <table class="table border border-dark mt-3 ">
                    <thead>
                        <tr>
                            <th scope="col">SR.NO.</th>
                            <th scope="col">NAME OF MATERIAL</th>
                            <th scope="col">REQ.QUANTITY</th>
                            <th scope="col">UNIT</th>
                            <th scope="col">ACCUAL QUANTITY</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($issue->product_raw_material && count($issue->product_raw_material) > 0)
                        @foreach ($issue->product_raw_material as $key => $item)
                        <tr>
                            <th scope="row"> {{ $key+1 }}</th>
                            <td>{{ $item->raw_material->name ?? '-' }}</td>
                            <td>{{ $item->qty ?? '' }}</td>
                            <td>{{ $item->raw_material->parent->short_name ?? '-' }}</td>
                            <td></td>
                        </tr>
                        @endforeach
                        @endif
                        {{-- <tr>
                            <th scope="row">2</th>
                            <td>MAGNESIUM SULPHATE</td>
                            <td>800</td>
                            <td>GRAM.</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>L-LYSINE MONOLYDRATE</td>
                            <td>100</td>
                            <td>GRAM.</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>MAGNESIUM SULPHATE</td>
                            <td>800</td>
                            <td>GRAM.</td>
                            <td></td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>

            <div class="container mt-3">
                <div class="row">
                    <div class="col">
                        SIGNATURE STORE INCHARGE
                    </div>
                    <div class="col">
                        SIGNATURE CHEMIST INCHARGE
                    </div>
                </div>
            </div>

    </div>
</body>

</html>
