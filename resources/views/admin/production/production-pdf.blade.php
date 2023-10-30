<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Production-PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    {{--
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" /> --}}

    <style>
        .btn {
            display: inline-block;
            outline: none;
            cursor: pointer;
            border-radius: 3px;
            font-size: 14px;
            font-weight: 500;
            line-height: 16px;
            padding: 2px 16px;
            height: 32px;
            min-width: 60px;
            min-height: 32px;
            border: none;
            color: #fff;
            background-color: #4f545c;
            transition: background-color .17s ease, color .17s ease;
        }

        @media print {
            .btn {
                display: none;
            }
        }
    </style>
</head>



{{--

<body class="fw-bold">
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
            <table class="table-bordered border-dark mt-3 ">
                <thead>
                    <tr class="text-center">
                        <th scope="col">SR.NO.</th>
                        <th scope="col">NAME OF MATERIAL</th>
                        <th scope="col">REQ.QUANTITY</th>
                        <th scope="col">UNIT</th>
                        <th scope="col">ACCTUAL QUANTITY</th>
                    </tr>
                </thead>
                <tbody>
                    @if($issue->product_raw_material && count($issue->product_raw_material) > 0)
                    @foreach ($issue->product_raw_material as $key => $item)
                    <tr>
                        <th scope="row" class="text-center"> {{ $key+1 }}</th>
                        <td>{{ $item->raw_material->name ?? '-' }}</td>
                        <td class="text-center">{{ $item->qty ?? '' }}</td>
                        <td class="text-center">{{ $item->raw_material->parent->short_name ?? '-' }}</td>
                        <td class="text-center">{{ $newarr[$item->raw_material->name] }}</td>
                    </tr>
                    @endforeach
                    @endif
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
</body> --}}



<body style="font-weight: bold; margin-left:5rem">
    <div style="float: right;margin-right: 1rem;">
        <button class="btn" onclick="window.print()">Print</button>
    </div>
    <div style="margin-top: 3%;">
        <div style="display: flex; justify-content: space-between;">
            <div style="flex: 1;">
                RAW MATERIAL ISSUE SLIP
            </div>
            <div style="flex: 1;">
                S.NO. - {{ $production->id }}
            </div>
        </div>
        <div style="display: flex; justify-content: space-between;">
            <div style="flex: 1;">
                REQ.NO.
            </div>
            <div style="flex: 1;">
                REV.NO.
            </div>
        </div>
        <div>
            PRODUCT NAME-- {{ $production->product->name }}
        </div>
        <div style="display: flex; justify-content: space-between;">
            <div style="flex: 1;">
                DATE-- {{ $production->created_at->format('d-m-Y') }}
            </div>
            <div style="flex: 1;">
                BATCH NO.-- {{ $production->batch_no }}
            </div>
            <div style="flex: 1;">
                MFG DATE-
            </div>
        </div>
        <div style="display: flex; justify-content: space-between;">
            <div style="flex: 1;"></div>
            <div style="flex: 1;">
                BATCH SIZE--
            </div>
            <div style="flex: 1;">
                EXP.DATE--
            </div>
        </div>
    </div>
    <div style="margin-top: 2%;">
        <div style="width: 75%;">
            <table style="border: 1px solid #000; margin-top: 3%;">
                <thead>
                    <tr style="text-align: center;">
                        <th style="border: 1px solid #000; padding-inline: 1rem;">SR.NO.</th>
                        <th style="border: 1px solid #000; padding-inline: 1rem;">NAME OF MATERIAL</th>
                        <th style="border: 1px solid #000; padding-inline: 1rem;">REQ. QUANTITY</th>
                        <th style="border: 1px solid #000; padding-inline: 1rem;">UNIT</th>
                        <th style="border: 1px solid #000; padding-inline: 1rem;">ACTUAL QUANTITY</th>
                    </tr>
                </thead>
                <tbody>
                    @if($issue->product_raw_material && count($issue->product_raw_material) > 0)
                    @foreach ($issue->product_raw_material as $key => $item)
                    <tr style="text-align: center;">
                        <td style="border: 1px solid #000;">{{ $key+1 }}</td>
                        <td style="border: 1px solid #000;">{{ $item->raw_material->name ?? '-' }}</td>
                        <td style="border: 1px solid #000;">{{ $item->qty ?? '' }}</td>
                        <td style="border: 1px solid #000;">{{ $item->raw_material->parent->short_name ?? '-' }}</td>
                        <td style="border: 1px solid #000;">{{ $newarr[$item->raw_material->name] }}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div style="margin-top: 3%;">
        <div style="display: flex; justify-content: space-between;">
            <div style="flex: 1;">
                SIGNATURE STORE INCHARGE
            </div>
            <div style="flex: 1;">
                SIGNATURE CHEMIST INCHARGE
            </div>
        </div>
    </div>
</body>



</html>
