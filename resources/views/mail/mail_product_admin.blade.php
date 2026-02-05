<table border="1">
    <tr>
        <th>STT</th>
        <th>Name</th>
        <th>Product Category Name</th>
        <th>Price</th>
        <th>Created At</th>
    </tr>
    @foreach ($products as $product)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->productCategory->name }}</td>
            <td>{{ number_format($product->price) }}</td>
            <td>{{ $product->created_at->format('d/m/Y H:i:s') }}</td>
        </tr>
    @endforeach
</table>