<?php

namespace App\Livewire\Pages\Visitor\ProdukDetailResources;

use Livewire\Component;
use App\Models\Product;   
use App\Models\ProductContent;   
use App\Models\ProductCategoryFirst;
use App\Models\ProductCategorySecond;  
use App\Models\Marketplace;
use App\Models\ProductBrand;   
use Illuminate\Support\Facades\DB; 
use App\Models\SalesCart;  
use App\Models\SalesCartDetail; 
use Illuminate\Support\Facades\Session; 
use App\Helpers\Cart\Cart;
use Livewire\Attributes\On; 


class ProdukDetailList extends Component
{
    public function render()
    {
        return view('livewire.pages.visitor.produk-detail-resources.produk-detail-list')
        ->layout('components.layouts.app_visitor')
        ->title($this->title);
    }

    public string $title = 'Produk detail';
    public $brand;  
    public $product;  
    public $product_content;  
    public $product_contents;  
    public $id;     
    // protected $parentModel = \App\Models\ProductContent::class;

    
    public function mount()  
    {  

        $this->product_content = ProductContent::with([
            'product',
            'productContentDisplays' => function ($q) {
                $q->orderBy('product_content_displays.ordinal', 'asc');
            },
            'productContentVideos' => function ($q) {
            },
            'productContentFeatures' => function ($q) {
            },
            'productContentMetas' => function ($q) {
            },
            'productContentMarketplaces' => function ($q) {
            },
            'productContentReviews' => function ($q) {
            },
            'productContentReviewImages' => function ($q) {
            },
            'productContentSpecifications' => function ($q) {
            },
            'productContentQnas' => function ($q) {
            },
            ])->where('product_id',$this->id)->get()->toArray();
        

        $this->brand = ProductCategoryFirst::query()
        ->join('product_category_seconds', 'product_category_firsts.product_category_second_id', 'product_category_seconds.id')
        ->select([
          'product_category_firsts.id',
          'product_category_firsts.name',
          'product_category_seconds.name AS product_category_seconds_name',
          'product_category_firsts.slug',
          'product_category_firsts.image_url',
          'product_category_firsts.header_image_url',
          'product_category_firsts.created_by',
          'product_category_firsts.updated_by',
          'product_category_firsts.created_at',
          'product_category_firsts.updated_at',
          'product_category_firsts.is_activated',
        ])
        ->where('product_category_firsts.id', $this->id)
        ->first();


    } 

    
    public function addToCart($productId, $sellingPrice, $weight)  
    { 
        $sessionId = Session::getId(); 

        if (!DB::table('sessions')->where('id', $sessionId)->exists()) {  
            DB::table('sessions')->insert([  
                'id' => $sessionId,  
                'payload' => 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiNmR2WThQaWRFY1hDVTZDaTN4TjJQbjE1TFNVV2hQSHRBQkNKbENCSSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',  
                'last_activity' => time(),  
            ]);  
        }  

        $cart = SalesCart::firstOrCreate(  
            ['session_id' => $sessionId],  
            ['date' => now()] 
        );

        // $this->product = Product::where('id',$sessionId);

        $cartDetail = SalesCartDetail::where([  
            'sales_cart_id' => $cart->id,  
            'product_id' => '9d921fc2-1ebf-46ba-a613-29cd580781e7',  
            'selling_price' => $sellingPrice,  
            'weight' => $weight,  
        ])->first();
  
        if ($cartDetail) {  
            // If the product is already in the cart, increase the quantity  
            $cartDetail->qty += 1;  
            $cartDetail->amount += $sellingPrice;  
            $cartDetail->subtotal_weight += $weight;  
        } else {  
            // If the product is not in the cart, create a new cart detail  
            $cartDetail = new SalesCartDetail([  
                'sales_cart_id' => $cart->id,  
                'product_id' => $productId,  
                'selling_price' => $sellingPrice,  
                'discount_persentage' => 0,  
                'discount_value' => 0,  
                'nett_price' => $sellingPrice,  
                'qty' => 1,  
                'amount' => $sellingPrice,  
                'weight' => $weight,  
                'subtotal_weight' => $weight,  
            ]);  
        }  

        // Save the cart detail  
        $cartDetail->save();  

        $this->success('Data Updated');
        // session()->flash('message', 'Product added to cart successfully!');  
    } 
    
    public function loadCartItems()  
    {  
        $cart = SalesCart::where('session_id', $this->sessionId)->first(); 
        if ($cart) {  
            $this->cartItems = $cart->details;
        } else {  
            $this->cartItems = [];
        }

        return $this->cartItems;
    } 

    public function isProductInCart($productId) 
    {  
        return SalesCartDetail::where('product_id', $productId)    
        ->exists(); 
    }

    public function updateCartItem($cartDetailId, $qty)  
    {  
        try {  
            $cartDetail = SalesCartDetail::find($cartDetailId);  
            if ($cartDetail) {  
                $cartDetail->qty = $qty;  
                $cartDetail->amount = $cartDetail->selling_price * $qty;  
                $cartDetail->subtotal_weight = $cartDetail->weight * $qty;  
                $cartDetail->save();  
                $this->loadCartItems();  
                $this->success('Cart Updated');
                 
            }  
        } catch (\Exception $e) {  
            session()->flash('error', 'Failed to update cart item: ' . $e->getMessage());  
        }  

        return  $cartDetail;
    }  
  
    public function removeCartItem($cartDetailId)  
    {  
        try {  
            $cartDetail = SalesCartDetail::find($cartDetailId);  
            if ($cartDetail) {  
                $cartDetail->delete();  
                $this->loadCartItems();  
                $this->success('Cart Updated');
            }  
        } catch (\Exception $e) {  
            session()->flash('error', 'Failed to remove cart item: ' . $e->getMessage());  
        }  

        return  $cartDetail;
    }  
  
    public function calculateTotal()  
    {  
        $total = 0;  
        foreach ($this->cartItems as $item) {  
            $total += $item->amount;  
        }  
        return $total;  
    }  
  
    public function calculateDiscount()  
    {  
        // Example discount calculation (15% of total)  
        $total = $this->calculateTotal();  
        return $total * 0.15;  
    }  
  
    public function calculateShipping()  
    {  
        // Example shipping cost  
        return 30000;  
    }  
  
    public function calculateVAT()  
    {  
        // Example VAT calculation (10% of total)  
        $total = $this->calculateTotal();  
        return $total * 0.1;  
    }  
  
    public function calculateFinalTotal()  
    {  
        $total = $this->calculateTotal();  
        $discount = $this->calculateDiscount();  
        $shipping = $this->calculateShipping();  
        $vat = $this->calculateVAT();  
        return $total - $discount + $shipping + $vat;  
    }  
  
    public function calculateHemat()  
    {  
        return 0;
    } 
    
    public function removeFromCart($id)
    {

        $this->isLoading = true;

        $products = session('products', []);
        $products = array_filter($products, function($product) use ($id) {
            return $product['id'] != $id;
        });

        session(['products' => $products]);

        $this->dispatch('productWasDeleted');

        $this->isLoading = false;

    }

    public function updateCart()
    {
        $this->validate([
            'amount' => 'required|numeric',
        ]);

        $products = session('products', []);
        foreach ($products as &$product) {
            if ($product['id'] == $this->productId) {
                $product['amount'] = $this->amount;
            }
        }

        session(['products' => $products]);
        $this->dispatch('productRefresh');

    }

    public function storeCart($id)  
    {
        // Ambil data produk berdasarkan ID
        $newProducts = ProductContent::query()
            ->join('products', 'product_contents.product_id', '=', 'products.id') // Menggunakan '=' untuk join
            ->select([
                'product_contents.id AS product_content_id',
                'products.id AS products_id',
                'products.name AS products_name',
                'products.selling_price AS product_selling_price',
                'products.discount_value AS product_discount_value',
                'products.nett_price AS product_nett_price',
                'products.weight AS product_weight', // Menyelesaikan kolom yang terputus
            ])
            ->where('products.id', $id) // Menambahkan kondisi untuk mengambil produk berdasarkan ID
            ->first(); // Mengambil satu produk


        // Jika produk ditemukan, simpan ke dalam keranjang
        if ($newProducts) {
            // Logika untuk menyimpan produk ke dalam keranjang
            $products = session('products', []);
            $products[] = [
                'id' => $newProducts->products_id,
                'amount' => 1,
            ];

            // Simpan kembali ke session
            session(['products' => $products]);

            $this->dispatch('productWasAdded');
        } else {
            // Jika produk tidak ditemukan, Anda bisa menambahkan logika penanganan error
            session()->flash('error', 'Product not found.');
        }
    }




}
