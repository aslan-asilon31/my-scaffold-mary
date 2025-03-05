<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Daftar Produk {{ count($products) }}</h2>
        <a href="{{ route('product-cart.create') }}" class="btn btn-success">Tambah Produk</a>
        <br><br>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product['id'] }}</td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['price'] }}</td>
                    <td>{{ $product['amount'] }}</td>
                    <td>
                        <a href="{{ route('product-cart.edit', $product['id']) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('product-cart.destroy', $product['id']) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
