<?php

namespace App\Livewire\Pages\Visitor\KategoriResources;

use App\Models\Product;
use App\Models\Marketplace;
use Livewire\Component;
use App\Models\ProductBrand;   
use App\Models\ProductContent;   
use App\Models\ProductCategoryFirst;
use App\Models\ProductCategorySecond;  
use Illuminate\Support\Facades\DB; 

use App\Models\SalesCart; 
use App\Models\SalesCartDetail; 
use Illuminate\Support\Facades\Session; 
use Livewire\Attributes\Computed;
class KategoriList extends Component
{

    public $id;
    public $product_category_first;
    public $gradient_color;
    public $product_brand;
    public $product_brands;
    public $products;
    public $firstProduct;
    public $secondProducts;
    public $remainingProducts;

    public $firstName = '';
    public $lastName = '';

    #[Computed]
    public function fullNames()
    {
        return "{$this->firstName} {$this->lastName}";
    }


    public function mount()
    {
        $this->product_category_first = ProductCategoryFirst::with([
            'product'
        ])
        ->where('id', $this->id)
        ->first()
        ->toArray();

        foreach($this->product_category_first['product'] as $item){

            $this->product_brand = ProductBrand::where('id', $item['product_brand_id'])
            ->first()
            ->toArray();
        }
        
        // $this->products = array_merge($this->product_category_first, $this->product_brand);
        // dd(count($this->product_category_first));

        if ($this->product_category_first) {
            // $this->product_category_first = $this->product_category_first->toArray();
    
            // Initialize the products array
            $products = $this->product_category_first['product'];
    
            // Divide products into three parts
            $this->firstProduct = array_slice($products, 0, 1); // First product
            $this->secondProducts = array_slice($products, 1, 2); // Next two products
            $this->remainingProducts = array_slice($products, 3); // All remaining products
    
            // Optionally, you can fetch product brands for the first two products
            $this->product_brands = [];
            foreach ($products as $item) {
                $productBrand = ProductBrand::where('id', $item['product_brand_id'])->first();
                if ($productBrand) {
                    $this->product_brands[] = $productBrand->toArray();
                }
            }
        } else {
            // Handle the case where no product category first was found
            $this->product_category_first = [];
            $this->firstProduct = [];
            $this->secondProducts = [];
            $this->remainingProducts = [];
        }

        


    }
    
    public function render()
    {
        return view('livewire.pages.visitor.kategori-resources.kategori-list')
        ->layout('components.layouts.app_visitor')
        ->title($this->title);
    }

    public string $title = 'Kategori';
    





}
