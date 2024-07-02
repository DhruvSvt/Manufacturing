<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Invoice</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            width: 50%;    font-family: math;
            margin: auto;
        }

        .head-container {
            text-align: center;
        }

        .finish-good {
            color: white;
            background-color: black;
            display: inline-block;
            padding-inline: 10px;
            border-radius: 100px;
            print-color-adjust: exact;
            margin-top: 5px;
        }

        .challan-date {
               display: flex;
    justify-content: space-between;
    margin-top: 3px;
    font-size: 18px;
    font-weight: 600;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            margin-top: 1.8rem;
            font-size: 15px;
            font-weight: bold;
        }

        .store-incharge {
            text-align: start;
            margin-left: 15%;
            margin-top: 1.3rem;
        }

        table {
            width: 100%;
            margin-top: 0.5rem;
        }

        td {
            border-left: 1px solid black;
            border-bottom: 1px solid black;
            padding: 5px;
        }

        table,
        th {
            border: 1px solid black;
            border-collapse: collapse;
        }

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
            -webkit-transition: background-color .17s ease, color .17s ease;
            -o-transition: background-color .17s ease, color .17s ease;
            transition: background-color .17s ease, color .17s ease;
        }

        @media print {
            body {
                width: 100%;
                margin: auto;
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            .btn {
                display: none;
            }
        }

        @page {
            size: auto;
            margin: 30px;
        }
    </style>
</head>


<body onload="window.print()">

    @php
    $fsale = $sale->first();
    @endphp

    <div class="head-container">
        {{-- <div style="float: right;margin-right: 1rem;">
            <button class="btn" onclick="window.print()">Print</button>
        </div> --}}
        <h1>Manufacturing PVT. LTd.</h1>
        <p>Noida , India</p>
        <h3 class="finish-good">Sale Invoice</h3>
    </div>
 <div class="challan-date">
         <span>Bill No. - {{ $fsale->id }}</span>
          <span>Party Name - {{ $fsale->supplier }}</span>

    </div>
    <div class="challan-date">

<span>Bill Date. - {{ date('d-m-Y', strtotime($fsale->created_at)) }}</span>

        <span>Place. - {{ $fsale->place }}</span>
    </div>

    <div class="challan-date">

        <span>Due Date. - {{ date('d-m-Y', strtotime($fsale->due_date)) }}</span>
    </div>

    <table>
        <tr>
            <th style="width: 5%;">No.</th>
            <th style="width: 35%;">Particulars</th>
            <th style="width: 20%;">Quantity</th>
            <th style="width: 20%;">Rate</th>
            <th style="width: 20%;">Total</th>
        </tr>
        @foreach ($sale as $key => $saleProduct )
        <tr>
            <td style="width: 5%;">{{ $key+1 }}</td>
            <td style="width: 35%;">{{ $saleProduct->productname }} ({{
                $saleProduct->short_name ?? '-' }})</td>
            <td style="width: 20%;">{{ $saleProduct->qtys }}</td>
            <td style="width: 20%;">{{ $saleProduct->rates }}</td>
            <td style="width: 20%;">₹{{ $saleProduct->total }}</td>
        </tr>
        @endforeach
        <tr style="text-align: center">
            <td colspan="4"><b>Grand Total</b></td>
            <td colspan="1"><b>₹{{ $saleProduct->total_amt }}/-</b></td>
        </tr>
    </table>
    <div style="margin-top: 10px;">
        <b>Thanking You,</b>
    </div>
    <div>
        <b style="margin-top:5px;">Sign.</b>
    </div>
    <div class="footer">
        <span>Received the details of return.</span>
        <span>Store Incharge</span>
    </div>
</body>
</html>
