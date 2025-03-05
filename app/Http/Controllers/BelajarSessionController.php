<?php  
  
namespace App\Http\Controllers;  
  
use App\Http\Controllers\Controller;  
use App\Models\Action; // Pastikan untuk mengimpor model Action  
use Illuminate\Http\Request;  
  
class BelajarSessionController extends Controller  
{  
    public function index()
    {

        // Simpan produk ke dalam session
        $products = session('products', []);

        return view('welcome', compact('products'));
    }

    // Menambahkan produk ke cart
    public function addToCart(Request $request, $id)
    {

                // Ambil produk dari session
                $products = session()->get('cart', []);

                // Temukan produk yang ingin ditambahkan
                $product = collect($products)->firstWhere('id', $id);
        
                if ($product) {
                    // Jika produk sudah ada di keranjang, tambahkan amount
                    $product['amount']++;
                } else {
                    // Jika produk belum ada, tambahkan ke keranjang dengan amount 1
                    $product = [
                        'id' => $id,
                        'name' => $request->input('name'),
                        'price' => $request->input('price'),
                        'amount' => 1,
                    ];
                    $products[] = $product;
                }
        
                // Simpan kembali ke session
                session()->put('cart', $products);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }


    // Menampilkan cart
    public function cart()
    {
        $cart = session('cart', []);

        return view('welcome-cart', compact('cart'));
    }


    public function increment(Request $request, $id)
    {
        $products = session('products', []);
        foreach ($products as &$product) {
            if ($product['id'] == $id) {
                $product['amount']++;
            }
        }
        session(['products' => $products]);
        return redirect()->back();
    }

    public function decrement(Request $request, $id)
    {
        $products = session('products', []);
        foreach ($products as &$product) {
            if ($product['id'] == $id && $product['amount'] > 0) {
                $product['amount']--;
            }
        }
        session(['products' => $products]);
        return redirect()->back();
    }


    // Menghapus produk dari cart
    public function removeFromCart($id)
    {
        $cart = session('cart', []);
        $cart = collect($cart)->reject(function ($item) use ($id) {
            return $item['id'] == $id;
        })->values()->all();

        session(['cart' => $cart]);

        return redirect()->route('welcome-cart')->with('success', 'Produk berhasil dihapus dari cart!');
    }


    public function clearCart()
    {
        // Menghapus semua data dari session
        session()->flush();

        // Redirect atau memberikan respon
        return redirect()->route('welcome')->with('message', 'Keranjang belanja telah dikosongkan.');
    }

}  
