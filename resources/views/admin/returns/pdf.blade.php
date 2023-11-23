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
            -webkit-box-sizing: border-box;
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
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            margin-top: 5px;
        }

        .challan-date {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            margin-top: 1.5rem;
            font-size: 20px;
        }

        .footer {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
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

        table {
            width: 100%;
            margin-top: 0.5rem;
        }

        td {
            vertical-align: top;
            width: 50%;
            padding: 6px;
            padding-left: 15px;
        }

        th {
            padding: 8px;
            font-size: 1.3rem;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
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
        <h3 class="finish-good">GOOD RETURN DETAILS</h3>
    </div>

    <div class="challan-date">
        <span>Date :- </span>
    </div>


    <table>
        <tr>
            <th colspan="2">Details of Return Good</th>
        </tr>
        <tr>
            <td>Party Name</td>
            <td>{{ $return->supplier->name }}</td>
        </tr>
        <tr>
            <td>Builty No.</td>
            <td>{{ $return->builty }}</td>
        </tr>
        <tr>
            <td>Transport Name</td>
            <td>{{ $return->transport }}</td>
        </tr>
        <tr>
            <td>Date of Dispatch</td>
            <td>{{ $return->dispatch }}</td>
        </tr>
        <tr>
            <td>Date of Reciept</td>
            <td>{{ $return->date_of_receipt }}</td>
        </tr>
        <tr>
            <td>Name of Product</td>
            <td>{{ $return->product->name }} ({{ $return->product->unit->short_name }})</td>
        </tr>
        <tr>
            <td>Qty</td>
            <td>{{ $return->quantity }}</td>
        </tr>
        <tr>
            <td>Rate</td>
            <td>₹{{ $return->rate }}/-</td>
        </tr>
        <tr>
            <td>Receipt Challan</td>
            <td>{{ $return->receipt }}</td>
        </tr>
        <tr>
            <td>Batch No</td>
            <td>{{ $return->batch }}</td>
        </tr>
        <tr>
            <td>Type</td>
            <td>{{ $return->type }}</td>
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
