<?php

namespace App\Livewire\Pages\Admin\Contents\ProductResources;

use App\Livewire\Pages\Admin\Contents\ProductResources\Forms\ProductForm;
use Livewire\Component;
use App\Models\ProductBrand;
use App\Models\Product;
use App\Models\ProductCategoryFirst;

class ProductCrud extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.contents.product-resources.product-crud')
      ->title($this->title);
  }

  use \Livewire\WithFileUploads;
  use \App\Helpers\ImageUpload\Traits\WithImageUpload;
  use \Mary\Traits\Toast;

  #[\Livewire\Attributes\Locked]
  public string $title = 'Product';

  public  $brands = [];

  public $selectedBrandId =''; 
  public $selectedProductCategoryFirstId =''; 
  public  $productCategoryFirsts = [];
  public  $productCategories = [];

  #[\Livewire\Attributes\Locked]
  public string $url = '/products';

  #[\Livewire\Attributes\Locked]
  private string $baseFolderName = '/files/images/products';

  #[\Livewire\Attributes\Locked]
  private string $baseImageName = 'product_image';

  #[\Livewire\Attributes\Locked]
  public string $id = '';

  #[\Livewire\Attributes\Locked]
  public string $readonly = '';

  #[\Livewire\Attributes\Locked]
  public bool $isReadonly = false;

  #[\Livewire\Attributes\Locked]
  public bool $isDisabled = false;

  #[\Livewire\Attributes\Locked]
  public array $options = [];

  #[\Livewire\Attributes\Locked]
  protected $masterModel = \App\Models\Product::class;

  public ProductForm $masterForm;

  public function mount()
  {
    if ($this->id && $this->readonly) {
      $this->title .= ' (Show)';
      $this->show();
    } else if ($this->id) {
      $this->title .= ' (Edit)';
      $this->edit();
    } else {
      $this->title .= ' (Create)';
      $this->create();
    }

    $this->initialize();
  }


  public function updatedSelectedBrandId($brandId)  
  { 
    $products = Product::with('productCategoryFirst')    
        ->where('products.product_brand_id', $brandId)    
        ->get();    
    
        $this->productCategoryFirsts = $products->map(function ($product) {        
          // Cek apakah productCategoryFirst ada    
          if ($product->productCategoryFirst) {    
              return [        
                  'id' => $product->productCategoryFirst->id,     
                  'name' => $product->productCategoryFirst->name,         
                  'category_second_id' => $product->productCategoryFirst->product_category_second_id // Ambil ID kategori kedua  
              ];        
          }    
          return null; // Jika tidak ada productCategoryFirst, kembalikan null    
      })->filter()->unique('id')->values();    
    
      // Ambil semua kategori berdasarkan product_category_second_id yang ditemukan  
      if ($this->productCategoryFirsts->isNotEmpty()) {  
          // Ambil ID kategori kedua dari kategori pertama yang ditemukan  
          $firstCategorySecondId = $this->productCategoryFirsts->first()['category_second_id'];  
            
          // Ambil semua kategori berdasarkan ID kategori kedua  
          $this->productCategories = ProductCategoryFirst::where('product_category_second_id', $firstCategorySecondId)->get();  
      } else {  
          $this->productCategories = collect(); // Jika tidak ada kategori, kembalikan koleksi kosong  
      } 



  }  


  public function initialize()  
  {  
    $this->options['brands'] = ProductBrand::all();
    $this->options['product_category_firsts'] = ProductCategoryFirst::all(); 
  }

  public function updatedMasterFormProductBrandId($brandId)    
  {
      $this->options['products'] = Product::where('product_brand_id', $brandId)->get();
  }

  public function create()
  {
    $this->masterForm->reset();
  }

  public function store()
  {

    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];



    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $validatedForm['created_by'] = auth()->user()->username;
      $validatedForm['updated_by'] = auth()->user()->username;
      $validatedForm['product_brand_id'] = $this->selectedBrandId; 

      // image_url
      $folderName = $this->baseFolderName;
      $now = now()->format('Ymd_His_u');
      $imageName = $this->baseImageName . '_' . str($validatedForm['name'])->slug('_')  . '_' . 'image' . '_' . $now;
      $newImageUrl = $validatedForm['image_url'];

      $validatedForm['image_url'] = $this->saveImage(
        $folderName,
        $imageName,
        $newImageUrl,
      );
      // ./image_url

      $this->masterModel::create($validatedForm);
      \Illuminate\Support\Facades\DB::commit();

      $this->create();
      $this->success('Data has been stored');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      \Log::error('Data product failed to store: ' . $th->getMessage());  

      $this->error('Data failed to store');
    }
  }

  public function show()
  {
    $this->isReadonly = true;
    $this->isDisabled = true;
    $masterData = $this->masterModel::findOrFail($this->id);
    $this->masterForm->fill($masterData);
  }

  public function edit()
  {
    $masterData = $this->masterModel::findOrFail($this->id);
    $this->masterForm->fill($masterData);

    // dd($masterData);

  }

  public function update()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $masterData = $this->masterModel::findOrFail($this->id);

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $validatedForm['updated_by'] = auth()->user()->username;

      // image_url
      $folderName = $this->baseFolderName;
      $now = now()->format('Ymd_His_u');
      $imageName = $this->baseImageName . '_' . str($validatedForm['name'])->slug('_')  . '_' . 'image' . '_' . $now;
      $newImageUrl = $validatedForm['image_url'];
      $oldImageUrl = $masterData['image_url'];

      $validatedForm['image_url'] = $this->saveImage(
        $folderName,
        $imageName,
        $newImageUrl,
        $oldImageUrl,
      );
      // ./image_url

      $masterData->update($validatedForm);

      \Illuminate\Support\Facades\DB::commit();

      $this->success('Data has been updated');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to update');
    }
  }

  public function delete()
  {
    $masterData = $this->masterModel::findOrFail($this->id);

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $this->deleteImage($masterData['image_url']);

      $masterData->delete();
      \Illuminate\Support\Facades\DB::commit();

      $this->success('Data has been deleted');
      $this->redirect($this->url, true);
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to delete');
    }
  }


  // Hook
  public function updatedMasterFormSellingPrice()
  {
    try {
      $this->masterForm->discount_value = $this->masterForm->selling_price * $this->masterForm->discount_persentage / 100;
      $this->masterForm->nett_price = $this->masterForm->selling_price - $this->masterForm->discount_value;
    } catch (\Throwable $th) {
      $this->masterForm->discount_persentage = 0;
      $this->masterForm->discount_value = 0;
      $this->masterForm->nett_price = $this->masterForm->selling_price;
    }
  }

  public function updatedMasterFormDiscountPersentage()
  {
    try {
      $this->masterForm->discount_value = $this->masterForm->selling_price * $this->masterForm->discount_persentage / 100;
      $this->masterForm->nett_price = $this->masterForm->selling_price - $this->masterForm->discount_value;
    } catch (\Throwable $th) {
      $this->masterForm->discount_persentage = 0;
      $this->masterForm->discount_value = 0;
      $this->masterForm->nett_price = $this->masterForm->selling_price;
    }
  }

  public function updatedMasterFormDiscountValue()
  {
    try {
      $this->masterForm->discount_persentage = ($this->masterForm->discount_value / $this->masterForm->selling_price) * 100;
      $this->masterForm->discount_persentage = number_format($this->masterForm->discount_persentage, 2);
      $this->masterForm->nett_price = $this->masterForm->selling_price - $this->masterForm->discount_value;
    } catch (\Throwable $th) {
      $this->masterForm->discount_persentage = 0;
      $this->masterForm->discount_value = 0;
      $this->masterForm->nett_price = $this->masterForm->selling_price;
    }
  }

  public function updatedMasterFormNettPrice()
  {
    try {
      $this->masterForm->discount_value = $this->masterForm->selling_price - $this->masterForm->nett_price;
      $this->masterForm->discount_persentage = ($this->masterForm->discount_value / $this->masterForm->selling_price) * 100;
      $this->masterForm->discount_persentage = number_format($this->masterForm->discount_persentage, 2);
    } catch (\Throwable $th) {
      $this->masterForm->discount_persentage = 0;
      $this->masterForm->discount_value = 0;
      $this->masterForm->nett_price = $this->masterForm->selling_price;
    }
  }
  // ./Hook



}
