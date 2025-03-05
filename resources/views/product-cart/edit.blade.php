<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Edit Produk</h2>
        <form action="{{ route('product-cart.update', $product['id']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" class="form-control" name="name" value="{{ $product['name'] }}" required>
            </div>
            <div class="form-group">
                <label>Harga:</label>
                <input type="number" class="form-control" name="price" value="{{ $product['price'] }}" required>
            </div>
            <div class="form-group">
                <label>Jumlah:</label>
                <input type="number" class="form-control" name="amount" value="{{ $product['amount'] }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('product-cart.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
