<?php

namespace App\Livewire\Pages\Visitor\CartItemResources;

use Livewire\Component;
use App\Models\Marketplace;
use App\Models\ProductBrand;   
use App\Models\ProductContent;   
use App\Models\ProductCategoryFirst;
use App\Models\ProductCategorySecond;  
use Illuminate\Support\Facades\DB; 
use Livewire\Attributes\On; 

use App\Models\Product;
use App\Models\SalesCart; 

use App\Models\SalesCartDetail; // Import the SalesCartDetail model  
use Illuminate\Support\Facades\Session; // Import Session for session management  


class CartItemList extends Component
{
    public $product_category_first;   
    public $product_category_second;   
    public $productrecoms  = [];   
    public $amount = 1;
    public $product_brands;   
    public $product_brand_lists;   
    public $product_contents;   
    public $productRecommendations;   
    public $marketplaces; 
    public $products = [];
    public $product ;
    public $productId ;
    public $productContent = [];
    public $productCategoryFirsts = [];
  
    public $brands = [];  
    public $cartItems = [];  
    public $cartItemArrays;  
    public $index = 0;  
    public $sessionId;  
    public $products5 = [];

    #[\Livewire\Attributes\Locked]
    protected $parentModel = \App\Models\ProductContent::class;
  
    #[\Livewire\Attributes\Locked]
    public array $options = [];
  
  
    #[\Livewire\Attributes\Locked]
    public null|string $id = null;

    use \Mary\Traits\Toast;

    
    public function rules()  
    {  
        return [  
            'cartItems.*.qty' => 'required|integer|min:1', 
        ];  
    }  

    public function render()
    {
        return view('livewire.pages.visitor.cart-item-resources.cart-item-list')
        ->layout('components.layouts.app_visitor')
        ->title($this->title);
    }

    public string $title = 'Cart Item';
    
    public function mount() 
    {  
        $this->cartItems = session('products', []);
        $this->initialize();
        $this->calculateTotal();
        $this->loadCartItems();
    }  

    public function initialize()  
    {  
        $this->brands = ProductBrand::all();  

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

        $this->sessionId = Session::getId();
        // $this->productCategoryFirsts = ProductContent::with('product')->get(); 
        $this->productCategoryFirsts = ProductCategoryFirst::with('product')->get();

        $this->productRecommendations = Product::with('productCategoryFirst')
        ->where('product_category_first_id',$this->id)->get();

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


        $this->options['product_category_firsts'] = ProductCategoryFirst::all(); 

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

        $cart = session()->get('cart', []);

        if (isset($cart[$movieId])) {
            // Update quantity if product is already in the cart
            $cart[$movieId]['quantity'] += $quantity;
        } else {
            // Add new item to the cart
            $cart[$movieId] = [
                'id' => $movie->id,
                'name' => $movie->name,
                'price' => $movie->price,
                'quantity' => $quantity,
                "poster" => $movie->poster
            ];
        }

        session()->put('cart', $cart);
        

    } 

    
    #[On('cartAmountUpdated')] 
    #[On('cartDeleteUpdated')] 
    public function loadCartItems()  
    {  
        // Ambil item keranjang dari sesi
        $this->cartItems = session('products', []);
        
        // Inisialisasi array untuk menyimpan produk
        $this->products = []; 
    
        // Loop melalui setiap item di keranjang
        foreach($this->cartItems as $cartItem) {
            // Ambil produk berdasarkan ID dari cartItem
            $product = ProductContent::query()
                ->join('products', 'product_contents.product_id', '=', 'products.id')
                ->join('product_brands', 'products.product_brand_id', '=', 'product_brands.id') 
                ->select([
                    'product_contents.id AS product_content_id',
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
                ])
                ->where('products.id', $cartItem['id']) // Pastikan menggunakan ID yang benar
                ->first(); // Ambil satu produk
    
            // Jika produk ditemukan, tambahkan ke array products
            if ($product) {
                $product->amount = $cartItem['amount']; // Menambahkan amount ke objek produk
                $this->products[] = $product; 
            }
        }
    
        // Debug untuk melihat hasil produk
        return $this->products;
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
                $this->dispatch('cartUpdated');  
            }  
        } catch (\Exception $e) {  
            session()->flash('error', 'Failed to update cart item: ' . $e->getMessage());  
        }  
    }  
  
    public function removeCartItem($cartDetailId)  
    {  
        try {  
            $cartDetail = SalesCartDetail::find($cartDetailId);  
            if ($cartDetail) {  
                $cartDetail->delete();  
                $this->loadCartItems();  
                $this->dispatch('cartUpdated');
                $this->success('Produk dihapus dari keranjang!');
                session()->flash('success', 'Success to remove data from cart');  

            }  
        } catch (\Exception $e) {  
            session()->flash('error', 'Failed to remove cart item: ' . $e->getMessage());  
        }  
    }  
  
    public function calculateTotal()  
    {  
        $total = 0;  
        $this->cartItems = session('products', []);
        // Loop melalui setiap item di keranjang
        foreach ($this->cartItems as $item) {  
            // Ambil produk dari database berdasarkan ID
            $product = ProductContent::query()
                ->join('products', 'product_contents.product_id', '=', 'products.id')
                ->select('products.nett_price') // Ambil harga nett
                ->where('products.id', $item['id']) // Cari produk berdasarkan ID
                ->first(); // Ambil produk pertama yang ditemukan

            // Jika produk ditemukan, kalikan harga nett dengan amount dan tambahkan ke total
            if ($product) {
                $total += $product->nett_price * $item['amount'];
            }
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


    public function increment($itemId)
    {
        // Tambahkan 1 ke amount
        $this->amount++;

        // Update session products
        $this->updateSessionAmount($itemId);
    }

    public function decrement($itemId)
    {
        // Kurangi 1 dari amount jika lebih dari 0
        if ($this->amount > 0) {
            $this->amount--;
        }

        // Update session products
        $this->updateSessionAmount($itemId);
    }

    private function updateSessionAmount($itemId)
    {
        // Ambil produk dari session
        $products = session('products', []);
    
        // Cari index produk yang sesuai dengan ID produk saat ini
        $index = array_search($itemId, array_column($products, 'id'));

        // Jika produk ditemukan, perbarui amount
        if ($index !== false) {
            $products[$index]['amount'] = $this->amount; // Update amount
    
            // Simpan kembali ke session
            session(['products' => $products]);
        }

        $this->dispatch('cartAmountUpdated');  


    }


    public function deleteCart($id)
    {
        // Mendapatkan array produk dari sesi. Jika tidak ada, inisialisasi dengan array kosong.
        $products = Session::get('products', []);

        // Memfilter array produk, menghapus produk dengan ID yang sesuai.
        $products = array_filter($products, function ($product) use ($id) {
            return $product['id'] != $id;
        });

        // Menyimpan kembali array produk yang telah diperbarui ke dalam sesi.
        Session::put('products', $products);
        $this->dispatch('cartDeleteUpdated');

    }


}
