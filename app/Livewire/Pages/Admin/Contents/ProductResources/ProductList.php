<?php

namespace App\Livewire\Pages\Admin\Contents\ProductResources;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Mary\Traits\Toast;

class ProductList extends Component
{

  public $title = "Products";
  public $url = "/products";

  use WithPagination;

  public $productPaginators;

  public Collection $productsSearchable;
  public Collection $productsMultiSearchable;

  public  $product_searchable_id;
  public  $products_multi_searchable_ids;


  #[Locked]
  public $productId;

  #[Url]
  public ?string $search = '';

  public $headers ;
  public $cell_decoration ;
  public $productFilter ;


  public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

  public function mount()
  {


    $this->headers = [
        ['key' => 'action', 'label' => 'Action', ],
        ['key' => 'id', 'label' => 'ID', ],
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'image_url', 'label' => 'Image Url', ],
        ['key' => 'selling_price', 'label' => 'Selling Price', 'format' => ['currency', '2,.', 'Rp ']],
        ['key' => 'is_activated', 'label' => 'Activate'],
        ['key' => 'availability', 'label' => 'Availability'],
        ['key' => 'created_at', 'label' => 'Date', 'format' => ['date', 'd/m/Y'], 'sortable' => true]
    ];

    $this->cell_decoration = [


    ];

    $this->search();

  }


  #[Computed]
  public function products(): LengthAwarePaginator
  {
      return Product::where('name', 'LIKE', "%{$this->search}%")->paginate(5);
  }


  public function search(string $value = '')
  {
      $selectedOption = Product::where('id', $this->product_searchable_id)->get();

      $this->productsSearchable = Product::query()
          ->where('name', 'like', "%$value%")
          ->take(5)
          ->orderBy('name')
          ->get()
          ->merge($selectedOption);

      $this->productsMultiSearchable = Product::query()
          ->where('name', 'like', "%$value%")
          ->take(5)
          ->orderBy('name')
          ->get()
          ->merge($selectedOption);
  }

  public function searchMulti($value)
  {
    $selectedOption = Product::where('id', $this->product_searchable_id)->get();


    $this->productsMultiSearchable = Product::query()
    ->where('name', 'like', "%$value%")
    ->take(5)
    ->orderBy('name')
    ->get()
    ->merge($selectedOption);
  }

  public function clear(): void
  {
      $this->reset();
      $this->success('Filters cleared.', position: 'toast-bottom');
  }

  public function render()
  {
    return view('livewire.pages.admin.contents.product-resources.product-list')
      ->title($this->title);
  }

}
