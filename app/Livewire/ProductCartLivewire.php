<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use App\Models\ProductContent;

class ProductCartLivewire extends Component  
{  
    protected $listeners = ['productRefresh' => 'mount'];
    protected $listeners1 = ['productDeleteRefresh' => 'mount'];


    public $brands = [];
    public $products = [];
    public $products5 = [];

    public $productId;
    public $name;
    public $price;
    public $amount;
    public $title = 'Product Cart Livewire';

    #[On('productRefresh')] 
    public function mount()  
    {  
        $this->products = session('products', []);

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
      

    }  

    public function editCart($id)
    {
        $product = collect($this->products)->firstWhere('id', $id);
        if ($product) {
            $this->productId = $product['id'];
            $this->amount = $product['amount'];
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

    public function deleteCart($id)
    {
        $products = session('products', []);
        $products = array_filter($products, function($product) use ($id) {
            return $product['id'] != $id;
        });

        session(['products' => $products]);
    }


    public function render()  
    {  
        return view('livewire.product-cart-livewire')
            ->layout('components.layouts.app_visitor')
            ->title($this->title);  
    }  
    
    public function storeCart()  
    {
        $id = $this->productId; // Mengambil ID produk dari properti
    
        $this->validate([
            'name' => 'required',
        ]);

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
    }

    public function isProductInCart($productId)
    {
        $products = session('products', []);
        foreach ($products as $product) {
            if ($product['id'] == $productId) {
                return true; // Produk ada di dalam keranjang
            }
        }

        $this->dispatch('productDeleteRefresh');


        return false; // Produk tidak ada di dalam keranjang
    }

}
