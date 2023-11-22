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

        table {
            width: 100%;
            margin-top: 0.5rem;
        }

        td {
            height: 320px;
            vertical-align: top;
            padding: 15px;
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
            .btn{
                display: none;
            }
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
        <h3 class="finish-good">FINISHED GOODS CHALLAN</h3>
    </div>

    <div class="challan-date">
        <span>Challan No.</span>
        <span>Date..........</span>
    </div>

    <div>
        <div class="store-incharge">
            To,<br>
            The Store Incharge <br>
            kindly receive the undermentioned finished goods in order.
        </div>
    </div>

    <table>
        <tr>
            <th style="width: 10%;">No.</th>
            <th style="width: 60%;">Particulars</th>
            <th style="width: 15%;">Batch No.</th>
            <th style="width: 15%;">Quantity</th>
        </tr>
        <tr>
            <td style="width: 10%;">1</td>
            <td style="width: 60%;">{{ $production->product->name }} ({{
                $production->product->unit->short_name }} )</td>
            <td style="width: 15%;">{{ $production->batch_no }}</td>
            <td style="width: 15%;">{{ $production->qty }}</td>
        </tr>
    </table>

    <div style="margin-top: 10px;">
        <b>Thanking You,</b>
    </div>
    <div>
        <b style="margin-top:5px;">Sign. Production Deptt.</b>
    </div>

    <div class="footer">
        <span>Received the above mentioned goods.</span>
        <span>Store Incharge</span>
    </div>
</body>

</html>
