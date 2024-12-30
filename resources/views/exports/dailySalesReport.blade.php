<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daily Sales Report</title>
</head>
<body>
<table border="1" cellspacing="0" cellpadding="5" style="width: 100%; border-collapse: collapse;">
    <thead>
    <tr>
        <th colspan="7" style="text-align: center; font-size: 18px; font-weight: bold;">
             {{ $date }}
        </th>
    </tr>
    <tr>
        <th>ID</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Price (₵)</th>
        <th>Sub Total (₵)</th>
        <th>Tax Total (₵)</th>
        <th>Total (₵)</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($data as $item)
        <tr>
            <td>{{ $item['id'] }}</td>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>₵{{ number_format($item['price'], 2) }}</td>
            <td>₵{{ number_format($item['sub_total'], 2) }}</td>
            <td>₵{{ number_format($item['tax'], 2)}} ({{$item['tax_rate']}}% of sub total) </td>
            <td>₵{{ number_format($item['total'], 2) }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td  style="font-weight: bold; text-align: right;">Total Sale:</td>
        <td colspan="2" style="font-weight: bold; text-align: left;">₵{{ number_format($sub_total, 2) }}</td>
        <td> </td>

        <td  style="font-weight: bold; text-align: right;">Total Tax:</td>
        <td colspan="2" style="font-weight: bold; text-align: left;">₵{{ number_format($totalTax, 2) }}</td>
    </tr>
    <tr>

    </tr>

    <tr>
        <td  style="font-weight: bold; text-align: right;">Total Revenue:</td>
        <td colspan="2" style="font-weight: bold; text-align: left;">₵{{ number_format($totalSale, 2) }}</td>
    </tr>
    </tfoot>
</table>
</body>
</html>
