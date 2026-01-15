<h1>Blade Engine Template <?= $title ?></h1>

<table border="1">
    <tr>
        <th>STT</th>
        <th>Name</th>
        <th>Age</th>
        <th>Address</th>
    </tr>
    @php $class = 'style="background-color:gray"' @endphp 
    
    @forelse($students as $student)
        <tr {!! $loop->even ? $class : '' !!}>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $student['name'] }}</td>
            <td>{{ $student['age'] }}</td>
            <td>{{ $student['address'] }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="4">No data</td>
        </tr>
    @endforelse
</table>