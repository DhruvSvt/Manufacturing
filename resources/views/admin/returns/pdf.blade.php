<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finished Goods Challan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            width: 50%;
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
            margin-top: 1.5rem;
            font-size: 20px;
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

<body>
    <div class="head-container">
        <div style="float: right;margin-right: 1rem;">
            <button class="btn" onclick="window.print()">Print</button>
        </div>
        <h1>Panacia Health Care PVT. LTd.</h1>
        <p>Shiv Ganga Industrial Estate, Plot No. 19, Bhagwanpur, Roorkee (Uttrakhand)</p>
        <p>www.panaciahealthcare.com</p>
        <h3 class="finish-good">GOOD RETURN DETAILS <br> CREDIT NOTE</h3>
    </div>

    <div class="challan-date">
        <span>Credit No. - {{ $return->id }}</span>
    </div>
    <div class="challan-date">
        <span>Party Name - {{ $return->supplier->name }}</span>
        <span>Builty No. - {{ $return->builty }}</span>
    </div>

    <div class="challan-date">
        <span>Transport Name - {{ $return->transport }}</span>
        <span>Date of Dispatch - {{ $return->dispatch }}</span>
    </div>

    <div class="challan-date">
        <span>Date of Reciept - {{ $return->date_of_receipt }}</span>
        <span>Receipt Challan - {{ $return->receipt }}</span>
    </div>

    <table>
        <tr>
            <th style="width: 5%;">No.</th>
            <th style="width: 35%;">Particulars</th>
            <th style="width: 10%;">Batch No.</th>
            <th style="width: 15%;">Reason of Return</th>
            <th style="width: 10%;">Quantity</th>
            <th style="width: 10%;">Rate</th>
            <th style="width: 15%;">Total</th>
        </tr>
        @foreach ($returnProducts as $key => $returnProduct )
        <tr>
            <td style="width: 5%;">{{ $key+1 }}</td>
            <td style="width: 35%;">{{ $returnProduct->product->name }} ({{
                $returnProduct->product->unit->short_name ?? '-' }})</td>
            <td style="width: 10%;">{{ $returnProduct->batch_no }}</td>
            <td style="width: 15%;">{{ $returnProduct->reason_of_return }}</td>
            <td style="width: 10%;">{{ $returnProduct->qty }}</td>
            <td style="width: 10%;">{{ $returnProduct->rate }}</td>
            <td style="width: 15%;">₹{{ $returnProduct->qty*$returnProduct->rate }}</td>
        </tr>
        @endforeach
        <tr style="text-align: center">
            <td colspan="6"><b>Grand Total</b></td>
            <td colspan="1"><b>₹{{ $grandTotal }}/-</b></td>
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
