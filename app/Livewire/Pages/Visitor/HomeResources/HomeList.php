<?php

namespace App\Livewire\Pages\Visitor\HomeResources;

use App\Models\Marketplace;
use Livewire\Component;
use App\Models\ProductBrand;   
use App\Models\Product;   
use App\Models\ProductContent;   
use App\Models\ProductCategoryFirst;
use App\Models\ProductCategorySecond;  
use Illuminate\Support\Facades\DB; 

use App\Models\SalesCart;  
use App\Models\SalesCartDetail; 
use Illuminate\Support\Facades\Session; 
use App\Helpers\Cart\Cart;
use Livewire\Attributes\On; 

class HomeList extends Component
{
    public $invoice;

    use \Mary\Traits\Toast;

    public string $title = 'Home';  
    public string $url = '/home';
    public $product_category_firsts; 
    public $categories; 
    public $marketplaces;   
    public $isLoading = false;

    public $product_category_second;   
    public $product_brands = []; 

    public $product_brand_lists;   
    public $product_contents  = []; 
    public $productrecoms  = [];   

    public $product_content = [];   
    public $product_lists;   
    public $product;
    public $products5; 

    public $product_detail = [];

    public $brands = [];  
    public $cartItems;  
    public $cartItemRes;  
    public $index = 0;  
    public $sessionId;  
    public $productId;  


    public function rules()  
    {  
        return [  
            'cartItems.*.qty' => 'required|integer|min:1', 
        ];  
    }  

    public function productDetail($product_id)
    {
        $this->reset();
        $this->product_detail = Product::with(['productCategoryFirst','productContent'])->where('id', $product_id)->first();
    }

    public function render()
    {
        return view('livewire.pages.visitor.home-resources.home-list')
          ->layout('components.layouts.app_visitor')
        ->title($this->title);
    }

    #[On('productWasAdded')] 
    #[On('productWasDeleted')] 
    public function mount() 
    {  
        $cart = new Cart();
        $this->cartItems = session('products', []);


        // $this->cartItems = cartItem;
        // dd($this->cartItems);
        // $this->product_category_first = ProductCategoryFirst::query()
        // ->join('product_category_seconds', 'product_category_firsts.product_category_second_id', 'product_category_seconds.id')
        // ->select([
        //   'product_category_firsts.id',
        //   'product_category_firsts.name',
        //   'product_category_seconds.name AS product_category_seconds_name',
        //   'product_category_firsts.slug',
        //   'product_category_firsts.image_url',
        //   'product_category_firsts.header_image_url',
        //   'product_category_firsts.created_by',
        //   'product_category_firsts.updated_by',
        //   'product_category_firsts.created_at',
        //   'product_category_firsts.updated_at',
        //   'product_category_firsts.is_activated',
        // ])->get();

        $this->categories =  ProductCategoryFirst::all();
        // ])->where('product_brands.id','9d8c8235-70a3-4269-b59e-62a371e9456')->get();
        $this->marketplace =  Marketplace::all();


        $this->productrecoms =  ProductContent::query()
          ->join('products', 'product_contents.product_id', 'products.id')
          ->join('product_brands', 'products.product_brand_id', '=', 'product_brands.id') 
          ->select([
            'product_contents.id',
            'products.id AS products_id',
            'products.name AS products_name',
            'products.selling_price AS product_selling_price',
            'products.discount_value AS product_discount_value',
            'products.nett_price AS product_nett_price',
            'products.weight AS product_weight',
            'products.is_new AS product_is_new',
            'products.availability AS product_availability',
            'products.discount_persentage AS product_discount_persentage',
            'product_contents.title',
            'product_contents.slug',
            'product_contents.url',
            'product_contents.image_url',
            'product_contents.created_by',
            'product_contents.updated_by',
            'product_contents.created_at',
            'product_contents.updated_at',
            'product_contents.is_activated',
            'product_brands.name AS product_brand_name',
        ])->get();

        $this->products5 =  ProductContent::query()
          ->join('products', 'product_contents.product_id', 'products.id')
          ->select([
            'product_contents.id',
            'products.id AS products_id',
            'products.name AS products_name',
            'products.selling_price AS product_selling_price',
            'products.discount_value AS product_discount_value',
            'products.nett_price AS product_nett_price',
            'products.weight AS product_weight',
            'products.is_new AS product_is_new',
            'products.discount_persentage AS product_discount_persentage',
            'product_contents.title',
            'product_contents.slug',
            'product_contents.url',
            'product_contents.image_url',
            'product_contents.created_by',
            'product_contents.updated_by',
            'product_contents.created_at',
            'product_contents.updated_at',
            'product_contents.is_activated',
        ])->get();

        $this->brands =  ProductBrand::query()
          ->select([
            'product_brands.id',
            'product_brands.name',
            'product_brands.image_url',
            'product_brands.desc',
            'product_brands.created_by',
            'product_brands.updated_by',
            'product_brands.created_at',
            'product_brands.updated_at',
            'product_brands.is_activated',
        ])->get();

        $this->marketplaces =  Marketplace::query()
          ->select([
            'marketplaces.id',
            'marketplaces.name',
            'marketplaces.url',
            'marketplaces.image_url',
            'marketplaces.is_activated',
        ])->where('marketplaces.is_activated', 1)->get();

        $this->product_brand_lists = ProductBrand::query()  
        ->with(['products' => function ($query) {  
            $query->take(5); // Ambil maksimal 5 produk untuk setiap brand  
        }])  
        ->inRandomOrder()  
        ->take(2)  
        ->get();


    }  


    public function addToCart($productId)  
    { 
        // $sessionId = Session::getId(); 
        $this->isLoading = true;
        $id = $this->productId;
        
        $products = session('products', []);
        $id = count($products) > 0 ? max(array_column($products, 'id')) + 1 : 1;

        $products[] = [
            'id' => $id,
            'amount' => $this->amount,
        ];

        session(['products' => $products]);

        // Refresh the products list
        $this->products = $products;

        $this->dispatch('productWasAdded');


        if (!DB::table('sessions')->where('id', $sessionId)->exists()) {  
            DB::table('sessions')->insert([  
                'id' => $sessionId,  
                'payload' => 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiNmR2WThQaWRFY1hDVTZDaTN4TjJQbjE1TFNVV2hQSHRBQkNKbENCSSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',  
                'last_activity' => time(),  
            ]);  
        }


        $newProducts =  ProductContent::query()
          ->join('products', 'product_contents.product_id', 'products.id')
          ->select([
            'product_contents.id',
            'products.id AS products_id',
            'products.name AS products_name',
            'products.selling_price AS product_selling_price',
            'products.discount_value AS product_discount_value',
            'products.nett_price AS product_nett_price',
            'products.weight AS product_weight',
            'products.is_new AS product_is_new',
            'products.discount_persentage AS product_discount_persentage',
            'product_contents.title',
            'product_contents.slug',
            'product_contents.url',
            'product_contents.image_url',
            'product_contents.created_by',
            'product_contents.updated_by',
            'product_contents.created_at',
            'product_contents.updated_at',
            'product_contents.is_activated',
        ])->where('products.id', $productId)->get()->toArray();
        

        // Ambil produk yang sudah ada di session
        $products = session('products', []);

        // Gabungkan produk baru dengan produk yang sudah ada
        $products = array_merge($products, $newProducts);

        // Simpan kembali ke session
        session(['products' => $products]);


        $cart = SalesCart::firstOrCreate(  
            ['session_id' => $sessionId],  
            ['date' => now()] ,
            ['created_by' => auth()->user()->username ?? ''],
            ['updated_by' => auth()->user()->username ?? '']
        );  

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


        $this->success('Produk ditambahkan ke keranjang!');

        // $this->emit('refreshCart', $cartDetail);
        // Optionally, you can dispatch an event or flash a message  
        session()->flash('message', 'Product added to cart successfully!');  
        $this->isLoading = false;
    } 

    #[On('cart-created')]
    public function loadCartItems($cartId)  
    {  
        
        $cart = SalesCart::where('session_id', $this->sessionId)->first();
        if ($cart) {  
            $this->cartItems = $cart->details;
        } else {  
            $this->cartItems = [];  
        }  
    }

    // public function isProductInCart($productId)
    // {
    //     // Ambil produk dari session
    //     $products = session('products', []);
    
    //     // Pastikan $products adalah array
    //     if (!is_array($products)) {
    //         return false;
    //     }

    //     foreach ($products as $product) {

    //         $this->cartItemRes =  ProductContent::query()
    //             ->join('products', 'product_contents.product_id', 'products.id')
    //             ->join('product_brands', 'products.product_brand_id', '=', 'product_brands.id') 
    //             ->select([
    //             'product_contents.id',
    //             'products.id AS products_id',
    //         ])->where('products.id', $product['id'])->get()->toArray();
    //     }

    //     if($this->cartItemRes){
    //         return true;
    //     }else{
    //         return false;
    //     }

    
    // }

    public function isProductInCart($productId)
{
    // Ambil produk dari session
    $isproducts = session('products', []);
    // Pastikan $products adalah array
    if (!is_array($isproducts)) {
        return false;
    }

    // Periksa apakah produk dengan ID yang diberikan ada di dalam session
    foreach ($isproducts as $isproduct) {
        // Pastikan $isproduct adalah array dan memiliki kunci 'id'
        if (is_array($isproduct) && array_key_exists('id', $isproduct)) {
            // Konversi ke string untuk memastikan perbandingan yang benar
            if ((string) $isproduct['id'] === (string) $productId) {
                return true; // Produk ditemukan di keranjang
            }
        }
    }

    return false; // Produk tidak ditemukan di keranjang
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
                $this->dispatch('cartUpdated');  
            }  
        } catch (\Exception $e) {  
            session()->flash('error', 'Failed to update cart item: ' . $e->getMessage());  
        }  
    }  
  
    public function removeCartItem($cartDetailId)  
    {  
        $products = session('products', []);

        $updatedProducts = collect($products)
            ->reject(function ($product) use ($id) {
                return $product['id'] == $id;
            })
            ->toArray();

        session(['products' => $updatedProducts]);

        return redirect()->route('cart-item')
            ->with('success', 'Produk berhasil dihapus.');
    }  
  
    public function calculateTotal()  
    {  
        $total = 0;  
        $this->cartItems = session('products', []);

        foreach ($this->cartItems as $item) {  
            $total += $item->amount;  
        }  

        dd($total);
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

    // public function storeCart($id)  
    // {
        

    //     $newProducts =  ProductContent::query()
    //         ->join('products', 'product_contents.product_id', 'products.id')
    //         ->select([
    //         'product_contents.id',
    //         'products.id AS products_id',
    //         'products.name AS products_name',
    //         'products.selling_price AS product_selling_price',
    //         'products.discount_value AS product_discount_value',
    //         'products.nett_price AS product_nett_price',
    //         'products.weight AS product_weight',
    //         'products.is_new AS product_is_new',
    //         'products.discount_persentage AS product_discount_persentage',
    //         'product_contents.title',
    //         'product_contents.slug',
    //         'product_contents.url',
    //         'product_contents.image_url',
    //         'product_contents.created_by',
    //         'product_contents.updated_by',
    //         'product_contents.created_at',
    //         'product_contents.updated_at',
    //         'product_contents.is_activated',
    //     ])->where('products.id', $id)->first()->toArray();
        

        
    //     // $this->validate([
    //     //     'name' => 'required',
    //     //     'price' => 'required|numeric',
    //     //     'amount' => 'required|numeric',
    //     // ]);

    //     $products = session('products', []);
    //     $id = count($products) > 0 ? max(array_column($products, 'id')) + 1 : 1;

    //     $products[] = [
    //         'id' => $newProducts['products_id'],
    //         'name' => $newProducts['name'],
    //         'product_selling_price' => $newProducts['product_selling_price'],
    //         'product_discount_value' => $newProducts['product_discount_value'],
    //         'product_nett_price' => $newProducts['product_nett_price'],
    //         'product_weight' => $newProducts['product_weight'],
    //         'product_is_new' => $newProducts['product_is_new'],
    //         'product_discount_persentage' => $newProducts['product_discount_persentage'],
    //         'slug' => $newProducts['slug'],
    //         'url' => $newProducts['url'],
    //         'image_url' => $newProducts['image_url'],
    //         'created_by' => $newProducts['created_by'],
    //         'updated_by' => $newProducts['updated_by'],
    //         'created_at' => $newProducts['created_at'],
    //         'updated_at' => $newProducts['updated_at'],
    //         'is_activated' => $newProducts['is_activated'],

    //     ];

    //     session(['products' => $products]);



    //     // Refresh the products list
    //     $this->products = $products;

    //     $this->dispatch('productWasAdded');
    // }

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

    // public function removeFromCart($id)
    // {
    //     $products = session('products', []);
    //     $products = array_filter($products, function($product) use ($id) {
    //         return $product['id'] != $id;
    //     });
    //     session(['products' => $products]);
    // }

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



}