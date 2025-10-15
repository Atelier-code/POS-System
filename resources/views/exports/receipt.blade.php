<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Mighty Jesus POS</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            color: #222;
            padding: 20px;
        }

        /* Header */
        .invoice-header {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #fafafa;
        }

        .invoice-header table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-header td {
            width: 50%;
            vertical-align: top;
        }

        .invoice-header h2 {
            color: #2b7a78;
            margin-bottom: 10px;
            font-size: 1.5rem;
        }

        .invoice-header p {
            margin: 6px 0;
            color: #444;
            font-size: 0.95rem;
        }

        /* Product Table */
        .products {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 0.95rem;
        }

        .products th {
            background-color: #2b7a78;
            color: white;
            padding: 10px;
            text-align: left;
        }

        .products td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .products tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        /* Totals */
        .totals {
            text-align: right;
            margin-top: 10px;
        }

        .totals p {
            margin: 5px 0;
            color: #333;
            font-size: 1rem;
        }

        .totals span {
            font-weight: bold;
            color: #2b7a78;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 25px;
            color: #555;
            font-size: 0.9rem;
        }

        .footer span {
            color: #2b7a78;
            font-weight: bold;
        }

        @media print {
            body {
                background: #fff;
                padding: 0;
            }

            .invoice-header {
                border: none;
                background: none;
            }

            .products th {
                background-color: #2b7a78 !important;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

<div class="invoice-header">
    <table>
        <tr>
            <td>
                <h2>Mighty Jesus POS</h2>
                <p><strong>Receipt No:</strong> {{$sale_id}}</p>
                <p><strong>Date:</strong> {{ \Carbon\Carbon::now()->format('M d, Y - h:i A') }}</p>
            </td>
            <td align="right">
                <p><strong>Customer:</strong> {{$customer_name ?? 'Walk-in Customer'}}</p>
                <p><strong>Payment Type:</strong> {{$payment_option}}</p>
            </td>
        </tr>
    </table>
</div>

<table class="products">
    <thead>
    <tr>
        <th>S/N</th>
        <th>Product Name</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Tax</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{$item['name']}}</td>
            <td>{{$item['quantity']}}</td>
            <td>Ghc{{number_format($item['selling_price'],2)}}</td>
            <td>{{$item['tax_rate']}}%</td>
            <td>Ghc{{number_format($item['total'],2)}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="totals">
    <p><strong>Subtotal:</strong> <span>Ghc{{number_format($sub_total,2)}}</span></p>
    <p><strong>Tax:</strong> <span>Ghc{{number_format($tax,2)}}</span></p>
    <p><strong>Total Amount:</strong> <span>Ghc{{number_format($total,2)}}</span></p>

</div>

<div class="footer">
    <p>Thank you for shopping with <span>Mighty Jesus POS</span>. God bless you!</p>
</div>

</body>
</html>
