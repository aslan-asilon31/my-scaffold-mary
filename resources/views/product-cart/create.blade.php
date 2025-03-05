<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Produk </h2>
        <form action="{{ route('product-cart.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label>Harga:</label>
                <input type="number" class="form-control" name="price" required>
            </div>
            <div class="form-group">
                <label>Jumlah:</label>
                <input type="number" class="form-control" name="amount" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('product-cart.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
