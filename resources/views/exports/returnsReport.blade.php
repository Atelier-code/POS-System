<table>
    <thead>
    <tr>
        <th>Product</th>
        <th>Total Quantity Returned</th>
        <th>Total Value</th>
        <th>Defective</th>
        <th>Wrong Size</th>
        <th>Changed Mind</th>
        <th>Other</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($data as $row)
        <tr>
            <td>{{ $row['name'] }}</td>
            <td>{{ $row['total_quantity'] }}</td>
            <td>{{ number_format($row['total_value'], 2) }}</td>
            <td>{{ $row['reasons']['defective'] }}</td>
            <td>{{ $row['reasons']['wrong_size'] }}</td>
            <td>{{ $row['reasons']['changed_mind'] }}</td>
            <td>{{ $row['reasons']['other'] }}</td>
        </tr>
    @endforeach
    <tr>
        <td><strong>Totals</strong></td>
        <td><strong>{{ $totalQuantity }}</strong></td>
        <td><strong>{{ number_format($totalReturnedValue, 2) }}</strong></td>
        <td colspan="4"></td>
    </tr>
    </tbody>
</table>
