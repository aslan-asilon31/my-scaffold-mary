<?php

namespace App\Livewire\Pages\Admin\Contents\ProductCategoryFirstResources;

use Livewire\Component;

class ProductCategoryFirstList extends Component
{
  public $title = 'Product Category First';
  public string $url = '/product-category-firsts';
  use \App\Helpers\Permission\Traits\WithPermission;

  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'product_category_first';
  
  public function amount()
  {
    $this->permission($this->basePageName.'-list');
  }

  public function render()
  {
    return view('livewire.pages.admin.contents.product-category-first-resources.product-category-first-list')
      ->title($this->title);
  }

}
