<div class="w-full bg-white p-6 rounded-lg ">
    <h3 class="font-semibold text-xl text-gray-600">Monthly Stars</h3>

    <table class="w-full mt-4 text-left border-collapse">
        <thead>
        <tr class="bg-gray-100 text-gray-700 text-xs uppercase tracking-wider">
            <th class="p-3 text-left">Position</th>
            <th class="p-3 text-left">Name</th>
            <th class="p-3 text-left">Role</th>
            <th class="p-3 text-left">Total Sales</th>
            <th class="p-3 text-left">Revenue Generated</th>
        </tr>
        </thead>
        <tbody class="text-gray-700 text-sm divide-y divide-gray-200 w-full">
        @foreach($employees as $index => $employee)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="p-4 font-semibold">{{ $index + 1 }}</td>
                <td class="p-4 flex items-center space-x-2">
{{--                    <img src="{{$employee->image}}" alt="{{ $employee->name }}" class="w-6 h-6 rounded-full">--}}
                    <span><a href="{{route('admin.show.user', $employee->id)}}">{{ $employee->name }}</a></span>
                </td>
                <td class="p-4">{{ $employee->role }}</td>
                <td class="p-4">{{ $employee->total_sales }}</td>
                <td class="p-4 text-green-600 font-medium">GH₵{{ number_format($employee->total_revenue, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
