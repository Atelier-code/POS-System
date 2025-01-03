<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            padding: 20px;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f4f4f4;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .invoice-header div {
            width: 48%;
        }

        .invoice-header h2 {
            color: #e63946;
            margin-bottom: 10px;
        }

        .invoice-header p {
            margin: 5px 0;
        }

        .products {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .products th {
            background-color: #e63946;
            color: white;
            padding: 10px;
            text-align: left;
        }

        .products td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .totals {
            text-align: right;
            margin-top: 10px;
        }

        .totals p {
            margin: 5px 0;
        }

        .totals span {
            font-weight: bold;
            color: #e63946;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #555;
        }

        .footer span {
            color: #e63946;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="invoice-header">
    <div>
        <h2>Mighty Jesus POS</h2>
        <p><strong>Email:</strong> {{env("company_email")}}</p>
        <p><strong>Phone:</strong> {{env("company_phone")}}</p>
        <p><strong>Address:</strong> {{env("company_address")}}</p>
    </div>

    <div>
        <h2>Reciept Details</h2>
        <p><strong>Order ID:</strong>{{$sale_id}}</p>
        <p><strong>Purchase Date:</strong> {{ \Carbon\Carbon::now()->format('M d, Y') }}</p>
        <p><strong>Payment Type:</strong> {{$payment_option}}</p>
    </div>
</div>

<table class="products">
    <thead>
    <tr>
        <th>S/N</th>
        <th>Product Name</th>
        <th>Quantity</th>
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
    <p><strong>Total:</strong> <span>Ghc{{number_format($total,2)}}</span></p>
</div>

<div class="footer">
    <p>Thanks For Buying From Us. <span>!!</span></p>
</div>
</body>
</html>
