<?php

namespace App\Livewire\Pages\Visitor\CartResources;

use Livewire\Component;
use App\Models\ProductBrand;  
use App\Models\ProductContent;   
use App\Models\SalesCart;  
use App\Models\SalesCartDetail;  
use Illuminate\Support\Facades\Session;  
use Illuminate\Support\Facades\DB; 
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class CartList extends Component  
{  


    protected $listeners = [
        'productWasAdded' => 'loadCartItems',
        'productWasDeleted' => 'loadCartItems',
        'cartDeleteUpdated' => 'loadCartItems',
    ];
    
    public $brands = [];
    public $cartItems = [];
    public $cartItemRes = [];
    public $cartItemResCount = [];

    public $index = 0;
    public $sessionId;
    public $cartItems1;
    public $productrecoms  = []; 

    public function rules()  
    {  
        return [  
            'cartItems.*.qty' => 'required|integer|min:1', 
        ];  
    }  

    #[On('productWasAdded')] 
    #[On('productWasDeleted')] 
    #[On('cartDeleteUpdated')] 
    public function mount()  
    {  
        // Session::forget('products');
        $this->brands = ProductBrand::all();  
        $this->sessionId = Session::getId();  

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

      $this->loadCartItems();  


    }  
  
    public function render()  
    {  

        return view('livewire.pages.visitor.cart-resources.cart-list');  
    }  

    #[On('item-added')] 
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
        return redirect()->route('cart-item');  
    } 
    
    #[On('productWasAdded')] 
    #[On('productWasDeleted')] 
    public function loadCartItems()  
    {  
        $this->cartItems = session('products', []);

            foreach ($this->cartItems as $cartItem) {

                $this->cartItemRes =  ProductContent::query()
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
            ])->where('products.id', $cartItem['id'])->get()->toArray();

        }

        return $this->cartItemRes;
    } 
    
    #[Computed]
    public function loadCartItems1()  
    {  
        $cart = session('products', []);

        $this->cartItems1 = count($this->cartItems);

        return $this->cartItems1;
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
        // $this->products = session('products', []);
        $this->cartItems = session('products', []);
        // dd($this->cartItems);
        $total = 0;  
        // foreach ($this->cartItems as $item) {  
        //     $total += $item['amount'];  
        // }  
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


    public function isProductInCart($productId)
    {
        $products = session('products', []);
        foreach ($products as $product) {
            if ($product['id'] == $productId) {
                return true; 
            }
        }

        // SalesCartDetail::where('product_id', $productId)    
        // ->exists();

        $this->dispatch('productDeleteRefresh');


        return false; // Produk tidak ada di dalam keranjang
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

    public function deleteCart($id)
    {
        $products = session('products', []);
        $products = array_filter($products, function($product) use ($id) {
            return $product['id'] != $id;
        });

        session(['products' => $products]);
    }


  
}  

