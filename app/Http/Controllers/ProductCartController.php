<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductCartController extends Controller
{
    /**
     * Menampilkan daftar produk.
     */
    public function index()
    {
        $products = session('products', []);
        return view('product-cart.index', compact('products'));
    }

    /**
     * Menampilkan form untuk membuat produk baru.
     */
    public function create()
    {
        return view('product-cart.create');
    }

    /**
     * Menyimpan produk baru ke dalam session.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);

        $products = session('products', []);
        $id = count($products) > 0 ? max(array_column($products, 'id')) + 1 : 1;

        $products[] = [
            'id' => $id,
            'name' => $request->name,
            'price' => $request->price,
            'amount' => $request->amount,
        ];

        session(['products' => $products]);

        return redirect()->route('product-cart.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit produk.
     */
    public function edit($id)
    {
        $products = session('products', []);
        $product = collect($products)->firstWhere('id', (int)$id);

        if (!$product) {
            return redirect()->route('product-cart.index')
                ->with('error', 'Produk tidak ditemukan.');
        }

        return view('product-cart.edit', compact('product'));
    }

    /**
     * Mengupdate produk di dalam session.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);

        $products = session('products', []);

        $updatedProducts = collect($products)->map(function ($product) use ($id, $request) {
            if ($product['id'] == $id) {
                $product['name'] = $request->name;
                $product['price'] = $request->price;
                $product['amount'] = $request->amount;
            }
            return $product;
        })->toArray();

        session(['products' => $updatedProducts]);

        return redirect()->route('product-cart.index')
            ->with('success', 'Produk berhasil diupdate.');
    }

    /**
     * Menghapus produk dari session.
     */
    public function destroy($id)
    {
        $products = session('products', []);

        $updatedProducts = collect($products)
            ->reject(function ($product) use ($id) {
                return $product['id'] == $id;
            })
            ->toArray();

        session(['products' => $updatedProducts]);

        return redirect()->route('product-cart.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
