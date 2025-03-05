<?php

namespace App\Livewire\Pages\Visitor\ProdukResources;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductContent;
use App\Models\ProductBrand;
use App\Models\ProductCategoryFirst;
use App\Models\ProductCategorySecond;  
use Illuminate\Support\Facades\DB; 
use App\Models\Marketplace;
use App\Models\SalesCart; // Import the SalesCart model  
use App\Models\SalesCartDetail; // Import the SalesCartDetail model  
use Illuminate\Support\Facades\Session; // Import Session for session management  
use Livewire\WithPagination;

use App\Services\ProductService;
use App\Services\CartService;

class ProdukList extends Component
{
    use WithPagination;
    public string $title = 'Pencarian Product';
    public $product ;
    public $product_contents;
    public $product_content;
    public $id;
    public $product_category_firsts = [];
    public $brands = [];
    public $product_recommendations = [];
    public $selectedProductId;  
    public $arrayVar = 'false';  
    public $products5 = [];
    public $productrecoms = [];
    public $filterName = '';  
    public $filterCategory = '';  
    public $category_id;
    public $hargaMin;
    public $hargaMax;
    public $isLoading = false;

    public $products = [];
    protected $productService;
    public $cartItems = [];  
    protected $cartService;
    protected $addToCart;
    protected $loadCartItems;
    protected $isProductInCart;
    protected $updateCartItem;
    protected $removeCartItem;
    protected $calculateTotal;
    protected $calculateDiscount;
    protected $calculateShipping;
    protected $calculateVAT;
    protected $calculateFinalTotal;
    protected $calculateHemat;


    public function mount($id)
    {
        $this->isLoading = true;
        $this->id = $id;
        $this->loadProducts();  
        $this->isLoading = false;

    }    
  
    public function loadProducts()  
    {   
        $this->brands = ProductBrand::all();

        $this->product_category_firsts = ProductCategoryFirst::select('id','name')->get();


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


        $query = Product::query()
        ->join('product_contents', 'product_contents.product_id', '=', 'products.id')  
        ->join('product_brands', 'product_brands.id', '=', 'products.product_brand_id')  
        ->select([  
            'product_contents.id',  
            'products.name AS products_name',  
            'products.selling_price AS product_selling_price',  
            'products.discount_value AS product_discount_value',  
            'products.nett_price AS product_nett_price',  
            'products.availability AS product_availability',  
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
        ]);

        // Mengambil semua produk
        $query = Product::query();

        // Filter berdasarkan kategori jika ada
        if ($this->category_id) {
            $query->where('category_id', $this->category_id)->get();
        }

        // Filter berdasarkan harga jika ada
        if ($this->hargaMin && $this->hargaMax) {
            $query->whereBetween('nett_price', [$this->hargaMin, $this->hargaMax]);
        }

        // Menampilkan semua produk
        if ($this->id == "all") {
            $this->product_contents = $query->get();
        }

        // Menampilkan 5 produk terbaik
        elseif ($this->id == "best5") {
            $this->product_contents = $query->orderBy('rating', 'desc')->get();
        }

        // Menampilkan 10 produk terbaik
        elseif ($this->id == "best10") {
            $this->product_contents = $query->orderBy('rating', 'desc')->get();
        }

        // Jika tidak ada filter yang diterapkan, ambil semua produk
        else {
            $this->product_contents = $query->get();
        }

        $this->product_contents = $query->get(); 

    }

    public function updated()  
    {  
        $this->filterProduct();  
    } 


    public function initialize()  
    {  
        $this->cartService = new CartService();
        $this->addToCart = new CartService();
        $this->loadCartItems = new CartService();
        $this->isProductInCart = new CartService();
        $this->updateCartItem = new CartService();
        $this->removeCartItem = new CartService();
        $this->calculateTotal = new CartService();
        $this->calculateShipping = new CartService();
        $this->calculateVAT = new CartService();
        $this->calculateDiscount = new CartService();
        $this->calculateFinalTotal = new CartService();
        $this->calculateHemat = new CartService();
    }


    public function filterProduct()   
    {   
        $this->products = Product::query()  
        ->join('product_contents', 'product_contents.product_id', 'products.id')  
        ->join('product_brands', 'product_brands.id', 'products.product_brand_id')  
            ->select([  
                'product_contents.id',  
                'products.name AS products_name',  
                'products.selling_price AS product_selling_price',  
                'products.discount_value AS product_discount_value',  
                'products.nett_price AS product_nett_price',  
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
            ->when($this->filterName, function ($query) {    
                return $query->where('products.name', 'like', '%' . $this->filterName . '%');    
            })    
            ->when($this->filterCategory, function ($query) {    
                return $query->where('product_brands.name', $this->filterCategory);    
            })
            ->get();  
    }  

    public function render()
    {
        return view('livewire.pages.visitor.produk-resources.produk-list')
        ->layout('components.layouts.app_visitor')
        ->title($this->title);
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
