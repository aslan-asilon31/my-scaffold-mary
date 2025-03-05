

                                <!-- resources/views/products/cart.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
</head>
<body>
    <h1>Keranjang Belanja</h1>

    @if(session()->has('cart') && count(session('cart')) > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    <tr>
                        <td>{{ $item['id'] }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['price'] }}</td>
                        <td>{{ $item['amount'] }}
                            <br>

                            
                            <form action="{{ route('increment', $item['id']) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">+</button>
                                </form>
                                <form action="{{ route('decrement', $item['id']) }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">-</button>
                                </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Keranjang belanja Anda kosong.</p>
    @endif
</body>
</html>

